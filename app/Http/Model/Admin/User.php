<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table='user';
    public $primaryKey='userid';
    public $timestamps=false;
    protected $fillable=['username','password'];
}
