<template>
    <div class="panel panel-default material-panel">
        <div class="panel-heading material-panel-heading"><strong>{{ heading }}</strong></div>
        <div class="panel-body material-panel-body"><slot></slot></div>
    </div>
</template>

<script>
    export default {
        props: ['heading']
    }
</script>

<style>
    .material-panel {
        border: none;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
    }
    .material-panel:hover {
        box-shadow: 0 3px 9px rgba(0,0,0,0.25), 0 3px 6px rgba(0,0,0,0.22);
    }
    .material-panel-heading {
        border-radius: 4px 4px 0 0;
        font-weight: 700;
        border: none;
        padding: 5px 22.5px;
    }
    .material-panel-body {
        background-color: #fff;
        padding: 10px 22.5px;
    }
    .material-panel-heading {
        /*background-color: #eee;*/
        /*color: #000;*/
    }
</style>
