<?php

/*
Plugin Name: WordPress Multilingual
Description: Snippets
Author: Naelson
Version: 1.0.0
*/

add_action('admin_menu', 'multilingual_menu');
function multilingual_menu()
{
    add_menu_page(
        'Multilingual Tutorial',
        'Multilingual Tutorial',
        'manage_options',
        'multilingual-tutorial',
        'func_multilingual_tutorial'
    );

    add_submenu_page(
        'multilingual-tutorial',
        'Sub Menu',
        'Sub Menu',
        'manage_options',
        'multilingual-tutorial-submenu',
        'func_multilingual_tutorial_submenu'
    );
}

function func_multilingual_tutorial()
{
    _e("Custom Code", 'multilanguage');
}

function func_multilingual_tutorial_submenu()
{
    _e("Custom Code", 'multilanguage');
}

add_action('plugins_loaded', 'plugin_init');

function plugin_init()
{

    load_plugin_textdomain('multilanguage', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}

$tranlate_select = 'en';
if ($tranlate_select == 'es') {
    define('WPLANG', 'es_ES');
}
