<?php

/**
 * @package Avro Phonetic WP Plugin
 * @version 1
 */
/*
  Plugin Name: Avro Phonetic WP Plugin
  Plugin URI: http://www.masnun.me/2011/11/11/avro-phonetic-wp-plugin.html
  Description: Adds Avro Phonetic to all your text inputs
  Author: Masnun
  Version: 1
  Author URI: http://masnun.com
 */

add_action('admin_head', 'avro_phonetic');
add_action('wp_head', 'avro_phonetic');
add_action('wp_footer', 'avro_phonetic_notif');
add_action('admin_footer', 'avro_phonetic_notif');

function avro_phonetic_notif()
{
    echo '<div id="avro-phonetic-notif">E</div>';
}

function avro_phonetic()
{
    ?>

    <style type="text/css">
        #avro-phonetic-notif { 
            border: 0;
            position: fixed;
            top: 200px; 
            right:0;
            width: 50px;
            height: 50px;
            background-color: #000;
            color: #ffff33;
            font-weight: bold;
            text-align: center;
            padding-top: 25px; 
            
        }
    </style>


    <script type="text/javascript">
                        
                            
        var root = (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]);
        var ns = document.createElementNS && document.documentElement.namespaceURI;

        if(typeof jQuery === 'undefined') {
            var script = ns ? document.createElementNS(ns, 'script') : document.createElement('script');
            script.type = 'text/javascript';
            script.onreadystatechange = function () {
                if (this.readyState == 'complete') enable_avro();
            }
            script.onload= enable_avro;
            script.src= 'https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.min.js';
            root.appendChild(script);
        } else {
            enable_avro();
        }

        function enable_avro() {
            jQuery.noConflict();
            var script = ns ? document.createElementNS(ns, 'script') : document.createElement('script');
            script.type = 'text/javascript';
            script.onreadystatechange = function () {
                if (this.readyState == 'complete') avro_js_loader();
            }
            script.onload= avro_js_loader;
            script.src= 'https://raw.github.com/torifat/jsAvroPhonetic/master/src/avro-latest.js';
            root.appendChild(script);
                                
        }

        function avro_js_loader() {
            jQuery('textarea, input[type=text]').live('focus', function() {
                jQuery(this).avro('destroy').avro({'bn':false}, function(isBangla){
                    if(isBangla) {
                        jQuery("#avro-phonetic-notif").html("অ")   
                    } else {
                        jQuery("#avro-phonetic-notif").html("E")           
                    }
                });
            }).avro('destroy').avro();
        }

                                
    </script>
    <?

}
