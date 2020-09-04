<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsors extends Model
{
    protected $primaryKey = 'sponsorId';

    protected $fillable = [
        'name', 'description', 'link', 'image', 'show'
    ];

    public function companies()
    {
        return $this->belongsToMany(Sponsors::class, 'sponsors_companies', 'sponsorId','companyId');
    }
}
