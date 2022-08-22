<?php
  session_start();
  require_once 'header.php';

  echo "<div class='center'>Добро пожаловать в BASYAKS,";

  if ($loggedin) echo " $user, ты вошел";
  else           echo 'войди или зарегистрируйся';

  echo <<<_END
      </div><br>
    </div>
    <div data-role="footer">
      <h4>Посмотри на <i><a href='https://cat-bounce.com/'
      target='_blank'>прыгающих котиков</a></i></h4>
    </div>
  </body>
</html>
_END;
?>
