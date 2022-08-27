<?php // Example 27-12: logout.php
  require_once 'header.php';

  if (isset($_SESSION['user']))
  {
    destroySession();
    echo "<br><div class='center'>
         <a data-transition='slide' href='index.php'>Кликните</a>
         для выхода.</div>";
  }
  else echo "<div class='center'>Вы не можете выйти, потому что
              вы не авторизованы</div>";
?>
    </div>
  </body>
</html>
