<?php
  session_start();
  require_once 'header.php';

  echo "<div class='center'>Добро пожаловать в BASYAKS,";

  if ($loggedin) echo " $user, ты зашёл на сайт";
  else           echo ' войдите или пройдите регистрацию';

  echo <<<_END
      </div><br>
    </div>
    <div data-role="footer">
      <h4>Тут <i><a href='https://github.com/kitdim/Basyaks'
      target='_blank'> код этого проекта</a></i></h4>
    </div>
  </body>
</html>
_END;
?>
