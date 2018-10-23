<?php
/*
Plugin Name:  Kaliel Compta
Plugin URI:   https://developer.wordpress.org/plugins/the-basics/
Description:  Export woocommerce dans un fichier csv pour compta
Version:      1
Author:       Kaliel
Author URI:   kaliel.fr
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  kaliel
*/

class KalielCompta
{

    public function __construct()
    {
        add_menu_page(
            'Compta',
            'Compta',
            'edit_posts',
            'kaliel-compta',
            [$this, 'output'],
            'dashicons-analytics',
            30
        );

    }

    public function output()
    {
        echo '<h1>CACA</h1>';
    }

}


function KalielCompta()
{
    return new KalielCompta();
}

add_action('init', 'KalielCompta');