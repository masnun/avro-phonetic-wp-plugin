<?php

    /**
     * @package Avro Phonetic WP Plugin
     * @version 1.1
     */
    /*
     Plugin Name: Avro Phonetic WP Plugin
     Plugin URI: http://www.masnun.me/2011/11/11/avro-phonetic-wp-plugin.html
     Description: Adds Avro Phonetic to all your text inputs
     Author: Masnun
     Version: 1.1
     Author URI: http://masnun.com
    */

    //Admin Section
    add_action('admin_head', 'avro_phonetic_styles_admin');
    add_action('admin_head', 'avro_phonetic');
    add_action('admin_footer', 'avro_phonetic_notif');

    // Blog View
    add_action("widgets_init", "avro_phonetic_register_widget");

    add_action('wp_head', 'avro_phonetic_styles');
    add_action('wp_head', 'avro_phonetic');
    add_action('wp_footer', 'avro_phonetic_notif');


    function avro_phonetic_disclaimer()
    {
        echo 'Bangla input is proudly powered by <a href="http://www.masnun.me/2011/11/11/avro-phonetic-wp-plugin.html" target="_blank">Avro Phonetic WP Plugin</a> ';
    }

    function avro_phonetic_register_widget()
    {
        register_widget("AvroPhoneticWidget");
    }

    function avro_phonetic_styles_admin()
    {
        ?>

    <style type="text/css">
        #avro-phonetic-notif {
            border: 0;
            position: fixed;
            top: 200px;
            right: 0;

        }
    </style>
    <?php

    }

    function avro_phonetic_styles()
    {
        ?>

    <style type="text/css">
        #avro-phonetic-notif {
            border: 0;
            position: fixed;
            top: 200px;
            right: 0;

        }

    </style>
    <?php

    }

    function avro_phonetic_notif()
    {
        echo '<div id="avro-phonetic-notif"><img src="https://github.com/masnun/Avro-Phonetic-WP-Plugin/raw/master/avro-english.png" width="50px" height="50px" alt="E" /></div>';
    }


    function avro_phonetic()
    {
        ?>
    <script type="text/javascript">


        var root = (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]);
        var ns = document.createElementNS && document.documentElement.namespaceURI;

        if (typeof jQuery === 'undefined') {
            var script = ns ? document.createElementNS(ns, 'script') : document.createElement('script');
            script.type = 'text/javascript';
            script.onreadystatechange = function () {
                if (this.readyState == 'complete') enable_avro();
            }
            script.onload = enable_avro;
            script.src = 'https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.min.js';
            root.appendChild(script);
        }
        else {
            enable_avro();
        }

        function enable_avro() {
            jQuery.noConflict();
            var script = ns ? document.createElementNS(ns, 'script') : document.createElement('script');
            script.type = 'text/javascript';
            script.onreadystatechange = function () {
                if (this.readyState == 'complete') avro_js_loader();
            }
            script.onload = avro_js_loader;
            script.src = 'https://raw.github.com/torifat/jsAvroPhonetic/master/dist/avro-latest.js';
            root.appendChild(script);

            preload_avro_images();

        }

        function avro_js_loader() {
            jQuery(function() {
                jQuery('textarea, input[type=text]').avro({'bn':false}, function(isBangla){
	                if (isBangla) {
	                    jQuery("#avro-phonetic-notif").html('<img src="https://github.com/masnun/Avro-Phonetic-WP-Plugin/raw/master/avro-bangla.png" width="50px" height="50px" alt="অ" />')
	                }
	                else {
	                    jQuery("#avro-phonetic-notif").html('<img src="https://github.com/masnun/Avro-Phonetic-WP-Plugin/raw/master/avro-english.png" width="50px" height="50px" alt="E" />')
	                }
                });

                jQuery("#avro-phonetic-notif").hide();

                jQuery('textarea, input[type=text]').focus(function() {
                    jQuery("#avro-phonetic-notif").show();
                });

                jQuery('textarea, input[type=text]').blur(function() {
                    jQuery("#avro-phonetic-notif").hide();
                });

            });
        }


        function preload_avro_images() {

            var avro_preload = ['https://github.com/masnun/Avro-Phonetic-WP-Plugin/raw/master/avro-bangla.png', 'https://github.com/masnun/Avro-Phonetic-WP-Plugin/raw/master/avro-english.png'];
            var avro_images = [];

            for (var i = 0; i < avro_preload.length; i++) {
                avro_images[i] = new Image();
                avro_images[i].src = avro_preload[i];
            }
        }
    </script>

    <?php

    }

    // WordPress Widget

    class AvroPhoneticWidget extends WP_Widget {

        function AvroPhoneticWidget()
        {
            $widget_ops = array(
                "classname" => "AvroPhoneticWidget",
                "description" => "Adds Avro Phonetic Layout"
            );
            $this->WP_Widget('AvroPhoneticWidget', 'Avro Phonetic', $widget_ops);
        }

        function widget($args, $instance)
        {
            extract($args);
            echo $before_widget;
            echo $before_title;
            echo '<img src="https://github.com/masnun/Avro-Phonetic-WP-Plugin/raw/master/avro-bangla.png" width="50px" height="50px" alt="অ" />';
            echo $after_title;
            echo "The blog supports Avro Phonetic. Press <strong>Ctrl + M</strong> to switch keyboard.<br/>";
            avro_phonetic_disclaimer();
            echo $after_widget;
        }

    }
