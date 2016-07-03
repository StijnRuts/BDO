<?php

class BeamerController extends AppController
{
  public function index() {
    $this->loadModel('ScoreboardImage');
    $scoreboardImages = $this->ScoreboardImage->find('all', array(
      'order' => array('ScoreboardImage.order'),
      'limit' => 100,
    ));
    $this->set('scoreboardImages', $scoreboardImages);
  }

  public function setMessage() {
    if (!isset($this->data['message'])) {
      throw new NotFoundException();
    }

    App::import('Controller', 'Results');
    $Results = new ResultsController;
    $Results->showmessage($this->data['message']);

    $this->redirect(array('action' => 'index'));
  }
}
