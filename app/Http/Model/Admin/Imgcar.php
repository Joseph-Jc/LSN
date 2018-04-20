<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Imgcar extends Model
{
    protected $table='imgcar';
    public $primaryKey='img_id';
    public $timestamps=false;
    protected $fillable=['img_path','img_link','img_cate'];
}
