<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $table='leave';
    public $primaryKey='leave_id';
    public $timestamps=false;
    protected $fillable=['leave_person','leave_time','leave_content','leave_email'];
}
