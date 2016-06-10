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
        $get_books = $bdd->getBdd()->prepare('SELECT * FROM books');
        $get_books->execute();
        $books = $get_books->fetchAll(\PDO::FETCH_ASSOC);
        self::send_json(null, $books);
    }

    public function add_book($book_name, $author, $editor, $type, $tab_kind, $cover, $date, $resume)
    {
        $bdd = new Bdd();
        $kind = implode(";", $tab_kind);
        $date = intval(substr($date, -4));
        $cover_file_name = $cover["name"];
        $file_type = $cover["type"];
        $file_tmp_name = $cover["tmp_name"];
        $file_error = $cover["error"];
        $file_size = $cover["size"];
        $exploded_file_name = explode(".", $cover_file_name);
        $exploded_file_name[0] = uniqid("cover_", true);
        for ($i = 0; $i < count($exploded_file_name); $i = $i + 1) {
            if ($i !== (count($exploded_file_name) -1)) {
                $exploded_file_name[$i] = $exploded_file_name[$i] . ".";
            }
        }
        $file_name = implode('', $exploded_file_name);
        if ($file_error !== 0) {
            self::send_json("An error occurred while we take the picture !!", null);
            return false;
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
                return false;
            }
            if (rename($file_tmp_name, __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "media" . DIRECTORY_SEPARATOR . "cover" . DIRECTORY_SEPARATOR . $file_name)) {
                chmod(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "media" . DIRECTORY_SEPARATOR . "cover" . DIRECTORY_SEPARATOR . $file_name, 0777);
                $update = $bdd->getBdd()->prepare('UPDATE books SET cover = :cover WHERE id = :id');
                $update->bindParam(':cover', $file_name);
                $update->bindParam(':id', $bdd->getBdd()->lastInsertId());
                if (!$update->execute()) {
                    self::send_json('A problem occurred while adding the cover in the database !! Please contact the admin of the site !!', null);
                    return false;
                } else {
                    self::send_json(null, null);
                    return false;
                }
            } else {
                self::send_json('A problem occurred while adding the cover in the server !! Please contact the admin of the site !!', null);
                return false;
            }
        }
    }

    public function edit_book($id, $book_name, $author, $editor, $type, $kind, $cover, $date, $resume)
    {
        $bdd = new Bdd();
        $change_cover = true;
        $get_book = $bdd->getBdd()->prepare("SELECT * FROM books WHERE id = :id");
        $get_book->bindParam(":id", $id);
        $get_book->execute();
        $book = $get_book->fetch(\PDO::FETCH_ASSOC);
        if ($type === null) {
            $type = $book["type"];
        }
        if ($kind === null) {
            $kind = $book["kind"];
        } else {
            $kind = implode(";", $kind);
        }
        if ($cover === null) {
            $change_cover = false;
            $cover = $book["cover"];
            $file_type = "image";
            $file_size = 5000000;
        } else {
            $cover_file_name = $cover["name"];
            $file_type = $cover["type"];
            $file_tmp_name = $cover["tmp_name"];
            $file_error = $cover["error"];
            $file_size = $cover["size"];
            $exploded_file_name = explode(".", $cover_file_name);
            $exploded_file_name[0] = uniqid("cover_", true);
            for ($i = 0; $i < count($exploded_file_name); $i = $i + 1) {
                if ($i !== (count($exploded_file_name) -1)) {
                    $exploded_file_name[$i] = $exploded_file_name[$i] . ".";
                }
            }
            $file_name = implode('', $exploded_file_name);
            if ($file_error !== 0) {
                self::send_json("An error occurred while we take the picture !!", null);
                return false;
            }
        }
        if (substr($file_type, 0, 5) !== "image") {
            self::send_json("You don't send a picture !!", null);
        } elseif ($file_size > 5242880) {
            self::send_json("Your picture is more than 5Mo !!", null);
        } else {
            $create = $bdd->getBdd()->prepare('UPDATE `books` SET `name` = :name, `author` = :author, `editor` = :editor, `year` = :year, `kind` = :kind, `type` = :type, `resume` = :resume WHERE id = :id');
            $create->bindParam(':name', $book_name);
            $create->bindParam(':author', $author);
            $create->bindParam(':editor', $editor);
            $create->bindParam(':year', $date);
            $create->bindParam(':kind', $kind);
            $create->bindParam(':type', $type);
            $create->bindParam(':resume', $resume);
            $create->bindParam(':id', $id);
            if (!$create->execute()) {
                self::send_json('A problem occurred while updating the book in the database !! Please contact the admin of the site !!', null);
                return false;
            }
            if ($change_cover === true) {
                if (rename($file_tmp_name, __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "media" . DIRECTORY_SEPARATOR . "cover" . DIRECTORY_SEPARATOR . $file_name)) {
                    chmod(__DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "media" . DIRECTORY_SEPARATOR . "cover" . DIRECTORY_SEPARATOR . $file_name, 0777);
                    $update = $bdd->getBdd()->prepare('UPDATE books SET cover = :cover WHERE id = :id');
                    $update->bindParam(':cover', $file_name);
                    $update->bindParam(':id', $id);
                    if (!$update->execute()) {
                        self::send_json('A problem occurred while adding the cover in the database !! Please contact the admin of the site !!', null);
                        return false;
                    } else {
                        self::send_json(null, null);
                        return false;
                    }
                } else {
                    self::send_json('A problem occurred while adding the cover in the server !! Please contact the admin of the site !!', null);
                    return false;
                }
            } else {
                self::send_json(null, null);
                return false;
            }
        }
    }

    public function get_book($id, $token)
    {
        $id = intval($id);
        if (!is_int($id)) {
            self::send_json("The id of the book mus be an integer !!", null);
            return false;
        }
        if (!$this->_check_token($token)) {
            self::send_json("Bad token !! Logout and login to avoid the problem !!", null);
            return false;
        }
        $bdd = new Bdd();
        $get_book = $bdd->getBdd()->prepare("SELECT * FROM books WHERE id = :id");
        $get_book->bindParam(":id", $id);
        $get_book->execute();
        $book = $get_book->fetch(\PDO::FETCH_ASSOC);
        self::send_json(null, $book);
    }
    public function remove_book($id, $token)
    {
        $id = intval($id);
        if (!is_int($id)) {
            self::send_json("The id of the book mus be an integer !!", null);
            return false;
        }
        if (!$this->_check_token($token)) {
            self::send_json("Bad token !! Logout and login to avoid the problem !!", null);
            return false;
        }
        $bdd = new Bdd();
        $remove_book = $bdd->getBdd()->prepare("DELETE FROM books WHERE id = :id");
        $remove_book->bindParam(":id", $id);
        if (!$remove_book->execute()) {
            self::send_json('A problem occurred while removing the book in the database !! Please contact the admin of the site !!', null);
        } else {
            self::send_json(null, null);
        }
    }
}