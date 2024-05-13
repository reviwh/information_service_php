<?php

require_once __DIR__ . '/../models/Response.php';

class User extends Controller
{
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

    public function index($id)
    {
        // TODO: Implement index() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }
}
