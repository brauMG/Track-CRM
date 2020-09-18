<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Mail\Campaign;
use App\Mail\Comentario;
use App\Mail\ContactoAsignado;
use App\Mail\Promo;
use App\Models\Campaigns;
use App\Models\Catalogue;
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
use function Sodium\compare;
use Snowfire\Beautymail\Beautymail;

class PromosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $today = Carbon::today();
        $catalogues = Catalogue::where('company_id', Auth::user()->company_id)->get();
        $contacts = DB::table('contact')
            ->join('contact_status', 'contact.status', 'contact_status.id')
            ->join('contact_email', 'contact.id', 'contact_email.contact_id')
            ->where('contact.company_id', Auth::user()->company_id)
            ->where('contact_email.email', '!=', 'sin asignar')
            ->select('contact.*', 'contact_status.name as contactStatus', 'contact_email.email as contactEmail')
            ->orderByDesc('contactStatus')
            ->get();
        return view('pages.promos.index', compact( 'catalogues', 'contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function send(Request $request)
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';

        $this->validate($request, [
            'title' => 'required',
            'firstP' => 'required',
            'secondP' => 'required',
//            'imageLink' => 'required',
            'imageLink' => 'required|regex:'.$regex,
            'emails' => 'required',
            'pdf' => 'required'
        ]);

        $title = $request->title;
        $firstP = $request->firstP;
        $secondP = $request->secondP;
        $imageLink = $request->imageLink;
        $emails = $request->emails;
        $pdf = $request->pdf;
        //local
        $pdfName = substr($pdf, 39);
        //server
//        $pdfName = substr($pdf, 40);
        $catalogue_id = Catalogue::where('file', $pdfName)->get();
        $catalogue_id = $catalogue_id[0]['id'];
        $link = "https://crm-track.com/guest/promos/quiz/";
//        $link = "http://192.168.66.10/guest/promos/quiz/";
        $url = $link.$catalogue_id;

        foreach ($emails as $email) {
            Mail::to($email)->queue(new Promo($title, $firstP, $secondP, $imageLink, $pdf, $url));
        }

        return back()->with('mensaje', "Correos enviados correctamente");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function preview(Request $request)
    {
        return view('email_promos.test');
    }

    public function quiz($id)
    {
        $catalogue = Catalogue::where('id', $id)->get();
        $company_id = $catalogue[0]['company_id'];

        $users_ids = User::where('company_id', $company_id)->where('is_super_admin', false)->get();
        $ids_list[] = array();

        foreach ($users_ids as $user_id){
            $ids_list[] =+ $user_id->id;
        }

        $ids_list = array_filter($ids_list);
        $random_index = array_rand($ids_list);
        $id_assign = $ids_list[$random_index];

        $user = User::find($id_assign);

        $user_email = $user->email;
        $user_phone = $user->phone;
        $username = $user->name;

        $catalogue2 = Catalogue::find($id);
        $company_id = $catalogue2->company_id;
        $catalogue = $catalogue2->file;

        $company = Companies::find($company_id);

        $company_name = $company->name;

        if (Auth::guest()) {
            return view('pages.promos.quiz', compact('id', 'user_email', 'user_phone', 'username', 'catalogue', 'company_name'));
        }
    }

    public function storeQuiz(Request $request)
    {
        $this->validate($request, [
            'my_email' => 'required|email',
            'my_name' => 'required',
            'commentary' => 'required'
        ]);

        //data for email
        $my_name = $request->my_name;
        $my_email = $request->my_email;
        $commentary = $request->commentary;
        $user_email = $request->user_email;
        $username = $request->username;
        $catalogue = $request->catalogue;
        $company_name = $request->company_name;

        // send notifications email
        Mail::to($user_email)->queue(new Comentario($my_name, $my_email, $commentary, $username, $catalogue));

        return view('pages.promos.thanks', compact('company_name'));
    }

    public function seeLink($id) {
        $link = "https://crm-track.com/guest/campaigns/quiz/";
//      $link = "http://192.168.66.10/guest/campaigns/quiz/";
        $url = $link.$id;
        return view('pages.campaigns.myLink', compact('url'));
    }

    public function thanks(){
        return view('pages.promos.thanks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
}
