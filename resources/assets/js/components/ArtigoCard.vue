<template>
    <div v-bind:class="'col-sm-'+ (sm || '6') + ' col-md-'+ (md || '4')">
        <div class="thumbnail">
            <img src="http://fomedeescrever.com.br/wp-content/uploads/2018/10/trancado-752x440.jpg" alt="...">
            <div class="caption">
                <small>{{data}}- {{autor}}</small>
                <h3>{{titulo}}</h3>
                <p>{{descricao}}</p>
                <p><a v-bind:href="link" class="btn btn-primary" role="button">Leia Mais</a></p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['titulo','descricao','link','imagem','data','autor','sm','md']
    }
</script>