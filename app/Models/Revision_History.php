<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision_History extends Model
{
    use HasFactory;


    protected $table = 'revision_history';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    protected $fillable = [

        'meeting_id',
        'discussion_log',
        'editor',

    ];

    public function meetingRevisionHistory()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id', 'id');
    }

    public function editorParticipant()
    {
        return $this->belongsTo(Participant::class, 'editor', 'id');
    }

    public function getPicNames()
    {
        $picIds = $this->discussion_log['action']->pluck('pic')->unique();

        return Participant::whereIn('id', $picIds)->pluck('name');
    }
}
