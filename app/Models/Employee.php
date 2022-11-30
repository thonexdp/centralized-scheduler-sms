<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';
    protected $with = ['Department'];

    protected $fillable = ['id','firstname','middlename','lastname','agencyno','department','cellno','status','itemname','campus','photo','email'];

    public $timestamps = false;
    public function Department()
    {
        return $this->hasOne(Department::class,'id','department');
    }
}
