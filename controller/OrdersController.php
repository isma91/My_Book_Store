<?php
/**
* OrdersController.php
*
* A controller to get/add order
*
* PHP 7.0.4-7ubuntu2.1 (cli) ( NTS )
*
* @category Controller
* @package  Controller
* @author   isma91 <ismaydogmus@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
*/
namespace controller;

use model\Bdd;
use model\Order;
class OrdersController extends Order
{
    public function send_json($error, $data)
    {
        echo json_encode(array("error" => $error, "data" => $data));
    }

    public function get_all()
    {
        $bdd = new Bdd();
        $get_customers = $bdd->getBdd()->prepare('SELECT * FROM `orders`');
        $get_customers->execute();
        $customers = $get_customers->fetchAll(\PDO::FETCH_ASSOC);
        self::send_json(null, $customers);
    }

}