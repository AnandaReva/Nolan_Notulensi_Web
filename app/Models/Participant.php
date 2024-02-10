<?php

namespace App\Models;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model implements Authenticatable

{
    use HasFactory, AuthenticatableTrait;

    public $password = null;
    protected $table = 'participant';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'integer';
    protected $fillable = [

        'name',
        'email',
    ];

    public function meetings()
    {
        return $this->belongsToMany(Meeting::class, 'meeting_participant', 'participant_id', 'meeting_id');
    }

    public function getAuthIdentifierName()
    {
        return 'email'; // Sesuaikan dengan nama kolom yang digunakan sebagai identifier
    }

    public function getAuthIdentifier()
    {
        return $this->email; // Sesuaikan dengan kolom yang digunakan sebagai identifier
    }
}
