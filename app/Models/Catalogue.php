<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    protected $table = "catalogue";

    public $timestamps = true;

    public $fillable = ["name", "description", "file", "company_id"];
}
