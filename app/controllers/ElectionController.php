<?php

require_once __DIR__ . '/../models/Response.php';

class ElectionController extends Controller
{
  public function index()
  {
    $data = $this->repository('ElectionRepository')->getAll();
    http_response_code($data["code"]);
    $response = new Response($data['message'], $data['data']);
    echo $response->send();
  }
}
