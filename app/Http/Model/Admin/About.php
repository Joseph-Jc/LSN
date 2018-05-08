<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table='about';
    public $primaryKey='about_id';
    public $timestamps=false;
    protected $fillable=['about_cate_id','about_title','about_author','about_time','about_summary','about_content'];
}
