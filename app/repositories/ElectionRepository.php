<?php

final class ElectionRepository
{
  private $table = 'tb_election_posts';
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
      $result['message'] = "List of election posts retrieved successfully";
      $result['data'] = $data;
    } else {
      $result['code'] = 404;
      $result['message'] = "No data found";
    }

    return $result;
  }
}
