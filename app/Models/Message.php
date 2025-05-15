<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['student_id', 'mentor_id', 'content'];

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function mentor() {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}
