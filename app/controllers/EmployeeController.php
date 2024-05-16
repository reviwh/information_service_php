<?php

require_once __DIR__ . '/../models/Response.php';

class EmployeeController extends Controller
{
  public function index()
  {
    $data = $this->repository('EmployeeRepository')->getAll();
    http_response_code($data["code"]);
    $response = new Response($data['message'], $data['data'] ?? null);
    echo $response->send();
  }

  public function list($id)
  {
    $data = $this->repository('EmployeeRepository')->getByUserId($id);
    http_response_code($data["code"]);
    $response = new Response($data['message'], $data['data'] ?? null);
    echo $response->send();
  }

  public function create()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (
        isset($_POST['reporter'])
        && isset($_POST['no_telp'])
        && isset($_FILES['id_card'])
        && isset($_POST['id_number'])
        && isset($_FILES['complaint_report'])
        && isset($_POST['submitted_by'])
      ) {
        if ($_FILES['id_card']['type'] === 'application/pdf' && $_FILES['complaint_report']['type'] === 'application/pdf') {
          $_POST['id_card'] = $_FILES['id_card'];
          $_POST['complaint_report'] = $_FILES['complaint_report'];

          $data = $this->repository('EmployeeRepository')->create($_POST);
          http_response_code($data["code"]);
          $response = new Response($data['message']);
          echo $response->send();
        } else {
          http_response_code(400);
          $response = new Response('Invalid file type');
          echo $response->send();
        }
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
          isset($_POST['reporter'])
          && isset($_POST['no_telp'])
          && isset($_POST['id_number'])
          && isset($_POST['submitted_by'])
        ) {
          if (
            isset($_FILES['id_card']) && $_FILES['id_card']['type'] === 'application/pdf'
            && isset($_FILES['complaint_report']) && $_FILES['complaint_report']['type'] === 'application/pdf'
          ) {
            $_POST['id_card'] = $_FILES['id_card'];
            $_POST['complaint_report'] = $_FILES['complaint_report'];

            $data = $this->repository('EmployeeRepository')->update($id, $_POST);
            http_response_code($data["code"]);
            $response = new Response($data['message']);
            echo $response->send();
          } else if (isset($_FILES['id_card']) && $_FILES['id_card']['type'] === 'application/pdf') {
            $_POST['id_card'] = $_FILES['id_card'];

            $data = $this->repository('EmployeeRepository')->update($id, $_POST);
            http_response_code($data["code"]);
            $response = new Response($data['message']);
            echo $response->send();
          } else if (isset($_FILES['complaint_report']) && $_FILES['complaint_report']['type'] === 'application/pdf') {
            $_POST['complaint_report'] = $_FILES['complaint_report'];

            $data = $this->repository('EmployeeRepository')->update($id, $_POST);
            http_response_code($data["code"]);
            $response = new Response($data['message']);
            echo $response->send();
          } else {
            http_response_code(400);
            $response = new Response('Accepted file type of ID card and Complaint Report is only PDF');
          }
        } else {
          http_response_code(400);
          $response = new Response('All fields are required');
          echo $response->send();
        }
      } else {
        if (isset($_POST['submitted_by'])) {
          $_POST[$field] = $value;
          $data = $this->repository('EmployeeRepository')->update($id, $_POST, $field);
          http_response_code($data["code"]);
          $response = new Response($data['message']);
          echo $response->send();
        } else {
          http_response_code(400);
          $response = new Response('All fields are required');
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
        $data = $this->repository('EmployeeRepository')->delete($id, $_POST);
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
