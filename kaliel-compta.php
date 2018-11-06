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
        echo '<h1>Compta</h1>';
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead><tr><td>Date facture</td><td>N° Facture</td><td>Client</td><td>Montant HT</td><td>Montant TVA</td><td>Montant TTC</td><td>Règlement</td></tr></thead>';
        echo '<tbody>';

        foreach ($this->getOrders() as $order) {
            echo '<tr>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td>' . $order->get_user()->first_name . ' ' . $order->get_user()->last_name . '</td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '/<table>';
        echo '<pre>';
        var_dump($this->getOrders());
        echo '</pre>';
    }


    /**
     * @return WC_Order[]
     * @throws Exception
     */
    public function getOrders(): array
    {
        $query = new WC_Order_Query();
        $query->set('status', 'completed');
        $orders = $query->get_orders();
        return $orders;
    }

}


function KalielCompta()
{
    return new KalielCompta();
}

add_action('init', 'KalielCompta');