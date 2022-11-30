<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    use HasFactory;
    protected $table = 'participants';
    protected $with = ['Meeting','Employee'];
    protected $fillable = ['id','empid','meetingId','active'];

    public $timestamps = false;

    public function Employee()
    {
        return $this->hasOne(Employee::class,'id','empid');
    }
    public function Meeting()
    {
        return $this->hasOne(Meetings::class,'id','meetingId');
    }
}
