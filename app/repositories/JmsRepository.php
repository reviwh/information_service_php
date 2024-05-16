<?php

final class JmsRepository
{
  private $table = 'tb_jms';
  private $relations = [
    'tb_user' => [
      'table' => 'tb_users',
      'field' => [
        'from' => 'id',
        'to' => 'submitted_by'
      ]
    ]
  ];
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getAll()
  {
    $result = array();
    $this->db->query("SELECT * FROM {$this->table}");
    $data = $this->db->resultSet();

    if (count($data) > 0) {
      $result['code'] = 200;
      $result['message'] = "List of JMS retrieved successfully";
      $result['data'] = $data;
    } else {
      $result['code'] = 404;
      $result['message'] = "No data found";
    }

    return $result;
  }

  public function getByUserId($id)
  {
    $result = array();
    $this->db->query("SELECT * FROM {$this->table} WHERE submitted_by=:id");
    $this->db->bind('id', $id);
    $data = $this->db->resultset();

    if (count($data) > 0) {
      $result['code'] = 200;
      $result['message'] = "List of JMS records retrieved successfully";
      $result['data'] = $data;
    } else {
      $result['code'] = 404;
      $result['message'] = "No data found";
    }

    return $result;
  }

  public function create($data)
  {
    $result = array();
    $token = $data['token'] ?? "";
    $role = $this->getRole($token);

    if ($role === 'customer' && $this->isTokenValid($data['submitted_by'], $token)) {

      $this->db->query(
        "INSERT INTO {$this->table} 
          (intended_school, applicant, status, submitted_by) 
          VALUES (:intended_school, :applicant, 'pending', :submitted_by)"
      );

      $this->db->bind('intended_school', $data['intended_school']);
      $this->db->bind('applicant', $data['applicant']);
      $this->db->bind('submitted_by', $data['submitted_by']);
      $this->db->execute();

      if ($this->db->rowCount() > 0) {
        $result['code'] = 200;
        $result['message'] = "JMS record created successfully";
      } else {
        $result['code'] = 400;
        $result['message'] = "JMS record failed to create";
      }
    } else {
      $result['code'] = 401;
      $result['message'] = "Unauthorized";
    }
    return $result;
  }

  public function update($id, $data, $field = null)
  {
    $result = array();
    $token = $data['token'] ?? "";
    $role = $this->getRole($token);

    if (
      $role === 'customer'
      && $field === null
      && $this->isTokenValid($data['submitted_by'], $token)
      && $this->getStatus($id) === 'pending'
    ) {


      $this->db->query(
        "UPDATE {$this->table} 
            SET intended_school=:intended_school, applicant=:applicant
            WHERE id=:id"
      );

      $this->db->bind('intended_school', $data['intended_school']);
      $this->db->bind('applicant', $data['applicant']);
      $this->db->bind('id', $id);
      $this->db->execute();

      if ($this->db->rowCount() > 0) {
        $result['code'] = 200;
        $result['message'] = "JSM record updated successfully";
      } else {
        $result['code'] = 400;
        $result['message'] = "JSM record failed to update";
      }
    } else if (
      $role === 'admin'
      && $field !== null
      && $this->isTokenValid($data['submitted_by'], $token)
    ) {
      $this->db->query("UPDATE {$this->table} SET {$field}=:value WHERE id=:id");
      $this->db->bind('value', $data[$field]);
      $this->db->bind('id', $id);
      $this->db->execute();

      if ($this->db->rowCount() > 0) {
        $result['code'] = 200;
        $result['message'] = "JMS record updated success.";
      } else {
        $result['code'] = 400;
        $result['message'] = "JMS record failed to update.";
      }
    } else {
      $result['code'] = 401;
      $result['message'] = "Unauthorized";
    }

    return $result;
  }

  public function delete($id, $data)
  {
    $result = array();
    $token = $data['token'];

    if (
      $this->isTokenValid($data['submitted_by'], $token)
      && $this->getRole($token) === 'customer'
      && $this->getStatus($id) === 'pending'
    ) {


      $this->db->query("DELETE FROM {$this->table} WHERE id=:id");
      $this->db->bind('id', $id);
      $this->db->execute();

      if ($this->db->rowCount() > 0) {
        $result['code'] = 200;
        $result['message'] = "JMS record deleted successfully";
      } else {
        $result['code'] = 400;
        $result['message'] = "JMS record failed to delete";
      }
    } else {
      $result['code'] = 401;
      $result['message'] = "Unauthorized";
    }

    return $result;
  }

  private function getStatus($id)
  {
    $this->db->query("SELECT status FROM {$this->table} WHERE id=:id");
    $this->db->bind('id', $id);
    $data = $this->db->single();
    return $data['status'] ?? "";
  }

  private function getUser($id)
  {
    $table = $this->relations['tb_user']['table'];
    $this->db->query("SELECT * FROM {$table} WHERE id=:id");
    $this->db->bind('id', $id);
    return $this->db->single();
  }

  private function getRole($token)
  {
    $table = $this->relations['tb_user']['table'];
    $this->db->query("SELECT role FROM $table WHERE token=:token");
    $this->db->bind('token', $token);
    $result = $this->db->single();
    return isset($result['role']) ? $result['role'] : null;
  }

  private function isTokenValid($id, $token)
  {
    $user = $this->getUser($id);
    if (isset($user['token'])) {
      return $user['token'] === $token;
    }
    return false;
  }
}
