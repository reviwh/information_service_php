<?php

require_once __DIR__ . '/../models/Response.php';

class UserController extends Controller
{
    public function index($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['token'])) {
                $data = $this->repository('UserRepository')->getUser($id, $_POST['token']);
                http_response_code($data["code"]);
                $response = new Response($data['message'], $data['data'] ?? null);
                echo $response->send();
            } else {
                http_response_code(400);
                $response = new Response('Token is required');
                echo $response->send();
            }
        } else {
            http_response_code(405);
            $response = new Response('Method not allowed, please use POST');
            echo $response->send();
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $data = $this->repository('UserRepository')->login($_POST);
                http_response_code($data["code"]);
                $response = new Response($data['message'], $data['data'] ?? null);
                echo $response->send();
            } else {
                http_response_code(400);
                $response = new Response('Email and password are required');
                echo $response->send();
            }
        } else {
            http_response_code(405);
            $response = new Response('Method not allowed, please use POST');
            echo $response->send();
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (
                isset($_POST['name'])
                && isset($_POST['email'])
                && isset($_POST['no_telp'])
                && isset($_POST['password'])
                && isset($_POST['address'])
                && isset($_POST['role'])
            ) {
                if (isset($_FILES['id_card'])) {
                    $id_card = $_FILES['id_card'];
                    if ($id_card['type'] === 'application/pdf') {
                        $data = $this->repository('UserRepository')->create($_POST, $id_card);
                        http_response_code($data["code"]);
                        $response = new Response($data['message']);
                        echo $response->send();
                    } else {
                        http_response_code(400);
                        $response = new Response("Accepted ID card file is only PDF.");
                        echo $response->send();
                    }
                } else {
                    http_response_code(400);
                    $response = new Response('ID Card is required');
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

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (
                isset($_POST['name'])
                && isset($_POST['email'])
                && isset($_POST['no_telp'])
                && isset($_POST['address'])
                && isset($_POST['role'])
                && isset($_POST['token'])
            ) {
                $id_card = isset($_FILES['id_card']) ? $_FILES['id_card'] : null;
                $data = $this->repository('UserRepository')->update($id, $_POST, $id_card);
                http_response_code($data["code"]);
                $response = new Response($data['message'], $data['data'] ?? null);
                echo $response->send();
            } else {
                http_response_code(400);
                $response = new Response('All fields is required');
                echo $response->send();
            }
        } else {
            http_response_code(405);
            $response = new Response('Method not allowed, please use POST');
            echo $response->send();
        }
    }
}
