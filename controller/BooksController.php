<?php
/**
* BooksController.php
*
* A controller to check the book
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
use model\Book;
class BooksController extends Book
{
    public function send_json($error, $data)
    {
        echo json_encode(array("error" => $error, "data" => $data));
    }

    public function get_all()
    {
        $bdd = new Bdd();

        $get_books = $bdd->getBdd()->prepare('SELECT * FROM books');
        $get_books->execute();
        $books = $get_books->fetch(\PDO::FETCH_ASSOC);
        self::send_json(null, $books);
    }
}