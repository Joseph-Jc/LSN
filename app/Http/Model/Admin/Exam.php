<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table='exam';
    public $primaryKey='exam_id';
    public $timestamps=false;
    protected $fillable=['exam_title','exam_author','exam_summary','exam_time','exam_content','exam_answer'];
}
