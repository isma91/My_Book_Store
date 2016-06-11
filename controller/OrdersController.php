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
        $get_orders = $bdd->getBdd()->prepare('SELECT orders.id AS "id", orders.type AS "type", books.name AS "book_name", customers.firstname AS "firstname", customers.lastname AS "lastname"  FROM `orders` INNER JOIN books ON books.id = orders.id_book INNER JOIN customers ON customers.id = orders.id_customer');
        $get_orders->execute();
        $orders = $get_orders->fetchAll(\PDO::FETCH_ASSOC);
        self::send_json(null, $orders);
    }

    private function _check_token ($token)
    {
        $bdd = new Bdd();
        $get_token = $bdd->getBdd()->prepare("SELECT token FROM users WHERE id = :id");
        $get_token->bindParam(":id", $_SESSION["id"]);
        $get_token->execute();
        $bdd_token = $get_token->fetch(\PDO::FETCH_ASSOC);
        if ($token === $bdd_token["token"]) {
            return true;
        } else {
            return false;
        }
    }

    public function add_order($type, $id_customer, $id_book)
    {
        $bdd = new Bdd();
        $get_customer_order = $bdd->getBdd()->prepare("SELECT * FROM orders WHERE id_customer = :id_customer");
        $get_customer_order->bindParam(":id_customer", $id_customer);
        $get_customer_order->execute();
        $customers_orders = $get_customer_order->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($customers_orders as $object) {
            if ($object["id_customer"] === $id_customer && $object["id_book"] === $id_book && $object["type"] === $type) {
                self::send_json("Order already saved in the database !!", null);
                return fasle;
            }
        }
        $create = $bdd->getBdd()->prepare('INSERT INTO `orders`(`type`, `id_customer`, `id_book`) VALUES (:type, :id_customer, :id_book)');
        $create->bindParam(':type', $type);
        $create->bindParam(':id_customer', $id_customer);
        $create->bindParam(':id_book', $id_book);
        if (!$create->execute()) {
            self::send_json('A problem occurred while creating the order in the database !! Please contact the admin of the site !!', null);
        } else {
            self::send_json(null, null);
        }
    }

    public function get_order($id, $token)
    {
        $id = intval($id);
        if (!is_int($id)) {
            self::send_json("The id of the order must be an integer !!", null);
            return false;
        }
        if (!$this->_check_token($token)) {
            self::send_json("Bad token !! Logout and login to avoid the problem !!", null);
            return false;
        }
        $bdd = new Bdd();
        $get_order = $bdd->getBdd()->prepare("SELECT * FROM orders WHERE id = :id");
        $get_order->bindParam(":id", $id);
        $get_order->execute();
        $order = $get_order->fetch(\PDO::FETCH_ASSOC);
        self::send_json(null, $order);
    }

    public function edit_order($id, $type, $id_customer, $id_book)
    {
        $bdd = new Bdd();
        $update = $bdd->getBdd()->prepare('UPDATE `orders` SET `type` = :type, `id_customer` = :id_customer, `id_book` = :id_book WHERE id = :id');
        $update->bindParam(':type', $type);
        $update->bindParam(':id_customer', $id_customer);
        $update->bindParam(':id_book', $id_book);
        $update->bindParam(':id', $id);
        if (!$update->execute()) {
            self::send_json('A problem occurred while updating the order in the database !! Please contact the admin of the site !!', null);
        } else {
            self::send_json(null, null);
        }
    }

    public function remove_order($id, $token)
    {
        $id = intval($id);
        if (!is_int($id)) {
            self::send_json("The id of the order must be an integer !!", null);
            return false;
        }
        if (!$this->_check_token($token)) {
            self::send_json("Bad token !! Logout and login to avoid the problem !!", null);
            return false;
        }
        $bdd = new Bdd();
        $remove_order = $bdd->getBdd()->prepare("DELETE FROM orders WHERE id = :id");
        $remove_order->bindParam(":id", $id);
        if (!$remove_order->execute()) {
            self::send_json('A problem occurred while removing the order in the database !! Please contact the admin of the site !!', null);
        } else {
            self::send_json(null, null);
        }
    }

}