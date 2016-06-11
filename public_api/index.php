<?php
/**
* Index.php
*
* All ajax request go here and be sended to different Controller
*
* PHP 7.0.6-1+donate.sury.org~xenial+1 (cli) ( NTS )
*
* @category Controller
* @package  Controller
* @author   isma91 <ismaydogmus@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
*/
session_start();
require '../autoload.php';
use controller\UsersController;
use controller\BooksController;
use controller\CustomersController;
use controller\OrdersController;
$user = new UsersController();
$book = new BooksController();
$customer = new CustomersController();
$order = new OrdersController();
switch ($_POST["action"]) {
	case 'connexion':
	$user->connexion($_POST["login"], $_POST["pass"]);
	break;
	case 'get_all_books':
	$book->get_all();
	break;
	case 'logout':
	$user->logout($_POST['token']);
	break;
	case 'add_book':
	$book->add_book($_POST["book_name"], $_POST["author"], $_POST["editor"], $_POST["type"], $_POST["kind"], $_FILES["cover"], $_POST["date"], $_POST["resume"]);
	break;
	case 'get_book':
	$book->get_book($_POST["id"], $_SESSION["token"]);
	break;
	case 'edit_book':
	$book->edit_book($_POST['id'], $_POST["book_name"], $_POST["author"], $_POST["editor"], $_POST["type"], $_POST["kind"], $_FILES["cover"], $_POST["date"], $_POST["resume"]);
	break;
	case 'remove_book':
	$book->remove_book($_POST['id'], $_SESSION["token"]);
	break;
	case 'add_customer':
	$customer->add_customer($_POST["firstname"], $_POST["lastname"], $_POST["adresse"], $_POST["city"], $_POST["email"]);
	break;
	case 'get_all_customers':
	$customer->get_all();
	break;
	case 'get_customer':
	$customer->get_customer($_POST["id"], $_SESSION["token"]);
	break;
	case 'edit_customer':
	$customer->edit_customer($_POST["id"], $_POST["firstname"], $_POST["lastname"], $_POST["adresse"], $_POST["city"], $_POST["email"]);
	break;
	case 'remove_customer':
	$customer->remove_customer($_POST['id'], $_SESSION["token"]);
	break;
	case 'add_order':
	$order->add_order($_POST["type"], $_POST["id_book"], $_POST["id_customer"]);
	break;
	case 'get_all_orders':
	$order->get_all();
	break;
	case 'get_order':
	$order->get_order($_POST["id"], $_SESSION["token"]);
	break;
	case 'edit_order':
	$order->edit_order($_POST["id_order"], $_POST["type"], $_POST["id_book"], $_POST["id_customer"]);
	break;
	case 'remove_order':
	$order->remove_order($_POST['id'], $_SESSION["token"]);
	break;
}