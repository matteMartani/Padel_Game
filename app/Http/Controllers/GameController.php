<?php

namespace App\Http\Controllers;

use App\Models\DataLayer;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function personal_index()
    {
        {
            $dl = new DataLayer();
            $user_id = $dl->getUserId($_SESSION['mail']);
            $games = $dl->listGames($user_id);

            return view('game.myGames')->with('logged', true)->with('games', $games);
        }
    }

    public function create()
    {
        {
            return view('game.addGame')->with('logged', true);
        }
    }

    public function edit($game_id)
    {
        $dl = new DataLayer();
        $software_house = $dl->find_software_house_by_id($software_house_id);
        $nome = $software_house->nome;
        return view('software_house.addSH')->with('software_house_id', $software_house_id)->with('nome', $nome)->with('username', $_SESSION['username']);
    }

    public function store(Request $request)
    {
        $dl = new DataLayer();

        $dl->add_software_house($request->input('nome'), $_SESSION['user_id']);

        return \redirect(route('software_house.index'));
    }

    public function updater(Request $request, $software_house_id)
    {
        session_start();
        $dl = new DataLayer();

        $dl->edit_software_house($software_house_id, $request->input('nome'));

        return \redirect(route('software_house.index'));
    }

    public function eliminate($software_house_id)
    {
        session_start();
        $dl = new DataLayer();

        $dl->delete_software_house($software_house_id);

        return \redirect(route('software_house.index'));
    }

    public function confirm_request($software_house_id)
    {
        session_start();
        $dl = new DataLayer();
        $software_house = $dl->find_software_house_by_id($software_house_id);
        $nome = $software_house->nome;
        return view('software_house.deleteSH')->with('software_house_id', $software_house_id)->with('nome', $nome)->with('username', $_SESSION['username']);
    }
}
