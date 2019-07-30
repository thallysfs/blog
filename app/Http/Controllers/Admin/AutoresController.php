<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
//Necessário copiar a importação para ignorar regra do e-mail único na hora de atualizar
use Illuminate\Validation\Rule;

class AutoresController extends Controller
{

    public function index()
    {
        $listaMigalhas = json_encode([
            ["titulo"=>"Admin","url"=>route('admin')],
            ["titulo"=>"Lista de Autores","url"=>""]
        ]);

        //aqui onde exibo os artigos.
        $listaModelo = User::select('id', 'name','email')->where('autor', '=', 'S')->paginate(5);


        return view('admin.autores.index', compact('listaMigalhas', 'listaModelo'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $validacao = \Validator::make($data,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',

        ]);

        if($validacao->fails()){
           return redirect()->back()->withErrors($validacao)->withInput();
        }

        $data['password'] = bcrypt($data['password']);

        //dd($request->all());
        User::create($data);
        //redirect back retorna pra página antes da página atual
        return redirect()->back();

    }


    public function show($id)
    {
        return User::find($id);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();

        //testando se existe senha e se não vem vazia
        if(isset($data['password']) && $data['password'] != ""){
            $validacao = \Validator::make($data,[
                'name' => 'required|string|max:255',
                'email' => ['required','string','email','max:255','unique:users',Rule::unique('Users')->ignore($id)],
                'password' => 'required|string|min:6',
            ]);
            $data['password'] = bcrypt($data['password']);
        }else{
            $validacao = \Validator::make($data,[
                'name' => 'required|string|max:255',
                'email' => ['required','string','email','max:255','unique:users',Rule::unique('Users')->ignore($id)],   
            ]);
            //aqui eu removo o password do array para que ele não atualize caso venha em branco
            unset($data['password']);
        }


        if($validacao->fails()){
           return redirect()->back()->withErrors($validacao)->withInput();
        }

        User::find($id)->update($data);
        //redirect back retorna pra página antes da página atual
        return redirect()->back();
    }


    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back();
    }
}
