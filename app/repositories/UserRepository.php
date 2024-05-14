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
      $result["code"] = 404;
      $result["message"] = "User doesn't exists.";
    }

    return $result;
  }

  public function register($data)
  {
    // TODO: Implement register() method.
  }

  public function getUser($id, $token)
  {
    $result = array();

    if ($this->isTokenValid($token)) {
      $this->db->query("SELECT id, name, email, no_telp, id_card, role, token FROM {$this->table} WHERE id=:id AND token=:token");
      $this->db->bind('id', $id);
      $this->db->bind('token', $token);
      $data = $this->db->single();

      if ($data) {
        $result['code'] = 200;
        $result['message'] = "User retrieved successfully.";
        $result['data'] = $data;
      } else {
        $result['code'] = 404;
        $result['message'] = "User doesn't exists.";
      }
    } else {
      $result['code'] = 401;
      $result['message'] = "You're unauthorize to this request.";
    }


    return $result;
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

  private function isTokenValid($token)
  {
    $this->db->query("SELECT token FROM {$this->table} WHERE token=:token");
    $this->db->bind('token', $token);
    $this->db->execute();
    return $this->db->rowCount() > 0;
  }
}
