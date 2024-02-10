<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $table = 'meeting';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    protected $fillable = ['title', 'location', 'date', 'inisiator', 'note_taker', 'meeting_status', 'former_id'];


    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'meeting_participant', 'meeting_id', 'participant_id');
    }

    public function contents()
    {
        return $this->hasMany(Content::class, 'meeting_id', 'id');
    }

    public function noteTaker()
    {
        return $this->belongsTo(Participant::class, 'note_taker', 'id');
    }

    public function meetingCalledBy()
    {
        return $this->belongsTo(Participant::class, 'inisiator', 'id');
    }






    public function files()
    {
        return $this->hasMany(Meeting_File::class, 'meeting_id', 'id');
    }


    public function revisionHistories()
    {
        return $this->hasMany(Revision_History::class, 'meeting_id', 'id');
    }

    public function rejectionMessages()
    {
        return $this->hasMany(Rejection_Message::class, 'meeting_id', 'id');
    }

}
