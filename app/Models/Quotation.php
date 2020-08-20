<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = "quotation";

    public $timestamps = true;

    public $fillable = ["name", "description", "file", "company_id", "contact_id", "created_by_id"];
}
