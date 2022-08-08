<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DataLayer extends Model
{
    use HasFactory;

    # game

    public function listGames($user_id)
    {
        return Game::where('user_id', $user_id)->get();
    }

    public function listAllGames()
    {
        return DB::table('game')->get();
    }

    public function addGame($user_id, $field, $date, $time, $duration)
    {
        $game = new Game();
        $game->user_id = $user_id;
        $game->field = $field;
        $game->date = $date;
        $game->time = $time;
        $game->duration = $duration;
        $game->save();
    }

    public function editGame($game_id, $field, $date, $time, $duration)
    {
        $game = Game::find($game_id);
        $game->field = $field;
        $game->date = $date;
        $game->time = $time;
        $game->duration = $duration;
        $game->save();
    }

    public function deleteGame($game_id)
    {
        $game = Game::find($game_id);
        $game->delete();
    }

    public function findGame($game_id)
    {
        return Game::find($game_id);
    }

    # padel user

    public function getUserId($mail)
    {
        return PadelUser::where('mail', $mail)->value('user_id');
    }

    public function validUser($mail, $password)
    {
        $users = PadelUser::where('mail', $mail)->get();
        if(count($users)!=0){
            if($users[0]->password == md5($password)){
                return true;
            }
            else{
                return false;
            }
        }
        else {
            return false;
        }
    }

    public function addUser($mail, $password)
    {
        $user = new PadelUser();
        $user->mail = $mail;
        $user->password = $password;
        $user->save();
    }
}
