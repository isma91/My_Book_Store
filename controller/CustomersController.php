<?php
/**
* CustomersController.php
*
* A controller to get/add customer
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
use model\Customer;
class CustomersController extends Customer
{
    public function send_json($error, $data)
    {
        echo json_encode(array("error" => $error, "data" => $data));
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

    public function get_all()
    {
        $bdd = new Bdd();
        $get_customers = $bdd->getBdd()->prepare('SELECT customers.id AS "id", customers.firstname AS "firstname", customers.lastname AS "lastname", customers.adresse AS "adresse", customers.city AS "city", customers.email AS "email", COUNT(orders.id) AS "order" FROM `customers` LEFT JOIN orders ON customers.id = orders.id_customer GROUP BY customers.id');
        $get_customers->execute();
        $customers = $get_customers->fetchAll(\PDO::FETCH_ASSOC);
        self::send_json(null, $customers);
    }

    public function add_customer($firstname, $lastname, $adresse, $city, $email)
    {
        $bdd = new Bdd();
        $duplicate_email = false;
        $get_all_email = $bdd->getBdd()->prepare('SELECT email FROM `customers`');
        $get_all_email->execute();
        $emails = $get_all_email->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($emails as $value) {
            if ($value["email"] === $email) {
                $duplicate_email = true;
            }
        }
        if ($duplicate_email === true) {
            self::send_json("Email already used by another customer !!", null);
        } else {
            $create = $bdd->getBdd()->prepare('INSERT INTO `customers`(`firstname`, `lastname`, `adresse`, `city`, `email`) VALUES (:firstname, :lastname, :adresse, :city, :email)');
            $create->bindParam(':firstname', $firstname);
            $create->bindParam(':lastname', $lastname);
            $create->bindParam(':adresse', $adresse);
            $create->bindParam(':city', $city);
            $create->bindParam(':email', $email);
            if (!$create->execute()) {
                self::send_json('A problem occurred while creating the customer in the database !! Please contact the admin of the site !!', null);
            } else {
                self::send_json(null, null);
            }
        }
    }

    public function get_customer($id, $token)
    {
        $id = intval($id);
        if (!is_int($id)) {
            self::send_json("The id of the customer must be an integer !!", null);
            return false;
        }
        if (!$this->_check_token($token)) {
            self::send_json("Bad token !! Logout and login to avoid the problem !!", null);
            return false;
        }
        $bdd = new Bdd();
        $get_customer = $bdd->getBdd()->prepare("SELECT * FROM customers WHERE id = :id");
        $get_customer->bindParam(":id", $id);
        $get_customer->execute();
        $customer = $get_customer->fetch(\PDO::FETCH_ASSOC);
        self::send_json(null, $customer);
    }

    public function edit_customer($id, $firstname, $lastname, $adresse, $city, $email)
    {
        $bdd = new Bdd();
        $duplicate_email = false;
        $get_all_email = $bdd->getBdd()->prepare('SELECT email FROM `customers` WHERE id != :id');
        $get_all_email->bindParam(":id", $id);
        $get_all_email->execute();
        $emails = $get_all_email->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($emails as $value) {
            if ($value["email"] === $email) {
                $duplicate_email = true;
            }
        }
        if ($duplicate_email === true) {
            self::send_json("Email already used by another customer !!", null);
        } else {
            $update = $bdd->getBdd()->prepare('UPDATE `customers` SET `firstname` = :firstname, `lastname` = :lastname, `adresse` = :adresse, `city` = :city, `email` = :email WHERE id = :id');
            $update->bindParam(':firstname', $firstname);
            $update->bindParam(':lastname', $lastname);
            $update->bindParam(':adresse', $adresse);
            $update->bindParam(':city', $city);
            $update->bindParam(':email', $email);
            $update->bindParam(':id', $id);
            if (!$update->execute()) {
                self::send_json('A problem occurred while updating the customer in the database !! Please contact the admin of the site !!', null);
            } else {
                self::send_json(null, null);
            }
        }
    }
}