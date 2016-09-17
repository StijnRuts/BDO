<?php

class CustomSession extends AppModel
{
  public $useTable = 'cake_sessions';

  public function afterFind($results, $primary = false) {
    foreach ($results as $key => $val) {
      if (isset($val['CustomSession']['data']) && is_string($val['CustomSession']['data'])) {
        $results[$key]['CustomSession']['data'] = self::decode($val['CustomSession']['data']);
      }
    }
    return $results;
  }

  public function beforeSave($options = array()) {
    if (isset($this->data['CustomSession']['data']) && is_array($this->data['CustomSession']['data'])) {
      $this->data['CustomSession']['data'] = self::encode($this->data['CustomSession']['data']);
    }
    return true;
  }

  private function decode($session_string) {
    $session = $_SESSION;
    session_decode($session_string);
    $decoded = $_SESSION;
    $_SESSION = $session;

    return $decoded;
  }

  private function encode($session_array) {
    $session = $_SESSION;
    $_SESSION = $session_array;
    $encoded = session_encode();
    $_SESSION = $session;

    return $encoded;
  }
}
