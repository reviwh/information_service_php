<?php

final class LegalRepository
{
  private $table = 'tb_legal_counselings';
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
}