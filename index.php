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
	if (UsersController::is_connected()) {
		include "./view/" . $page;
	} else {
		include "./view/home_page.php";
	}
}
if ($_GET) {
	switch ($_GET["page"]) {
		case 'books':
		go_to_view("books.php");
		break;
		default:
		go_to_view("books.php");
		break;
	}
} else {
	if ($connected) {
		go_to_view("books.php");
	} else {
		go_to_view("home_page.php");
	}
}