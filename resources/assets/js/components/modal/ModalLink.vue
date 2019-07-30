<template>
    <span>
        <span v-if="item">
        <!-- o v-if testa se existe o parâmetro diferente de button ou link e se existe algum parâmetro, se não por padrão ele trará o button abaixo -->        
        <button v-on:click="preencheFormulario()" v-if="!tipo || (tipo != 'button' && tipo != 'link')" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + nome">{{titulo}}</button>
        <!-- o v-if checa se o tipo é botão, se não for, ele não exibe a tag. O mesmo ocorre com o link -->
        <button  v-on:click="preencheFormulario()" v-if="tipo == 'button'" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + nome">{{titulo}}</button>
        <a v-on:click="preencheFormulario()" v-if="tipo == 'link'" href="#" v-bind:class="css || ''" data-toggle="modal" v-bind:data-target="'#' + nome">{{titulo}}</a>
        </span>

        <span v-if="!item">
        <!-- o v-if testa se existe o parâmetro diferente de button ou link e se existe algum parâmetro, se não por padrão ele trará o button abaixo -->
        <button v-if="!tipo || (tipo != 'button' && tipo != 'link')" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + nome">{{titulo}}</button>
        <!-- o v-if checa se o tipo é botão, se não for, ele não exibe a tag. O mesmo ocorre com o link -->
        <button v-if="tipo == 'button'" type="button" v-bind:class="css || 'btn btn-primary'" data-toggle="modal" v-bind:data-target="'#' + nome">{{titulo}}</button>
        <a v-if="tipo == 'link'" href="#" v-bind:class="css || ''" data-toggle="modal" v-bind:data-target="'#' + nome">{{titulo}}</a>
        </span>
        
    </span>
</template>

<script>
    export default {
        props:['tipo','nome', 'titulo', 'css', 'item','url'],
        methods:{
            preencheFormulario:function(){

                axios.get(this.url + this.item.id).then(res => {
                    // console.log mostra o que está na tela
                    //console.log(res.data);
                     this.$store.commit('setItem', res.data);
                });

                /* o $store é instanciado no arquivo (resources/assets/js/componetes/app.js) e posso acessar seus métodos (ex: setItem) em qualuqer lugar */
                //this.$store.commit('setItem', this.item);
            }
        }
    }
</script>