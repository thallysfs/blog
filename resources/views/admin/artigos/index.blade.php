@extends('layouts.app')

@section('content')
    <div class="container">
        <pagina tamanho="12">

            <!-- Espaço para mensagem de erro -->
                @if($errors->all())
                <div class="alert alert-danger alert-dismissible text-center" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  @foreach ($errors->all() as $key => $value)
                    <li><strong>{{$value}}</strong></li>
                  @endforeach
                </div>
              @endif

            <painel titulo="Lista de Artigos">
            <migalhas v-bind:lista="{{$listaMigalhas}}"></migalhas>
                

                <tabela-lista 
                    v-bind:titulos="['#','Título','Descrição', 'Autor','data']"
                    v-bind:itens="{{json_encode($listaArtigos)}}"
                    ordem="desc" ordemcol="0"
                    criar="#criar" detalhe="/admin/artigos/" editar="/admin/artigos/" deletar="/admin/artigos/" token="{{ csrf_token() }}"
                    modal="sim"

                ></tabela-lista>
                <div align="center">
                    <!-- Paginação -->
                    {{$listaArtigos->links()}}
                </div>
            </painel>
        </pagina>

        <!-- Modal Adicionar -->
        <modal nome="adicionar" titulo="Adicionar">
        <formulario id="formAdicionar" css="" action="{{route('artigos.store')}}" method="post" enctype="" token="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="titulo">Título</label>
                <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título" value="{{old('titulo')}}">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descrição" value="{{old('descricao')}}">
                </div>
                <div class="form-group">
                    <label for="addConteudo">Conteúdo</label>
                    <textarea name="conteudo" id="conteudo" class="form-control">{{old('conteudo')}}</textarea>                
                </div>
                <div class="form-group">
                    <label for="data">Data</label>
                    <input type="date" class="form-control" id="data" name="data" value="{{old('data')}}">
                </div>
                
        </formulario>
            <span slot="botoes">
                <button form="formAdicionar" class="btn btn-info" type="submit">Adicionar</button>
            </span>
            
        </modal>
        <!-- FIM do Modal Adicionar -->

        <!-- Modal Editar -->
        <modal nome="editar" titulo="Editar">
                <formulario id="formEditar" v-bind:action="'admin/artigos/' + $store.state.item.id" method="put" enctype="" token="{{ csrf_token() }}">
                            <div class="form-group">
                                <label for="titulo">Título</label>
                                <!-- v-model mostra valores - $store.state instanciado no app.js está recebendo os items no componente modalLink que por sua vez está presente dentro do componente modal.vue -->
                                <input type="text" class="form-control" id="titulo" name="titulo" v-model="$store.state.item.titulo"  placeholder="Título">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Descrição</label>
                                <input type="text" class="form-control" id="descricao" name="descricao" v-model="$store.state.item.descricao" placeholder="Descrição">
                            </div>

                            <div class="form-group">
                                <label for="editConteudo">Conteúdo</label>
                                <textarea name="conteudo" id="editConteudo" class="form-control" v-model="$store.state.item.conteudo"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="data">Data</label>
                                <input type="date" class="form-control" id="data" name="data" v-model="$store.state.item.data">
                            </div>
                    </formulario>
                    <span slot="botoes">
                        <button form="formEditar" class="btn btn-info" type="submit">Atualizar</button>
                    </span>
                    
        </modal>
        <!-- FIM do Modal Adicionar -->

        <!-- Modal detalhe -->
        <modal nome="detalhe" v-bind:titulo="$store.state.item.titulo">
            <p>@{{$store.state.item.descricao}}</p>
            <p>@{{$store.state.item.conteudo}}</p>
        </modal>
        <!-- FIM do Modal Detalhe -->

@endsection