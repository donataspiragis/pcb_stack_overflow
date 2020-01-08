{% extends 'layout.php' %}

{% block body %}

<head>
<style>
body {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    background: #000;
    text-align:center;
    font-family: "Lucida Console", sans-serif;
}
.navbar{
    z-index: 10;
}
.green-outline {
    z-index: 2;
    text-shadow:
    -1px -1px 0 #030,
        1px -1px 0 #030,
        -1px 1px 0 #030,
        1px 1px 0 #030;
}
#http-code {
    top: 18%;
    position: relative;
    margin: 0 auto;
    margin-top: 0;
    z-index: 2;
    text-shadow:
    -1px -1px 0 #030,
        1px -1px 0 #030,
        -1px 1px 0 #030,
        1px 1px 0 #030;
}
canvas {
    position: absolute;
    top: 0;
    left: 0;
}
/* Yep, responsive 404 pages */
@media (max-width: 600px) {
    #http-code {
        top: 25px;
    }
}
/* Fade in */
.fade-in {
-webkit-animation: fadein 1200ms;
-moz-animation: fadein 1200ms;
-ms-animation: fadein 1200ms;
-o-animation: fadein 1200ms;
animation: fadein 1200ms;
}
@keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}
@-moz-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}
@-webkit-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}
@-ms-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}
@-o-keyframes fadein {
    from { opacity: 0; }
    to   { opacity: 1; }
}
</style>
</head>
<div>
<h1 id="http-code" class="green-outline fade-in">404</h1>
    <canvas id=cv></canvas>
    <script>
    /*
    * Matrix 404
    * Credit to timelessname.com for the idea
    */
    function resizeCanvas() {
        w = cv.width = window.innerWidth;
        h = cv.height = window.innerHeight;
    }
var chars = [];
var w, h;
resizeCanvas();
options = {
    fadeSpeed: 0.01,
    velocity: 23,
    charsWidth: 256,
    color: '#0F0',
    charOffset: 3e4,
    frequency: 1e6
};
// Initialize chars with 1s
while(options.charsWidth--) chars.push(1);
tick = function() {
    // Update canvas width/height
    if (w != window.innerWidth || h != window.innerHeight) {
        resizeCanvas();
    }
    cv.getContext('2d').fillStyle='rgba(0,0,0,' + options.fadeSpeed + ')';
    cv.getContext('2d').fillRect(0,0,w,h);
    cv.getContext('2d').fillStyle=options.color;
    // Enter the matrix
    chars.map(function(y, x) {
        cv.getContext('2d').fillText(String.fromCharCode(3e4 +  Math.random() * 33), x*10, y);
        chars[x] = y > 758 + Math.random() * 1e4 ? 0 : y + 10
    });
}
setInterval(tick, options.velocity)
</script>
<script>
    /*!
    * FitText.js 1.0 jQuery free version
    *
    * Copyright 2011, Dave Rupert http://daverupert.com
    * Released under the WTFPL license
    * http://sam.zoy.org/wtfpl/
    * Modified by Slawomir Kolodziej http://slawekk.info
    *
    * Date: Tue Aug 09 2011 10:45:54 GMT+0200 (CEST)
    */
    (function(){
        var css = function (el, prop) {
            return window.getComputedStyle ? getComputedStyle(el).getPropertyValue(prop) : el.currentStyle[prop];
        };
        var addEvent = function (el, type, fn) {
            if (el.addEventListener)
                el.addEventListener(type, fn, false);
            else
                el.attachEvent('on'+type, fn);
        };
        var extend = function(obj,ext){
            for(key in ext)
                if(ext.hasOwnProperty(key))
                    obj[key] = ext[key];
            return obj;
        };
        window.fitText = function (el, kompressor, options) {
            var settings = extend({
                'minFontSize' : -1/0,
                'maxFontSize' : 1/0
            },options);
            var fit = function (el) {
                var compressor = kompressor || 1;
                var resizer = function () {
                    el.style.fontSize = Math.max(Math.min(el.clientWidth / (compressor*10), parseFloat(settings.maxFontSize)), parseFloat(settings.minFontSize)) + 'px';
                };
                // Call once to set.
                resizer();
                // Bind events
                // If you have any js library which support Events, replace this part
                // and remove addEvent function (or use original jQuery version)
                addEvent(window, 'resize', resizer);
            };
            if (el.length)
                for(var i=0; i<el.length; i++)
                    fit(el[i]);
            else
                fit(el);
            // return set of elements
            return el;
        };
    })();
</script>
<script>
    window.fitText(document.getElementById("http-code"), 0.35);
</script>
</div>
{% endblock %}