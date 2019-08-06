<?php 
include('main.php');
?>

<!DOCTYPE html>
<html lang="sk" style="height: 100%;">
  <head>
    <title><?php echo $heading; ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="css/classes.php" type="text/css" rel="stylesheet" />
    <link href="css/styles.php" type="text/css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
  </head>
  <body>
    <noscript>
      <h2>Váš internetový prehliadač nepovoľuje JavaScript, čím je znemožnené správne fungovanie tejto aplikácie</h2>
      <p>Inštrukcie, ako povoliť JavaScript pre jednotlivé prehliadače nájdete na tejto webstránke<br /><br />
        <a href="https://www.enable-javascript.com/sk/">Ako povoliť JavaScript vo Vašom prehliadači</a><br /><br />
        Postupujte prosím podľa príslušného návodu a následne aktualizujte stránku pomocou ctrl + r.
      </p>
      <p>Internetové prehliadače majú rôzne verzie a preto tento návod už nemusí byť aktuálny. V takom prípade je najjednoduchšie vyhľadať si iný návod pomocou prehliadača <span>Google: ako povoliť JavaScript</span> (prípadne v anglickom jazyku: how to enable JavaScript)
      </p>
    </noscript>

    <?php 
      echo $header;
      if(!isset($_POST['level'])) {
        echo $section;
      }else{
        if(isset($_SESSION['updatedCity'])) {
          $updatedCity = $otm->displayNewGame($_SESSION['updatedCity']);
          echo $updatedCity;
        }else {
          echo $_SESSION['game'];
        }
        echo $letters;
      }
      echo $buttons;
    ?>

    <script type="text/javascript">


/*
jQuery(document).ready(function(){
  jQuery('.alphabet > div > div').addClass('bg');

jQuery(this).removeClass('bg');
jQuery(this).addClass('bg-used');

});
*/


    jQuery('.alphabet > div > div').mousedown(function() {
      jQuery(this).css('background-color', '#6a31cf');
    });


/*
    jQuery('.alphabet > div > div').mouseup(function() {
      jQuery(this).css('background-color', '#f00');			// #4aafff
    });
*/


    jQuery('.alphabet > div > div').click(function() {
      var char = jQuery(this).text();
      jQuery.ajax('php/game.php', {
        type: 'POST',
        data: {
          letter: char,
        },
        success: function(result) {
          location.reload(true);
        }
      });
    });
    </script>

  </body>
</html>