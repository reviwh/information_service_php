<?php

final class EmployeeRepository
{
  private $table = 'tb_employee_complaints';
  private $relations = [
    'tb_user' => [
      'table' => 'tb_users',
      'field' => [
        'from' => 'id_user',
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
      $result['message'] = "List of employee complaints retrieved successfully";
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
      $result['message'] = "List of employee complaints retrieved successfully";
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
      $id_card_desc = $this->saveDoc('id_card', $data['id_card']);
      $complaint_report_desc = $this->saveDoc('complaint_report', $data['complaint_report']);

      if (isset($id_card_desc['path']) && isset($complaint_report_desc['path'])) {
        $this->db->query(
          "INSERT INTO {$this->table} 
        (reporter, no_telp, id_card, id_number, complaint_report, status, submitted_by) 
        VALUES (:reporter, :no_telp, :id_card, :id_number, :complaint_report, 'pending', :submitted_by)"
        );

        $this->db->bind('reporter', $data['reporter']);
        $this->db->bind('no_telp', $data['no_telp']);
        $this->db->bind('id_card', $id_card_desc['path']);
        $this->db->bind('id_number', $data['id_number']);
        $this->db->bind('complaint_report', $complaint_report_desc['path']);
        $this->db->bind('submitted_by', $data['submitted_by']);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
          $result['code'] = 200;
          $result['message'] = "Complaint created successfully";
        } else {
          $result['code'] = 400;
          $result['message'] = "Complaint failed to create";
        }
      } else {
        $result['code'] = 400;
        $result['message'] = "Upload file failed";
      }
    } else {
      $result['code'] = 401;
      $result['message'] = "Unauthorized";
    }
    return $result;
  }

  public function update($id, $field = null, $data)
  {
    $result = array();
    $role = $this->getRole($data['token']);
    if ($role !== 'customer' && $field === null) {
    } else if ($role === 'admin' && $field !== null) {
      $this->db->query("UPDATE {$this->table} SET {$field}=:value WHERE id=:id");
    } else {
      $result['code'] = 401;
      $result['message'] = "Unauthorized";
    }
  }

  public function delete($id)
  {
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

  private function saveDoc($key, $value)
  {
    $result = array();
    if (move_uploaded_file($value['tmp_name'], __DIR__ . '/../../api/storage/employee_complaints/' . $key . '/' . date('YmdHis') . '_' . $value['name'])) {
      $result['path'] = "/storage/employee_complaints/{$key}/{date('YmdHis')}_{$value['name']}";
    }
    return $result;
  }

  private function deleteDoc($id, $key)
  {
    $this->db->query("SELECT {$key} FROM {$this->table} WHERE id=:id");
    $this->db->bind('id', $id);
    $data = $this->db->single();
    if (isset($data[$key])) {
      $doc_name = $data[$key];
      if (file_exists(__DIR__ . '/../../api/' . $doc_name)) {
        unlink(__DIR__ . '/../../api/' . $doc_name);
      }
    }
  }
}
