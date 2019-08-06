<?php 

 /**
  *
  * Prevents direct access to this file 
  *
  */

if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
  exit('Direct access denied');
}


 /**
  *
  * Class Template handles all templates, which serve as containers for the text output 
  *
  */

class Template {

  /** Displays the Homepage content */
  public function displayHomepage($heading) {
    $otx = new Text;
    $invitation = $otx->getInvitation();
    $moreinfo = $otx->getMoreInfo();
    unset($otx);

    // Split multibyte string into individual characters 
    $chars = preg_split('//u', $heading, -1, PREG_SPLIT_NO_EMPTY); 
    $header = '<header class="mainHeader"><div class="headerContainer">';

    foreach($chars as $char) {
      $header .= '<div class="headerItems">'.$char.'</div>';
    }

    $header .= '</div></header>';
    $section = '<section class="sectionText"><h1>'.$invitation.'</h1><p>'.$moreinfo.'</p></section>';
    $buttons = '<form action="" method="POST" class="chooseLevel" onsubmit="return isChecked();"><h3>Vyberte úroveň obtiažnosti:</h3>&nbsp;&nbsp;&nbsp;<input type="radio" name="level" value="easy" id="easy" /><label for="easy"> Ľahká - 7 pokusov</label><br />&nbsp;&nbsp;&nbsp;<input type="radio" name="level" value="middle" id="middle" /><label for="middle"> Stredná - 5 pokusov</label><br />&nbsp;&nbsp;&nbsp;<input type="radio" name="level" value="hard" id="hard" /><label for="hard"> Ťažká - 3 pokusy</label><br /><br /><p id="validation"></p><input type="submit" value="Začať hru" onclick="startNewGame()" /></form><section class="mainSection"><div class="sectionContainer"><button type="button" class="btn" onclick="displayForm()">Nová hra</button><button type="button" class="btn">Ukončiť hru</button></div></section>';
    return [$header, $section, $buttons];
  }

  /** Template for displaying the letters of the alphabet */
  public function displayAlphabet() {
    $letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'CH', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    $html = '<section class="alphabet"><div>';

    foreach($letters as $letter) {
      $html .= '<div>'.$letter.'</div>';
    }

    $html .= '</div></section>';
    return $html;
  }

  /** Template for starting a new game */
  public function displayNewGame($hiddencity) {
    $html = '<section class="game"><div>';
    $_SESSION['word_count'] = count($hiddencity);
    $char_count = array();

    foreach($hiddencity as $val) {
      $html .= '<div>';
      $chars = preg_split('//u', $val, -1, PREG_SPLIT_NO_EMPTY);
      $number = count($chars);
      $char_count[] = $number;

      foreach($chars as $char) {
        $html .= '<div>'.$char.'</div>';
      }
      $html .= '</div>';
    }
    $_SESSION['char_count'] = max($char_count);
    $html .= '</div></section>';
    return $html;
  }

}

?>