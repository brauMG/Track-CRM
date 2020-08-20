<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = "inventory";

    public $timestamps = true;

    public $fillable = ["name", "stock", "image", "price", "description", "company_id"];
}
