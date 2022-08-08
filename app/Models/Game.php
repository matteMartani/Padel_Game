<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $table = 'game';
    protected $primaryKey = 'game_id';
    protected $fillable = [
        'user_id',
        'field',
        'date',
        'time',
        'duration',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(PadelUser::class, 'user_id');
    }
}
