<?php
/**
* User.php
*
* The model of User
*
* PHP 7.0.4-7ubuntu2.1 (cli) ( NTS )
*
* @category Controller
* @package  Controller
* @author   isma91 <ismaydogmus@gmail.com>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
*/
namespace model;
class User
{
	private $_login;
	private $_pass;
	private $_token;

	public function setLogin($login)
	{
		$this->$_login = $login;
	}
	public function setPass($pass)
	{
		$this->$_pass = $pass;
	}
	public function setToken($token)
	{
		$this->$_token = $token;
	}

	private function getLogin()
	{
		return $this->$_login;
	}
	private function getPass()
	{
		return $this->$_pass;
	}
	private function getToken()
	{
		return $this->$_token;
	}
}