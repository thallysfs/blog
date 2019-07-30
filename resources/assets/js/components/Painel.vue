<template>
    <div v-bind:class="defineCor">
        <div v-if="titulo" class="panel-heading">{{titulo}}</div>

            <div class="panel-body">
                <slot></slot>
            </div>
    </div>
</template>

<script>
    export default {
        props:['titulo', 'cor'],
        computed:{
            defineCor: function(){
                return "panel "+ (this.cor || "panel-default" );
            }    
        }
    }
</script>

<style media="screen">
    .blue {
        border-color: #075ca0;
    }

    .blue > .panel-heading {
        color: #dfe7ec;
        background-color: #075ca0;
        border-color: #075ca0;
    }

    .orange {
        border-color: #ec921c;
    }

    .orange > .panel-heading {
        color: #dfe7ec;
        background-color: #ec921c;
        border-color: #ec921c;
    }
</style>
