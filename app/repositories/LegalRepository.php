<?php

final class LegalRepository
{
  private $table = 'tb_legal_counselings';
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
      $result['message'] = "List of legal counselings retrieved successfully";
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
      $result['message'] = "List of legal counselings retrieved successfully";
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
      $problem_form_desc = $this->saveDoc('problem_form', $data['problem_form']);

      if (isset($id_card_desc['path']) && isset($problem_form_desc['path'])) {
        $this->db->query(
          "INSERT INTO {$this->table} 
          (client, no_telp, id_card, id_number, problem_form, status, submitted_by) 
          VALUES (:client, :no_telp, :id_card, :id_number, :problem_form, 'pending', :submitted_by)"
        );

        $this->db->bind('client', $data['client']);
        $this->db->bind('no_telp', $data['no_telp']);
        $this->db->bind('id_card', $id_card_desc['path']);
        $this->db->bind('id_number', $data['id_number']);
        $this->db->bind('problem_form', $problem_form_desc['path']);
        $this->db->bind('submitted_by', $data['submitted_by']);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
          $result['code'] = 200;
          $result['message'] = "Counseling created successfully";
        } else {
          $result['code'] = 400;
          $result['message'] = "Counseling failed to create";
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
      $id_card = $data['id_card'] ?? null;
      $problem_form = $data['problem_form'] ?? null;
      $opt_set_query = "";

      if ($id_card !== null) {
        $this->deleteDoc($this->getDoc($id, 'id_card'));
        $temp = $this->saveDoc('id_card', $id_card);
        $id_card = $temp['path'] ?? null;
        $opt_set_query = $opt_set_query . "id_card=:id_card, ";
      }

      if ($problem_form  !== null) {
        $this->deleteDoc($this->getDoc($id, 'problem_form'));
        $temp = $this->saveDoc('problem_form', $problem_form);
        $problem_form = $temp['path'] ?? null;
        $opt_set_query = $opt_set_query . "problem_form=:problem_form, ";
      }

      $this->db->query(
        "UPDATE {$this->table} 
            SET client=:client, no_telp=:no_telp, {$opt_set_query} id_number=:id_number
            WHERE id=:id"
      );

      $this->db->bind('client', $data['client']);
      $this->db->bind('no_telp', $data['no_telp']);
      if ($id_card !== null) $this->db->bind('id_card', $id_card);
      if ($problem_form !== null) $this->db->bind('problem_form', $problem_form);
      $this->db->bind('id_number', $data['id_number']);
      $this->db->bind('id', $id);
      $this->db->execute();

      if ($this->db->rowCount() > 0) {
        $result['code'] = 200;
        $result['message'] = "Counseling updated successfully.";
      } else {
        $result['code'] = 400;
        $result['message'] = "Counseling failed to update.";
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
        $result['message'] = "Counseling's {$field} updated successfully.";
      } else {
        $result['code'] = 400;
        $result['message'] = "Counseling's {$field} failed to update.";
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

      $id_card = $this->getDoc($id, 'id_card');
      $problem_form = $this->getDoc($id, 'problem_form');

      $this->db->query("DELETE FROM {$this->table} WHERE id=:id");
      $this->db->bind('id', $id);
      $this->db->execute();

      if ($this->db->rowCount() > 0) {
        $result['code'] = 200;
        $result['message'] = "Counseling deleted successfully";
        if ($id_card !== null) $this->deleteDoc($id_card);
        if ($problem_form !== null) $this->deleteDoc($problem_form);
      } else {
        $result['code'] = 400;
        $result['message'] = "Counseling failed to delete";
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

  private function saveDoc($key, $value)
  {
    $result = array();
    $date = date('YmdHis');
    if (move_uploaded_file($value['tmp_name'], __DIR__ . '/../../api/storage/legal_counselings/' . $key . '/' . $date . '_' . $value['name'])) {
      $result['path'] = "/storage/legal_counselings/{$key}/{$date}_{$value['name']}";
    }
    return $result;
  }

  private function getDoc($id, $key)
  {
    $this->db->query("SELECT {$key} FROM {$this->table} WHERE id=:id");
    $this->db->bind('id', $id);
    $data = $this->db->single();
    return isset($data[$key]) ? $data[$key] : null;
  }

  private function deleteDoc($doc_path)
  {
    if (file_exists(__DIR__ . '/../../api/' . $doc_path)) {
      unlink(__DIR__ . '/../../api/' . $doc_path);
    }
  }
}
