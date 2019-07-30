@extends('layouts.app')

@section('content')
    <div class="container">
        <pagina tamanho="10">
            <painel titulo="Dashboard">
                <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>
  

                <div class="row">
                    @can('autor')
                        <div class="col-md-4">
                            {{-- Parâmetros base <caixa qtd="" titulo="" url="" cor="" icone=""></caixa>     --}}
                                <caixa qtd="{{$totalArtigos}}" titulo="Artigos" url="{{route('artigos.index')}}" cor="orange" icone="ion-md-pie"></caixa>
                        </div> 
                    @endcan
                    @can('eAdmin')
                        <div class="col-md-4">
                            <caixa qtd="{{$totalUsuarios}}" titulo="Usuários" url="{{route('usuarios.index')}}" cor="blue" icone="ion-md-contacts"></caixa> 
                        </div>
                        <div class="col-md-4">
                            <caixa qtd="{{$totalAutores}}" titulo="Autores" url="{{route('autores.index')}}" cor="red" icone="ion-md-person"></caixa> 
                        </div>
                        <div class="col-md-4">
                            <caixa qtd="{{$totalAdmin}}" titulo="Admin" url="{{route('adm.index')}}" cor="green" icone="ion-md-person"></caixa> 
                        </div>
                    @endcan
                    
                </div>
            </painel>
        </pagina>
@endsection
