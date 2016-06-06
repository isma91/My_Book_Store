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
$user = new UsersController();
switch ($_POST["action"]) {
	case 'connexion':
	$user->connexion($_POST["login"], $_POST["pass"]);
	break;
}