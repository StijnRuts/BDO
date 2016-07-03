<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
  public $components = array('DebugKit.Toolbar', 'Session',
      'Auth' => array(
        'loginRedirect' => array('controller'=>'home', 'action'=>'index'),
        'logoutRedirect' => array('controller'=>'home', 'action'=>'index'),
        'authError' => 'U bent niet gemachtigd deze pagina te bekijken',
        'authorize' => array('Controller')
      ) );
  public $helpers = array('Navigation');

  public function isAuthorized($user) {
    if (isset($user['role']) && $user['role']=='admin') return true;
    return false;
  }

  public function beforeFilter() {
    $this->set('logged_in', $this->Auth->LoggedIn());
    $this->set('current_user', $this->Auth->user());
  }

  public function uploadFiles($files, $uploadFolder = '', $allowedExtentions = array('jpg', 'jpeg', 'png'))
  {
    $uploadFolder = WWW_ROOT . 'images/' . $uploadFolder . ($uploadFolder ? '/' : '');
    $result = array();

    // for single-file uploads these are not arrays
    // always make it an array for consistency
    foreach (array("name", "type", "tmp_name", "error", "size") as $key) {
      $files[$key] = (array)$files[$key];
    }

    foreach ($files["error"] as $key => $error)
    {
      $tmp_name = $files["tmp_name"][$key];
      $name = $files["name"][$key];
      $extention = pathinfo($name, PATHINFO_EXTENSION);
      $newName = md5($name . $tmp_name . date('r')) . '.' . $extention;

      if ($error == UPLOAD_ERR_OK &&
          in_array($extention, $allowedExtentions) &&
          move_uploaded_file($tmp_name, $uploadFolder . $newName)
      ) {
        $result[] = $newName;
      }
    }

    return $result;
  }
}
