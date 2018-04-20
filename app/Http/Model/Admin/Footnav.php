<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Footnav extends Model
{
    protected $table='footnav';
    public $primaryKey='footnav_id';
    public $timestamps=false;
    protected $fillable=['footnav_name','footnav_link'];
}
