<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artigo;
use App\User;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    //estou transformando o array em json para quando passa-lo para o index.blade.php puder tratar a variável com javascript
    $listaMigalhas = json_encode([
        ["titulo"=>"Admin","url"=>""]
    ]);

        $totalUsuarios = User::count();
        $totalArtigos = Artigo::count();
        $totalAutores = User::where('autor','=','S')->count();
        $totalAdmin = User::where('admin','=','S')->count();

        return view('admin', compact('listaMigalhas', 'totalUsuarios', 'totalArtigos', 'totalAutores', 'totalAdmin'));
    }
}
