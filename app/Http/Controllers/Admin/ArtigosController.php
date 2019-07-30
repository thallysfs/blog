<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Artigo;


class ArtigosController extends Controller
{

    public function index()
    {
        //estou transformando o array em json para quando passa-lo para o index.blade.php puder tratar a variável com javascript
        $listaMigalhas = json_encode([
            ["titulo"=>"Admin","url"=>route('admin')],
            ["titulo"=>"Lista de Artigos","url"=>""]
        ]);

        //aqui onde exibo os artigos.
        $listaArtigos = Artigo::listaArtigos(5);

        return view('admin.artigos.index', compact('listaMigalhas', 'listaArtigos'));
    }


    public function create()
    {
        //
    }


    /* Método de criação de registro */
    public function store(Request $request)
    {
        $data = $request->all();
        $validacao = \Validator::make($data,[
            "titulo" => "required",
            "descricao" => "required",
            "conteudo" => "required",
            "data" => "required"

        ]);

        if($validacao->fails()){
           return redirect()->back()->withErrors($validacao)->withInput();
        }


        //dd($request->all());
        Artigo::create($data);
        //redirect back retorna pra página antes da página atual
        return redirect()->back();

    }


    public function show($id)
    {
        return Artigo::find($id);

    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validacao = \Validator::make($data,[
            "titulo" => "required",
            "descricao" => "required",
            "conteudo" => "required",
            "data" => "required"

        ]);

        if($validacao->fails()){
           return redirect()->back()->withErrors($validacao)->withInput();
        }

        Artigo::find($id)->update($data);
        //redirect back retorna pra página antes da página atual
        return redirect()->back();
    }


    public function destroy($id)
    {
        Artigo::find($id)->delete();
        return redirect()->back();
    }
}
