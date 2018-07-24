<template>
<div>
    <canvas ref="fabricCanvas"></canvas>
</div>
</template>

<script>
import "fabric/dist/fabric.js"
export default {
    mounted () {
        // create a wrapper around native canvas element (with id="c")
        const canvas = new fabric.Canvas(this.$refs.fabricCanvas);

        // create a rectangle object
        const rect = new fabric.Rect({
        left: 100,
        top: 100,
        fill: 'red',
        width: 20,
        height: 20
        });

        // "add" rectangle onto canvas
        canvas.add(rect);
    }
}
</script>
