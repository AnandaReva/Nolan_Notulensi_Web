<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $table = 'action';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    protected $fillable = [
        'pic',
        'due',
        'item',
        'content_id',
    ];


    public function content()
    {
        return $this->belongsTo(Content::class, 'content_id', 'id');
    }


    public function picParticipant()
    {
        return $this->belongsTo(Participant::class, 'pic', 'id')->withDefault([
            'pic' => null,
        ]);
    }
}
