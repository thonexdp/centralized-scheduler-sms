<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $with = ['employee'];
    protected $fillable = ['id','empid','username','password','role'];

    public $timestamps = false;

    public function employee()
    {
        return $this->hasOne(Employee::class,'id','empid');
    }
}
