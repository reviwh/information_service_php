<?php

class App
{
  protected $controller = 'HomeController';
  protected $method = 'index';
  protected $params = [];

  public function __construct()
  {
    $url = $this->parseUrl();

    if (isset($url[0])) {
      if (file_exists(__DIR__ . '/../controllers/' . $url[0] . 'Controller.php')) {
        $this->controller = $url[0] . 'Controller';
        unset($url[0]);
      }
    }

    require_once __DIR__ . '/../controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller;

    if (isset($url[1])) {
      if (method_exists($this->controller, $url[1])) {
        $this->method = $url[1];
        unset($url[1]);
      }
    }

    if (!empty($url)) {
      $this->params = array_values($url);
    }

    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  public function parseUrl()
  {
    if (isset($_GET['url'])) {
      $url = array_values(array_filter(explode('/', rtrim($_GET['url'], '/')), 'filter_var', FILTER_SANITIZE_URL));
      return $url;
    }
  }
}
