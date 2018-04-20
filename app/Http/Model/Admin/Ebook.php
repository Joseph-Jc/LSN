<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    protected $table='ebook';
    public $primaryKey='ebook_id';
    public $timestamps=false;
    protected $fillable=['ebook_name','ebook_path','ebook_thum'];
}
