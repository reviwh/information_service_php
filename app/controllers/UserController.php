<?php

require_once __DIR__ . '/../models/Response.php';

class UserController extends Controller
{
    public function index($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
        // TODO: Implement register() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }
}
