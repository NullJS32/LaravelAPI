<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    public function index()
    {
        $coins = Coin::paginate(100);

        return view('coins.index', ['coins' => $coins]);
    }
}
