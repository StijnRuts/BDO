<?php

class BeamerController extends AppController
{
  public function index() {
    if (isset($this->data['message'])) {
      App::import('Controller', 'Results');
      $Results = new ResultsController;
      $Results->showmessage($this->data['message']);
    }
  }

  public function uploadImages() {
    if (!$this->request->is('post')) {
      throw new NotFoundException();
    }

    $uploadFolder = WWW_ROOT . 'images/scoreboard/';
    $allowedExtentions = array('jpg', 'jpeg', 'png');
    $files = $_FILES["file"];

    // for single-file uploads these are not arrays
    // always make it an array for consistency
    $files["name"] = (array)$files["name"];
    $files["type"] = (array)$files["type"];
    $files["tmp_name"] = (array)$files["tmp_name"];
    $files["error"] = (array)$files["error"];
    $files["size"] = (array)$files["size"];

    foreach ($files["error"] as $key => $error)
    {
      $tmp_name = $files["tmp_name"][$key];
      $name = $files["name"][$key];
      $extention = pathinfo($name, PATHINFO_EXTENSION);
      $newName = md5($name . $tmp_name . date('r')) . '.' . $extention;

      if ($error == UPLOAD_ERR_OK &&
          in_array($extention, $allowedExtentions)
      ) {
        $result = move_uploaded_file($tmp_name, $uploadFolder . $newName);
      }
    }

    if ($this->request->isAjax()) {
      exit;
    }
    $this->redirect(array('action' => 'index'));
  }

}
