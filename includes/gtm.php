<?php
/**
 * Google Tag Manager Include
 * 
 * Usage:
 *   require_once __DIR__ . '/includes/gtm.php';  (from root)
 *   require_once __DIR__ . '/../includes/gtm.php'; (from public/)
 * 
 *   In <head>:  <?php gtm_head(); ?>
 *   After <body>: <?php gtm_body(); ?>
 */

function gtm_head()
{
    echo '<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':
new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=
\'https://www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,\'script\',\'dataLayer\',\'GTM-TZVKZTX4\');</script>
<!-- End Google Tag Manager -->';
}

function gtm_body()
{
    echo '<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TZVKZTX4"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->';
}
