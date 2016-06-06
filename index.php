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

function go_to_view ($page) {
    include "./view/" . $page;
}
$connected = UsersController::is_connected();
if ($_GET) {
} else {
    if ($connected) {
    } else {
        go_to_view("home_page.php");
    }
}