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
        $data = $this->repository('UserRepository')->login($_POST);
        http_response_code($data["code"]);
        $response = new Response($data['message']);
        echo $response->send();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (
                isset($_POST['name']) &&
                isset($_POST['email']) &&
                isset($_POST['no_telp']) &&
                isset($_POST['password']) &&
                isset($_POST['address']) &&
                isset($_POST['role'])
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
                        $response = new Response("Accepted id card file is only pdf.");
                        echo $response->send();
                    }
                } else {
                    http_response_code(400);
                    $response = new Response('ID Card is required');
                    echo $response->send();
                }
            } else {
                http_response_code(400);
                $response = new Response('Required path parameter is not complete.');
                echo $response->send();
            }
        } else {
            http_response_code(405);
            $response = new Response('Method not allowed, please use POST');
            echo $response->send();
        }
    }

    public function update()
    {
        // TODO: Implement update() method.
    }
}
