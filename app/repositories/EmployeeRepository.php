<?php

final class EmployeeRepository
{
  private $table = 'tb_employee_complaints';
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
}
