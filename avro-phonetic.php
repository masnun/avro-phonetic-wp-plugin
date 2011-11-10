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

function avro_phonetic()
{
    
    ?>
    <script src="http://code.jquery.com/jquery-1.7.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://raw.github.com/torifat/jsAvroPhonetic/1.0-beta/src/avro-1.0-beta.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
        jQuery(function(){
            alertOn = false
            jQuery('textarea, input[type=text]').avro({'bn':false},
            function(isBangla){
                if(isBangla) {
                    if(alertOn) {
                        alert("Keyboard Switched to Bangla")
                    } else {
                        alertOn = true
                    }
                } else {
                    if(alertOn) {
                        alert("Keyboard Switched to English")
                    } else {
                        alertOn = true
                    }
                }
            });
        });

    </script>


    <?

}
