<?php


namespace App\Services;


use App\Models\Sponsors;
use Illuminate\Support\Facades\Auth;

class SponsorsInside
{
    public function get(){
        $userCompany = Auth::user()->company_id;

        $sponsors = Sponsors::select('sponsors.*')
            ->join('sponsors_companies', 'sponsors_companies.sponsorId', '=', 'sponsors.sponsorId')
            ->where('sponsors_companies.companyId', $userCompany)
            ->get();

        return $sponsors;
    }
}
