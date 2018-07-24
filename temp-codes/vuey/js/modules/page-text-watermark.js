require('canvas2svg')
export default {

watermark(text) {
    const ctx = new C2S(150,40);
    ctx.font = "10px Courier";
    ctx.fillStyle = "rgba(160, 160, 160, 0.3)";
    ctx.rotate(-10 * Math.PI / 180);
    ctx.fillText(text, 10, 40);
    document.body.style.background = 'url(\'data:image/svg+xml;utf8,' + ctx.getSerializedSvg(true) + '\')';
}

}
