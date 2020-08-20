<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Companies extends Model
{
    protected $fillable = ['name','email','is_active'];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $table = 'companies';
    public $timestamps = true;
}
