<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meetings extends Model
{
    use HasFactory;
    protected $table = 'meeting';

    protected $fillable = ['id','description','topic','date','timestart','type','duration','addedby','venue','active'];

    public $timestamps = false;

}
