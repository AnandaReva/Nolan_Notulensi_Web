<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting_Participant extends Model
{
    use HasFactory;

    protected $table = 'meeting_participant';
    protected $fillable = [
        'meeting_id',
        'participant_id',
        'attendance_status',
        'signature',
        'url',
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id', 'id');
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id', 'id');
    }
}
