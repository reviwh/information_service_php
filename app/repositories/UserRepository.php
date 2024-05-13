<?php


final class UserRepository
{
  private $table = 'tb_users';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function login($data)
  {
    $result = array();

    $stored_password = $this->getPassword($data['username']);

    if (isset($stored_password['password'])) {
      if (password_verify($data['password'], $stored_password['password'])) {
        $result["code"] = 200;
        $result["message"] = "Login success.";
      } else {
        $result["code"] = 400;
        $result["message"] = "Username or password isn't correct.";
      }
    } else {
      $result["code"] = 400;
      $result["message"] = "User doesn't exists.";
    }
    
    return $result;
  }

  public function register($data)
  {
    // TODO: Implement register() method.
  }

  public function getUser($username)
  {
    // TODO: Implement getUser() method.
  }

  public function updateUser($data)
  {
    // TODO: Implement updateUser() method.
  }

  private function getPassword($email)
  {
    $this->db->query("SELECT password FROM {$this->table} WHERE email=:email");
    $this->db->bind('email', $email);
    return $this->db->single();
  }
}
