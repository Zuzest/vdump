<?php

require_once __DIR__ .'/.const.php';
require_once __DIR__ .'/vdump_find_name_variables.php';
require_once __DIR__ .'/vdump_file_reader.php';

function vdump()
{
  $d = debug_backtrace();
  $d = $d[0];

  extract($d);
  $ffile = file($file, FILE_IGNORE_NEW_LINES);
  $string = vdump_file_reader($file, $line, $function);

  $sa = vdump_find_name_variables($string, $function);

  ob_start();
  if (!DEV) {
    $pt = "\t";
    echo '['.date('Y.m.d').' '.date('H:i:s').'] File \''.$file.'\''.PHP_EOL;
    foreach ($args as $k => $v) {

      echo $pt.'Строка: '.$line.' > ['.trim($sa[$k]).'] >'.PHP_EOL;
      var_dump($v);
      echo '[- - - - - - - - - - - - - - - - - -]'.PHP_EOL;
    }

  } elseif (!CLI) {

    echo "<div style='width:auto;font-size:10pt;background-color:#323B44;padding:.3em;'>";
    echo '<style>body{margin:0;padding:0;}</style>';
    echo "<div style='width: auto;min-width: 50em;max-width: 120em;margin: 0 auto;padding: 0 3em;'>";
    echo "<div style='border-bottom: 1px dotted #000;color:#efdc3a;font-size:0.9em;line-height:1em;text-align:start;'>";

    echo 'файл => '.$file.'<br>';
    echo 'строка => '.$line.'<br>';

    echo '</div>';

    foreach ($args as $k => $v) {

      echo "<div style='border-bottom: 1px dotted #000;'>";

      echo "  <div style='display:inline-block;width:25%;vertical-align:top;background:#89e6b8;font-size:1.3em;font-weight:bold;text-align:right;line-height:1.5em;color:#000'>";
      echo trim($sa[$k]).' => ';
      echo '  </div>';

      echo "  <div style='display:inline-block;width:70%;vertical-align:top;background: #d65b36;'>";
      echo "    <pre style='margin:0.2em;padding:.3em;overflow:auto;line-height:1.1em;color: #000;text-align:start;background:#d65b36'>";
      var_dump($v);
      // var_dump(htmlentities($v));
      echo '    </pre>';
      echo '  </div>';

      echo '</div>';
    }
    echo '</div>';
    echo '</div>';

  } else {
    echo "\n\033[0;36m".$file.":\033[0m";
    foreach ($args as $k => $v) {
      echo "\n\033[0;33mСтрока:".$line." >\033[0;32m ".trim($sa[$k])." > \033[0m";
      echo "\n";
      var_dump($v);
      echo "\033[0;32m- - - - - - - - - - - - \033[0m\n";
    }
  }
  $string = ob_get_clean();

  if (!DEV) {
    $_file = __DIR__.'/log/vdump.log';
    file_put_contents($_file, $string, FILE_APPEND);
    chmod($_file, 0777);
  } else {
    echo $string;
  }
}
