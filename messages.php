<?php
  require_once 'header.php';
  
  if (!$loggedin) die("</div></body></html>");

  if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
  else                      $view = $user;

  if (isset($_POST['text']))
  {
    $text = sanitizeString($_POST['text']);

    if ($text != "")
    {
      $pm   = substr(sanitizeString($_POST['pm']),0,1);
      $time = time();
      queryMysql("INSERT INTO messages VALUES(NULL, '$user',
        '$view', '$pm', $time, '$text')");
    }
  }

  if ($view != "")
  {
    if ($view == $user) $name1 = $name2 = "Мои";
    else
    {
      $name1 = "<a href='members.php?view=$view'>$view</a>'s";
      $name2 = "$view";
    }

    echo "<h3>$name1 сообщения</h3>";
    showProfile($view);
    
    echo <<<_END
      <form method='post' action='messages.php?view=$view'>
        <fieldset data-role="controlgroup" data-type="horizontal">
          <legend>Выберите тип сообщения</legend>
          <input type='radio' name='pm' id='public' value='0' checked='checked'>
          <label for="public">Public</label>
          <input type='radio' name='pm' id='private' value='1'>
          <label for="private">Private</label>
        </fieldset>
      <textarea name='text'></textarea>
      <input data-transition='slide' type='submit' value='Отправить'>
    </form><br>
_END;

    date_default_timezone_set('Europe/Moscow');

    if (isset($_GET['erase']))
    {
      $erase = sanitizeString($_GET['erase']);
      queryMysql("DELETE FROM messages WHERE id=$erase AND recip='$user'");
    }
    
    $query  = "SELECT * FROM messages WHERE recip='$view' ORDER BY time DESC";
    $result = queryMysql($query);
    $num    = $result->num_rows;
    
    for ($j = 0 ; $j < $num ; ++$j)
    {
      $row = $result->fetch_array(MYSQLI_ASSOC);

      if ($row['pm'] == 0 || $row['auth'] == $user || $row['recip'] == $user)
      {
        echo date('Y-m-d H:i:s', $row['time']);
        echo " <a href='messages.php?view=" . $row['auth'] .
             "'>" . $row['auth']. "</a> ";

        if ($row['pm'] == 0)
          echo ": &quot;" . $row['message'] . "&quot; ";
        else
          echo ": <span class='whisper'>&quot;" .
            $row['message']. "&quot;</span> ";

        if ($row['recip'] == $user)
          echo "[<a href='messages.php?view=$view" .
               "&erase=" . $row['id'] . "'>стереть</a>]";

        echo "<br>";
      }
    }
  }

  if (!$num)
    echo "<br><span class='info'>Сообщений нет</span><br><br>";

  echo "<br><a data-role='button'
        href='messages.php?view=$view'>Отправить повтоно</a>";
?>

    </div><br>
  </body>
</html>
