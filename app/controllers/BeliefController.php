<?php

require_once __DIR__ . '/../models/Response.php';

class BeliefController extends Controller
{
  public function index()
  {
    $data = $this->repository('BeliefRepository')->getAll();
    http_response_code($data["code"]);
    $response = new Response($data['message'], $data['data']);
    echo $response->send();
  }
}
