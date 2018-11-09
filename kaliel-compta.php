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
        echo '<a class="button button-primary button-hero" href="http://labelpoulette.test/wp-admin/customize.php">Télécharger le fichier CSV</a>';
        echo '<hr>';
        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead><tr><td>Date</td><td>N° Facture</td><td>Client</td><td>Produits HT</td><td>TVA Produits</td><td>Produits TTC</td><td>Transport HT</td><td>TVA transport</td><td>Transport TTC</td></td><td>Total TTC</td><td>Règlement</td></tr></thead>';
        echo '<tbody>';

        foreach ($this->getOrders() as $order) {
            $montantHT = number_format((float)$order->get_total() - $order->get_total_tax() - $order->get_shipping_total(), wc_get_price_decimals(), '.', '');
            $montantTTC = number_format((float)$order->get_total() - $order->get_shipping_total() - $order->get_shipping_tax(), wc_get_price_decimals(), '.', '');
            $tva = number_format((float)$order->get_total_tax() - $order->get_shipping_tax(), wc_get_price_decimals(), '.', '');

            $transportHT = number_format((float)$order->get_shipping_total() - $order->get_shipping_tax(), wc_get_price_decimals(), '.', '');
            $transportTVA = number_format((float)$order->get_shipping_tax(), wc_get_price_decimals(), '.', '');
            $transportTTC = number_format((float)$order->get_shipping_total(), wc_get_price_decimals(), '.', '');


            echo '<tr>';
            echo '<td>' . $order->get_date_created()->date('d/m/Y') . '</td>';
            echo "<td></td>";
            echo '<td>' . $order->get_billing_first_name() . ' ' . $order->get_billing_last_name() . '</td>';
            echo "<td>{$montantHT}</td>";
            echo "<td>{$tva}</td>";
            echo "<td>{$montantTTC}</td>";
            echo "<td>{$transportHT}</td>";
            echo "<td>{$transportTVA}</td>";
            echo "<td>{$transportTTC}</td>";
            echo "<td>{$order->get_total()}</td>";
            echo "<td>{$order->get_payment_method_title()}</td>";
            echo '</tr>';
        }
        echo '</tbody>';
        echo '/<table>';
    }


    /**
     * @return WC_Order[]
     * @throws Exception
     */
    public function getOrders(): array
    {
        $query = new WC_Order_Query();
        $orders = $query->get_orders();
        return $orders;
    }

}


function KalielCompta()
{
    return new KalielCompta();
}

add_action('init', 'KalielCompta');