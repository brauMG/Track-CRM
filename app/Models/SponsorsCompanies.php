<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SponsorsCompanies extends Model
{
    public $table  = "sponsors_companies";
    public $timestamps = false;
    protected $fillable = [
        'sponsorId','companyId'
    ];
}
