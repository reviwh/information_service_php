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

    $stored_password = $this->getPassword($data['email']);

    if (isset($stored_password)) {
      if (password_verify($data['password'], $stored_password)) {
        $this->db->query("SELECT id, name, email, no_telp, id_card, role, token FROM {$this->table} WHERE email=:email");
        $this->db->bind('email', $data['email']);
        $data = $this->db->single();

        $result["code"] = 200;
        $result["message"] = "Login success.";
        $result['data'] = $data;
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

  public function create($data, $id_card)
  {
    $result = array();

    if ($this->isEmailAvailable($data['email'])) {
      $id_card_desc = $this->saveIdCard($id_card);

      if (isset($id_card_desc['path'])) {
        $password = password_hash($data['password'], PASSWORD_BCRYPT);
        $token = md5(md5(md5($data['email']) . $data['role']) . $password);

        $this->db->query(
          "INSERT INTO {$this->table} 
        (name, email, password, no_telp, id_card, address, role, token) 
        VALUES (:name, :email, :password, :no_telp, :id_card, :address, :role, :token)"
        );

        $this->db->bind('name', $data['name']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('password', $password);
        $this->db->bind('no_telp', $data['no_telp']);
        $this->db->bind('id_card', $id_card_desc['path']);
        $this->db->bind('address', $data['address']);
        $this->db->bind('role', $data['role']);
        $this->db->bind('token', $token);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
          $result['code'] = 200;
          $result['message'] = "Register success.";
        } else {
          $result['code'] = 400;
          $result['message'] = "Register failed.";
        }
      } else {
        $result['code'] = 400;
        $result['message'] = "Unknown path";
      }
    } else {
      $result['code'] = 400;
      $result['message'] = "Email is unavailable.";
    }

    return $result;
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

  private function isEmailAvailable($email)
  {
    $this->db->query("SELECT email FROM {$this->table} WHERE email=:email");
    $this->db->bind('email', $email);
    $this->db->execute();
    return $this->db->rowCount() <= 0;
  }

  private function getPassword($email)
  {
    $this->db->query("SELECT password FROM {$this->table} WHERE email=:email");
    $this->db->bind('email', $email);
    $result = $this->db->single();
    return isset($result['password']) ? $result['password'] : null;
  }

  private function isTokenValid($token)
  {
    $this->db->query("SELECT token FROM {$this->table} WHERE token=:token");
    $this->db->bind('token', $token);
    $this->db->execute();
    return $this->db->rowCount() > 0;
  }

  private function getToken($email){
    $this->db->query("SELECT token FROM {$this->table} WHERE email=:email");
    $this->db->bind('email', $email);
    $result = $this->db->single();
    return isset($result['token']) ? $result['token'] : null;
  }

  private function saveIdCard($id_card)
  {
    $result = array();
    if (move_uploaded_file($id_card['tmp_name'], __DIR__ . '/../../api/storage/user/' . date('YmdHis') . $id_card['name'])) {
      $result['path'] = '/storage/user/' . date('YmdHis') . $id_card['name'];
    }
    return $result;
  }
}
