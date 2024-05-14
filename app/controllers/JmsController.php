<?php

require_once __DIR__ . '/../models/Response.php';

class JmsController extends Controller
{
  public function index()
  {
    $data = $this->repository('JmsRepository')->getAll();
    http_response_code($data["code"]);
    $response = new Response($data['message'], $data['data']);
    echo $response->send();
  }
}
