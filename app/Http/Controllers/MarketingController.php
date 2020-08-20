<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Mail\Campaign;
use App\Models\Campaigns;
use App\Models\Catalogue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use function Sodium\compare;
use Snowfire\Beautymail\Beautymail;

class MarketingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $today = Carbon::today();
        $campaigns = Campaigns::where('company_id', Auth::user()->company_id)->where('last_day', '>', $today)->get();
        $catalogues = Catalogue::where('company_id', Auth::user()->company_id)->get();
        return view('pages.marketing.index', compact('campaigns', 'catalogues'));
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
            'link' => 'required|regex:'.$regex,
            'imageLink' => 'required|regex:'.$regex,
            'emails' => ['required','regex:/^(\s?[^\s,]+@[^\s,]+\.[^\s,]+\s?)*(\s?[^\s,]+@[^\s,]+\.[^\s,]+)$/'],
            'pdf' => 'required'
        ]);

        $title = $request->title;
        $firstP = $request->firstP;
        $secondP = $request->secondP;
        $link = $request->link;
        $imageLink = $request->imageLink;
        $emails = $request->emails;
        $emails = explode(" ", $emails);
        $pdf = $request->pdf;

        foreach ($emails as $email) {
            Mail::to($email)->queue(new Campaign($title, $firstP, $secondP, $link, $imageLink, $pdf));
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
        return view('email_marketing.test');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
}
