<?php
/**
* Index.php
*
* Index who check if the project is installed or not
* Switch view compared to the request
*
* PHP 7.0.4-7ubuntu2.1 (cli) ( NTS )
*
* @category Controller
* @package  Controller
* @author   isma91 <ismaydogmus@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
*/
session_start();
require 'autoload.php';
use controller\UsersController;
$connected = UsersController::is_connected();
function go_to_view ($page) {
	if ($page === "home_page") {
		if (UsersController::is_connected() === true) {
			include "./view/books.php";
		} else {
			include "./view/home_page.php";
		}
	} else {
		if (UsersController::is_connected() === true) {
			include "./view/" . $page . ".php";
		} else {
			include "./view/home_page.php";
		}
	}
}
if ($_GET) {
	switch ($_GET["page"]) {
		case 'home':
		go_to_view("home_page");
		break;
		case 'books':
		go_to_view("books");
		break;
		case 'customers':
		go_to_view("customers");
		break;
		case 'commands':
		go_to_view("commands");
		break;
		case 'add_book':
		go_to_view("add_book");
		break;
		case 'add_customer':
		go_to_view("add_customer");
		break;
		case 'add_command':
		go_to_view("add_command");
		break;
		default:
		go_to_view("books");
		break;
	}
} else {
	go_to_view("home_page");
}