<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Mail\Campaign;
use App\Mail\Promo;
use App\Models\Campaigns;
use App\Models\Catalogue;
use App\Models\Contact;
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

        foreach ($emails as $email) {
            Mail::to($email)->queue(new Promo($title, $firstP, $secondP, $imageLink, $pdf));
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
}
