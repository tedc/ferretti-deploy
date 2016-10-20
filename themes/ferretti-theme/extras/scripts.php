<?php
// TYPEKIT

function typekit() {
    echo "<script>WebFontConfig = {typekit: { id: 'xcp6dvx' }, active: function() { document.body.classList.remove('loading');}};(function(d) {var wf = d.createElement('script'), s = d.scripts[0];wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js';s.parentNode.insertBefore(wf, s);})(document);</script>";
    
}
add_action('wp_footer', __NAMESPACE__ . '\\typekit');