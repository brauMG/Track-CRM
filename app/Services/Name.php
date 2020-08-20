<?php


namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Companies;

class Name
{
    public function get(){
        $companyName = \App\Models\Companies::where('id', Auth::user()->company_id)->get();
        $companyName = $companyName[0]['name'];
        return $companyName;
    }
}
