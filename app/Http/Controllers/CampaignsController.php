<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Mail\ContactoAsignado;
use App\Models\Campaigns;
use App\Models\Companies;
use App\Models\Contact;
use App\Models\ContactEmail;
use App\Models\ContactPhone;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use const http\Client\Curl\AUTH_ANY;
use DomPDF;

class CampaignsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $campaigns = Campaigns::where("name", "like", "%$keyword%")->where('company_id', Auth::user()->company_id)->paginate($perPage);
        } else {
            $campaigns = Campaigns::latest()->where('company_id', Auth::user()->company_id)->paginate($perPage);
        }

        return view('pages.campaigns.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('pages.campaigns.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'target_description' => 'required',
            'last_day' => 'required|date',
            'investment' => 'numeric'
        ]);

        $today = Carbon::today();
        if($request->last_day < $today){
            redirect(back()->with('error_message', 'Fecha anterior a la actual'));
        }

        $requestData['name'] = $request->name;
        $requestData['target_description'] = $request->target_description;
        $requestData['last_day'] = $request->last_day;
        $requestData['investment'] = $request->investment;
        $requestData['company_id'] = Auth::user()->company_id;

        Campaigns::create($requestData);

        return redirect('admin/campaigns')->with('flash_message', 'Campaña añadida');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $campaign = Campaigns::findOrFail($id);

        $total_contacts_reached = DB::table('campaigns')
            ->leftJoin('contact', 'campaigns.id', 'contact.campaign_id')
            ->where('contact.company_id', Auth::user()->company_id)
            ->count();

        $leads_contacts_reached = DB::table('campaigns')
            ->leftJoin('contact', 'campaigns.id', 'contact.campaign_id')
            ->where('contact.company_id', Auth::user()->company_id)
            ->where('contact.status', 1)
            ->count();

        $opportunity_contacts_reached = DB::table('campaigns')
            ->leftJoin('contact', 'campaigns.id', 'contact.campaign_id')
            ->where('contact.company_id', Auth::user()->company_id)
            ->where('contact.status', 2)
            ->count();

        $customers_contacts_reached = DB::table('campaigns')
            ->leftJoin('contact', 'campaigns.id', 'contact.campaign_id')
            ->where('contact.company_id', Auth::user()->company_id)
            ->where('contact.status', 3)
            ->count();

        $close_contacts_reached = DB::table('campaigns')
            ->leftJoin('contact', 'campaigns.id', 'contact.campaign_id')
            ->where('contact.company_id', Auth::user()->company_id)
            ->where('contact.status', 4)
            ->count();

        return view('pages.campaigns.show', compact('campaign', 'total_contacts_reached', 'leads_contacts_reached', 'opportunity_contacts_reached', 'customers_contacts_reached', 'close_contacts_reached'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $campaign = Campaigns::findOrFail($id);

        return view('pages.campaigns.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $campaign = Campaigns::findOrFail($id);
        $campaign->update($requestData);

        return redirect('admin/campaigns')->with('flash_message', 'Campaña actualizada');
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Campaigns::destroy($id);

        return redirect('admin/campaigns')->with('flash_message', 'Campaña eliminada');
    }

    public function quiz($id)
    {
        $campaign = Campaigns::find($id);
        $company_id = $campaign->company_id;
        $company = Companies::find($company_id);
        $company_name = $company->name;
        if (Auth::guest()) {
            return view('pages.campaigns.quiz', compact('id', 'company_name'));
        }
        else {
            return view('pages.campaigns.read-only-quiz', compact('id'));
        }
    }

    protected function insertEmails($emails, $contact_id)
    {
        foreach ($emails as $email) {

            $contactEmail = new ContactEmail();

            $contactEmail->email = $email;

            $contactEmail->contact_id = $contact_id;

            $contactEmail->save();
        }
    }


    /**
     * insert phones
     *
     *
     * @param $phones
     * @param $contact_id
     */
    protected function insertPhones($phones, $contact_id)
    {
        foreach ($phones as $phone) {

            $contactPhone = new ContactPhone();

            $contactPhone->phone = $phone;

            $contactPhone->contact_id = $contact_id;

            $contactPhone->save();
        }
    }

    public function storeQuiz(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'referral_source' => 'required',
            'email' => 'email|required',
            'phone' => 'required|numeric',
        ]);

        $company_name = $request->company_name;

        $requestData = $request->all();

        $name = $request->name;

        $email = $requestData['email'];

        $requestData['campaign_id'] = $request->campaign_id;

        $company_id = Campaigns::where('id', $request->campaign_id)->get();

        $company_id = $company_id[0]['company_id'];

        $requestData['company_id'] = $company_id;

        $requestData['status'] = 2;

        $phone = $request['phone'];

        $users_ids = User::where('company_id', $company_id)->where('is_super_admin', false)->get();

        $ids_list[] = array();

        foreach ($users_ids as $user_id){
            $ids_list[] =+ $user_id->id;
        }

        $ids_list = array_filter($ids_list);

        $random_index = array_rand($ids_list);

        $id_assign = $ids_list[$random_index];

        $requestData['created_by_id'] = $id_assign;

        $requestData['assigned_user_id'] = $id_assign;

        unset($requestData['email'], $requestData['phone']);

        $contact = Contact::create($requestData);

        $reached = Contact::where('campaign_id', $request->campaign_id)->get();
        $reached = count($reached);

        Campaigns::where('id', $request->campaign_id)->update([
            'contacts_reached' => $reached
        ]);

        $contact_id = $contact->id;

        ContactEmail::create([
            'email' => $email,
            'contact_id' => $contact_id
        ]);

        ContactPhone::create([
            'phone' => $phone,
            'contact_id' => $contact_id
        ]);

        $user = User::find($id_assign);

        // send notifications email
        if(getSetting("enable_email_notification") == 1) {
            Mail::to($email)->queue(new ContactoAsignado($user, $contact));
        }
        return redirect('pages.campaigns.thanks', compact('company_name'));
    }

    public function seeLink($id) {
        $link = "https://crm-track.com/guest/campaigns/quiz/";
//        $link = "http://192.168.66.10/guest/campaigns/quiz/";
        $url = $link.$id;
        return view('pages.campaigns.myLink', compact('url'));
    }

    public function thanks(){
        return view('pages.campaigns.thanks');
    }

    public function preparePdf(Request $request) {
        return view('pages.prepareCampaigns.index');
    }

    public function exportPdf(Request $request)
    {
        $creada = $request->input('creada');
        $vence = $request->input('vence');
        $contactos_desde = $request->input('contactos_desde');
        $contactos_hasta = $request->input('contactos_hasta');
        $inversion_desde = $request->input('inversion_desde');
        $inversion_hasta = $request->input('inversion_hasta');

        $campanias = DB::table('campaigns')
            ->where(function($query) use ($creada, $request) {
                if ($creada != null) {
                    $query->whereDate('campaigns.created_at', '>=', $creada);
                }
            })
            ->where(function($query) use ($vence, $request) {
                if ($vence != null) {
                    $query->whereDate('campaigns.last_day', '<=', $vence);
                }
            })
            ->where(function($query) use ($contactos_desde, $request) {
                if ($contactos_desde != null) {
                    $query->where('campaigns.contacts_reached', '>=', $contactos_desde);
                }
            })
            ->where(function($query) use ($contactos_hasta, $request) {
                if ($contactos_hasta != null) {
                    $query->where('campaigns.contacts_reached', '<=', $contactos_hasta);
                }
            })
            ->where(function($query) use ($inversion_desde, $request) {
                if ($inversion_desde != null) {
                    $query->where('campaigns.investment', '>=', $inversion_desde);
                }
            })
            ->where(function($query) use ($inversion_hasta, $request) {
                if ($inversion_hasta != null) {
                    $query->where('campaigns.investment', '<=', $inversion_hasta);
                }
            })
            ->where('campaigns.company_id', Auth::user()->company_id)
            ->get();

        $pdf = DomPDF::loadView('pdf.campaigns', compact('campanias'));

        return $pdf->download('campañas.pdf');
    }
}
