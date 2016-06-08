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
$user = new UsersController();
$book = new BooksController();
switch ($_POST["action"]) {
	case 'connexion':
	$user->connexion($_POST["login"], $_POST["pass"]);
	break;
	case 'get_all_books':
	$book->get_all();
	break;
	case 'logout':
	$user->logout($_POST['token']);
	case 'add_book':
	$book->add_book($_POST["book_name"], $_POST["author"], $_POST["editor"], $_POST["type"], $_POST["kind"], $_FILES["cover"], $_POST["date"], $_POST["resume"]);
	break;
}