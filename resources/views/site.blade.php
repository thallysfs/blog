@extends('layouts.app')

@section('content')
    <!--Na rota do "link" abaixo estou colocando o título apenas para que ele fique na url, str_slug serve para tirar os espaços de uma string. Exemplo da url com essa rota http://localhost:8000/artigo/6/ingles-todo-dia2 -->
    <!-- str_limit é um helper do laravel que limita a quantidade de carfecteres exibidos  -->
    <div class="container">
        <pagina tamanho="12">
            <painel titulo="Artigos">
                <div class="row">
                    @foreach ($lista as $key => $value)
                        <artigocard 
                        titulo="{{$value->titulo}}"
                        descricao="{{ str_limit($value->descricao, 40, "...") }}"
                        link=" {{route('artigo', [$value->id, str_slug($value->titulo)])}} "
                        imagem="http://fomedeescrever.com.br/wp-content/uploads/2018/10/trancado-752x440.jpg"
                        data="{{$value->data}}"
                        autor="{{$value->autor}}"
                        sm="6"
                        md="4"
                        >
                        </artigocard>  
                    @endforeach
                </div>
                <div align="center">
                    {{$lista}}
                </div>

            </painel>
        </pagina>
@endsection