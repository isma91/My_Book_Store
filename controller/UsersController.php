<?php
/**
* UsersController.php
*
* A controller to check the user
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
use model\User;
class UsersController extends User
{
    public function send_json($error, $data)
    {
        echo json_encode(array("error" => $error, "data" => $data));
    }

    static public function is_connected ()
    {
        $bdd = new Bdd();
        if (!isset($_SESSION['id']) && !isset($_SESSION['token'])) {
            return false;
        }
        $get = $bdd->getBdd()->prepare('SELECT id, token, login FROM users WHERE id = :id AND token = :token');
        $get->bindParam(':id', $_SESSION['id']);
        $get->bindParam(':token', $_SESSION['token']);
        $get->execute();
        $user = $get->fetch(\PDO::FETCH_ASSOC);
        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    public function connexion($login, $password)
    {
        $bdd = new Bdd();

        $get_user = $bdd->getBdd()->prepare('SELECT id, pass FROM users WHERE login = :login');
        $get_user->bindParam(':login', $login);
        $get_user->execute();
        $user = $get_user->fetch(\PDO::FETCH_ASSOC);
        $hashed_pass = $user['pass'];
        if (!$hashed_pass) {
            self::send_json("Bad login or password", null);
            return false;
        }
        if (!$this->_check_password($password, $hashed_pass)) {
            self::send_json("Bad login or password", null);
            return false;
        }
        if (!$this->_update_token($user['id'])) {
            self::send_json("A problem occurred when we create a token for you !! Please contact the admin of the site !!", null);
        } else {
            self::send_json(null, null);
        }
    }

    private function _update_token($id)
    {
        $bdd = new Bdd();

        $token = sha1(time() * rand(1, 555));
        $update_token = $bdd->getBdd()->prepare('UPDATE users SET token = :token WHERE id = :id');
        $update_token->bindParam(':token', $token, \PDO::PARAM_STR, 60);
        $update_token->bindParam(':id', $id);
        if ($update_token->execute()) {
            $_SESSION['token'] = $token;
            $_SESSION['id'] = $id;
            return true;
        } else {
            return false;
        }
    }

    private function _hash_password($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function _check_password($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public function logout($id, $token)
    {
        $bdd = new Bdd();
        if (self::user_exist($id)) {
            $get_token = $bdd->getBdd()->prepare('SELECT token FROM users WHERE  id = :id AND active = 1');
            $get_token->bindParam(':id', $id);
            $get_token->execute();
            $user_token = $get_token->fetch(\PDO::FETCH_ASSOC);
            if ($user_token["token"] === $token) {
                session_destroy();
                self::send_json(null, null);
            } else {
                self::send_json("Bad token !! Please delete your cache and your cookie of this site !!", null);
            }
        } else {
            self::send_json("User not found !!", null);
        }
    }

}