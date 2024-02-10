<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rejection_Message extends Model
{
    use HasFactory;
    protected $table = 'rejection_message';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    protected $fillable = [

        'meeting_id',
        'message',
        'writer',

    ];

    public function rejectMessages()
    {
        return $this->belongsTo(Meeting::class, 'meeting_id', 'id');
    }

    public function Writer()
    {
        return $this->belongsTo(Participant::class, 'writer', 'id');
    }
    
}
