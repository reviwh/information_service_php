<?php

class Controller
{
    public function repository($repository)
    {
        require_once __DIR__ . '/../repositories/' . $repository . '.php';
        return new $repository;
    }
}