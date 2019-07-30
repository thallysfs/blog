<template>
    <div>
        
        <div class="form-inline"> 
            <a v-if="criar && !modal" v-bind:href="criar">Criar</a>
            <modallink v-if="criar && modal" tipo="button" nome="adicionar" titulo="Criar" css=""></modallink>   
            <div class="form-group pull-right">
               <input type="search"  class="form-control" placeholder="Buscar" v-model="buscar" >
            </div>
        </div>

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="cursor:pointer" v-on:click="ordenaColuna(index)" v-for="(titulo, index) in titulos">{{titulo}}</th>

                            <th v-if="detalhe || editar || deletar">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- as variáveis do for abaixo são de funções definidas ao final -->
                        <tr v-for="(item,index) in lista">
                            <td v-for="i in item">{{i}}</td>

                            <td v-if="detalhe || editar || deletar">
                                <form v-bind:id="index" v-if="deletar && token" v-bind:action="deletar + item.id" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" v-bind:value="token">

                                    <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhe |</a>
                                    <modallink v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" tipo="link" nome="detalhe" titulo="Detalhe |" css=""></modallink>   


                                    <a v-if="editar && !modal" v-bind:href="editar">Editar |</a>
                                    <modallink v-if="editar && modal" v-bind:item="item" v-bind:url="editar" tipo="link" nome="editar" titulo="Editar |" css=""></modallink>   
                                    
                                    <a href="#" v-on:click="executaForm(index)"> Deletar</a>
                                </form>

                                <span v-if="!token">
                                    <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhe |</a>
                                    <modallink v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" tipo="link" nome="detalhe" titulo="Detalhe |" css=""></modallink>   
                        

                                    <a v-if="editar && !modal" v-bind:href="editar">Editar |</a>
                                    <modallink v-if="editar && modal" tipo="link" v-bind:item="item" v-bind:url="editar" nome="editar" titulo="Editar |" css=""></modallink>   
                                    <a v-if="deletar" v-bind:href="deletar">Deletar</a>
                                </span>

                                <span v-if="token && !deletar">
                                    <a v-if="detalhe && !modal" v-bind:href="detalhe">Detalhe |</a>
                                    <modallink v-if="detalhe && modal" v-bind:item="item" v-bind:url="detalhe" tipo="link" nome="detalhe" titulo="Detalhe |" css=""></modallink>   

                                    <a v-if="editar && !modal" v-bind:href="editar">Editar |</a>
                                    <!-- -->
                                    <modallink v-if="editar && modal" tipo="link" v-bind:item="item" v-bind:url="editar" nome="editar" titulo="Editar" css=""></modallink>   
                                </span>  

                            </td>    
                        </tr>
                          
                    </tbody>

                </table>
    </div>
    
</template>

<script>
    export default {
        /* props - são os valores que irei receber da página do layout, lá onde passarei o valor de título, itens etc... */
        props:['titulos','itens','ordem', 'ordemcol','criar','detalhe','editar','deletar','token', 'modal'],
        data:function(){
            return{
                buscar:'',
                /* o if "ou" representado por || serve para informar que se a variável "this.ordem" vier em branco assumirá o valro "asc" */ 
                ordemAux: this.ordem || "asc",
                ordemAuxCol: this.ordemcol || 0
            }
        },
        methods:{
            executaForm: function(index){
                document.getElementById(index).submit();
            },
            ordenaColuna: function(coluna){
                this.ordemAuxCol = coluna;
                if(this.ordemAux.toLowerCase() == "asc"){
                    this.ordemAux = 'desc';
                }else{
                    this.ordemAux = 'asc';
                }
            }
        },
        computed:{
            lista:function(){
            
            //variável local para ajustar a paginação que vem do laravel
            let lista = this.itens.data;
            
            /* o || é um "ou" que checa se existe algo declarado na variável this.ordem, senão ele insere o valor "asc"*/
            let ordem = this.ordemAux || "asc";
            let ordemCol = this.ordemAuxCol || 0;

            ordem = ordem.toLowerCase();
            ordemCol = parseInt(ordemCol);

            if(ordem == "asc"){
              lista.sort(function(a, b){
                    if (Object.values(a)[ordemCol] > Object.values(b)[ordemCol]){return 1}
                    if (Object.values(a)[ordemCol] < Object.values(b)[ordemCol]){return -1}
                    return 0;
                });  
            }else{
            /*  deixar a tabela na ordem decrescente */
            /* Object.values(a) - Força o 'a' a ser um valor e não uma string */
            lista.sort(function(a, b){
                if (Object.values(a)[ordemCol] < Object.values(b)[ordemCol]){return 1;}
                if (Object.values(a)[ordemCol] > Object.values(b)[ordemCol]){return -1;}
                return 0;
                });
            }

            if(this.buscar){
                return lista.filter(res => {
                    res = Object.values(res);
                /* res = 1, quer dizer que estamos pegando o index 1 (título) das colunas das tabelas
                    .toLowerCase deixa o campo digitado minusculo
                    .indexOf recebe uma string e retorna um valor negativo se a variável 'buscar' vier vazia 
                    se não ,vai filtrar o valor que vier e,m "busca" na tabela */ 
                    for(let k=0; k < res.length; k++){
                        /* A concatenação da variável k com as "", ocorre para trasnformar a variável em string */
                        if((res[k] + "").toLowerCase().indexOf(this.buscar.toLowerCase()) >=0){
                            return true;
                        } 
                    }
                return false;
              });
            }
                return lista;
            }
        }
    }
</script>