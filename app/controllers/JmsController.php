<?php

require_once __DIR__ . '/../models/Response.php';

class JmsController extends Controller
{
  public function index()
  {
    $data = $this->repository('JmsRepository')->getAll();
    http_response_code($data["code"]);
    $response = new Response($data['message'], $data['data'] ?? null);
    echo $response->send();
  }

  public function list($id)
  {
    $data = $this->repository('JmsRepository')->getByUserId($id);
    http_response_code($data["code"]);
    $response = new Response($data['message'], $data['data'] ?? null);
    echo $response->send();
  }

  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (
        isset($_POST['intended_school'])
        && isset($_POST['applicant'])
        && isset($_POST['submitted_by'])
      ) {
        $data = $this->repository('JmsRepository')->create($_POST);
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

  public function edit($id, $field = null, $value = null)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if ($field === null && $value === null) {
        if (
          isset($_POST['intended_school'])
          && isset($_POST['applicant'])
          && isset($_POST['submitted_by'])
        ) {
          $data = $this->repository('JmsRepository')->update($id, $_POST);
          http_response_code($data["code"]);
          $response = new Response($data['message']);
          echo $response->send();
        } else {
          http_response_code(400);
          $response = new Response('All fields are required');
          echo $response->send();
        }
      } else {
        if (isset($_POST['submitted_by'])) {
          $_POST[$field] = $value;
          $data = $this->repository('JmsRepository')->update($id, $_POST, $field);
          http_response_code($data["code"]);
          $response = new Response($data['message']);
          echo $response->send();
        } else {
          http_response_code(400);
          $response = new Response('Unauthorized');
          echo $response->send();
        }
      }
    } else {
      http_response_code(405);
      $response = new Response('Method not allowed, please use POST');
      echo $response->send();
    }
  }

  public function delete($id)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (isset($_POST['submitted_by'])) {
        $data = $this->repository('JmsRepository')->delete($id, $_POST);
        http_response_code($data["code"]);
        $response = new Response($data['message']);
        echo $response->send();
      } else {
        http_response_code(401);
        $response = new Response('Unauthorized');
        echo $response->send();
      }
    } else {
      http_response_code(405);
      $response = new Response('Method not allowed, please use POST');
      echo $response->send();
    }
  }
}
