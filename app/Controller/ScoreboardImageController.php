<?php

class ScoreboardImageController extends AppController
{
  public function add() {
    $this->request->onlyAllow('post');

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
        if ($result) {
          $this->ScoreboardImage->create();
          $this->ScoreboardImage->save(array(
            'ScoreboardImage' => array(
              'name' => $newName,
              'order' => 9999,
            )
          ));
        }
      }
    }

    Cache::delete('logos');

    if ($this->request->isAjax()) {
      exit;
    }
    $this->redirect(array('controller' => 'beamer'));
  }

  public function reorder()
  {
		$this->request->onlyAllow('post');

		foreach ($this->data['ScoreboardImage'] as $key => $value) {
			$this->ScoreboardImage->id = $value;
			$this->ScoreboardImage->saveField("order", $key+1);
		}

    Cache::delete('logos');

		exit;
	}

}
