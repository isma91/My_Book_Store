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

    public function add_book($book_name, $author, $editor, $type, $tab_kind, $cover, $date, $resume)
    {
        $bdd = new Bdd();
        $kind = implode(";", $tab_kind);
        $date = intval(substr($date, -4));
        $file_name = uniqid("cover_", true);
        $file_type = $cover["type"];
        $file_tmp_name = $cover["tmp_name"];
        $file_error = $cover["error"];
        $file_size = $cover["size"];
        if ($file_error !== 0) {
            self::send_json("An error occurred while we take the picture !!", null);
        }
        if (substr($file_type, 0, 5) !== "image") {
            self::send_json("You don't send a picture !!", null);
        } elseif ($file_size > 5242880) {
            self::send_json("Your picture is more than 5Mo !!", null);
        } else {
            $create = $bdd->getBdd()->prepare('INSERT INTO `books`(`name`, `author`, `editor`, `year`, `kind`, `type`, `resume`) VALUES (:name, :author, :editor, :year, :kind, :type, :resume)');
            $create->bindParam(':name', $book_name);
            $create->bindParam(':author', $author);
            $create->bindParam(':editor', $editor);
            $create->bindParam(':year', $date);
            $create->bindParam(':kind', $kind);
            $create->bindParam(':type', $type);
            $create->bindParam(':resume', $resume);
            if (!$create->execute()) {
                self::send_json('A problem occurred while creating the book in the database !! Please contact the admin of the site !!', null);
            }
            if (rename($file_tmp_name, __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "cover" . DIRECTORY_SEPARATOR . $file_name)) {
                $update = $bdd->getBdd()->prepare('UPDATE books SET cover = :cover WHERE id = :id');
                $update->bindParam(':cover', $file_name);
                $update->bindParam(':id', $bdd->getBdd()->lastInsertId());
                if (!$update->execute()) {
                    self::send_json('A problem occurred while adding the cover in the database !! Please contact the admin of the site !!', null);
                } else {
                    self::send_json(null, null);
                }
            } else {
                self::send_json('A problem occurred while adding the cover in the server !! Please contact the admin of the site !!', null);
            }
        }
    }
}