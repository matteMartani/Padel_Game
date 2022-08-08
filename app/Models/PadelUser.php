<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PadelUser extends Model
{
    use HasFactory;

    protected $table = 'padel_user';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'mail',
        'password',
    ];

    public $timestamps = false;

    public function games()
    {
        return $this->hasMany(Game::class, 'user_id');
    }

}
