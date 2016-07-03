<?php

class ScoreboardImageController extends AppController
{
  public function add() {
    $this->request->onlyAllow('post');

    $images = $this->uploadFiles($_FILES["file"], 'scoreboard');

    foreach ($images as $image) {
      $this->ScoreboardImage->create();
      $this->ScoreboardImage->save(array(
        'ScoreboardImage' => array(
          'name' => $image,
          'order' => 9999,
        )
      ));
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

  public function delete($id = null) {
    if (!$this->ScoreboardImage->exists($id)) {
      throw new NotFoundException();
    }
    $this->request->onlyAllow('post', 'delete');

    $this->ScoreboardImage->delete($id);

    Cache::delete('logos');
    $this->redirect(array('controller' => 'beamer'));
  }

}
