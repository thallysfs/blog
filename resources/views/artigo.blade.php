@extends('layouts.app')

@section('content')
    <!-- o {! ! !!} abaixo serve para o laravel entender que existe uma formatação html neste conteúdo como negrito, sublinhado etc -->
        <pagina tamanho="12">
            <painel>
            <h2 align="center">{{$artigo->titulo}}</h2>
            <h4 align="center">{{$artigo->descricao}}</h4>
            <p>
                {!!$artigo->conteudo!!}
            </p>
            <p align="center">
                <small>{{$artigo->user->name}} - {{ date('d/m/Y', strtotime($artigo->data))}}</small>
            </p>
            </painel>
        </pagina>
@endsection