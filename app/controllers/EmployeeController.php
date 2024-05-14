<?php

require_once __DIR__ . '/../models/Response.php';

class EmployeeController extends Controller
{
  public function index()
  {
    $data = $this->repository('EmployeeRepository')->getAll();
    http_response_code($data["code"]);
    $response = new Response($data['message'], $data['data']);
    echo $response->send();
  }
}
