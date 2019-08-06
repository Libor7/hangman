<?php 

 /**
  *
  * Prevents direct access to this file 
  *
  */

if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  exit('Direct access denied');
}

if(session_status() == PHP_SESSION_NONE) {
  session_start();
}

include('classes/database.class.php');
include('classes/text.class.php');
include('classes/template.class.php');

if(!isset($_SESSION['cities'])) {
  $odb = new Database;
  $_SESSION['cities'] = $odb->getCities();
}

if(!isset($heading)) {
  $otx = new Text;
  $heading = $otx->getAppName();
  unset($otx);
}

if(!isset($homepage)) {
  $otm = new Template;
  $homepage = $otm->displayHomepage($heading);
  $header = $homepage[0];
  $section = $homepage[1];
  $buttons = $homepage[2];
  $letters = $otm->displayAlphabet();
}