<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table='new';
    public $primaryKey='new_id';
    public $timestamps=false;
    protected $fillable=['new_title','new_author','new_summary','new_time','new_content'];
}
