<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table='video';
    public $primaryKey='video_id';
    public $timestamps=false;
    protected $fillable=['video_title','video_time','video_path','thum_path'];
}
