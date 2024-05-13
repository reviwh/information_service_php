<?php

class Response
{
  private $message;
  private $data;

  public function __construct($message, $data = null)
  {
    $this->message = $message;
    $this->data = $data;
  }

  public function setMessage($message)
  {
    $this->message = $message;
  }

  public function setData($data)
  {
    $this->data = $data;
  }

  public function send()
  {
    $response = array(
      'message' => $this->message,
      'data' => $this->data
    );
    return json_encode($response);
  }
}
