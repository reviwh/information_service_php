<?php

require_once __DIR__ . '/../models/Response.php';

class LegalController extends Controller
{
  public function index()
  {
    $data = $this->repository('LegalRepository')->getAll();
    http_response_code($data["code"]);
    $response = new Response($data['message'], $data['data']);
    echo $response->send();
  }
}
