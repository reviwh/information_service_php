<?php

require_once __DIR__ . '/../models/Response.php';

class SurveyController extends Controller
{
  public function index()
  {
    $data = $this->repository('SurveyRepository')->getAll();
    http_response_code($data["code"]);
    $response = new Response($data['message'], $data['data'] ?? null);
    echo $response->send();
  }
  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (
        isset($_POST['email'])
        && isset($_POST['rating'])
        && isset($_POST['category'])
      ) {
        $data = $this->repository('SurveyRepository')->create($_POST);
        http_response_code($data["code"]);
        $response = new Response($data['message']);
        echo $response->send();
      } else {
        http_response_code(400);
        $response = new Response('All fields are required');
        echo $response->send();
      }
    } else {
      http_response_code(405);
      $response = new Response('Method not allowed, please use POST');
      echo $response->send();
    }
  }
}
