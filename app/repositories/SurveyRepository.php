<?php

final class SurveyRepository
{
  private $table = 'tb_users_survey';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getAll()
  {
    $result = array();

    $this->db->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
    $data = $this->db->resultSet();

    if (count($data) > 0) {
      $result['code'] = 200;
      $result['message'] = "List of users survey retrieved successfully";
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

    $this->db->query("INSERT INTO {$this->table} (email, rating, suggestion, category) VALUES (:email, :rating, :suggestion, :category)");
    $this->db->bind('email', $data['email']);
    $this->db->bind('rating', $data['rating']);
    $this->db->bind('suggestion', $data['suggestion'] ?? null);
    $this->db->bind('category', $data['category']);
    $this->db->execute();

    if ($this->db->rowCount() > 0) {
      $result['code'] = 200;
      $result['message'] = "User survey created successfully";
    } else {
      $result['code'] = 400;
      $result['message'] = "User survey creation failed";
    }

    return $result;
  }
}
