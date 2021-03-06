<?php
class User extends AppModel {

  public $validate = array(
    'username' => array(
      'notempty' => array(
        'rule' => array('notempty'),
        'message' => 'Er is geen naam opgegeven',
      ),
      'maxlength' => array(
        'rule' => array('maxlength', 100),
        'message' => 'Deze naam is te lang',
      ),
      'unique' => array(
        'rule' => 'isUnique',
        'message' => 'Deze naam is al in gebruik'
      ),
    ),
    'password' => array(
      'notempty' => array(
        'rule' => array('notempty'),
        'message' => 'Er is geen paswoord opgegeven',
      ),
    ),
    'role' => array(
      'notempty' => array(
        'rule' => array('inList', array('admin', 'jury')),
        'message' => 'Dit is geen geldige gebruikersrol',
        'allowEmpty' => false,
      ),
    ),
  );

  public $hasAndBelongsToMany = array('Round');
  public $hasMany = array('Score');

  public function beforeSave($options = array()) {
    if (isset($this->data['User']['password'])) {
      $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
    }
    return true;
  }

  public static function cmp($a, $b)
  {
    if (isset($a['User'])) { $a = $a['User']; }
    if (isset($b['User'])) { $b = $b['User']; }

    if ($a['role']=="admin" && $b['role']!="admin") {
      return -1;
    }
    if ($a['role']!="admin" && $b['role']=="admin") {
      return 1;
    }

    $numberCmp = strnatcmp($a['number'], $b['number']);
    $nameCmp = strcmp($a['username'], $b['username']);

    return ($numberCmp!=0) ? $numberCmp : $nameCmp;
  }

}
