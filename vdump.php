<?php

require_once __DIR__ .'/.const.php';
require_once __DIR__ .'/vdump_find_name_variables.php';
require_once __DIR__ .'/vdump_file_reader.php';
require_once __DIR__ .'/vdump_parse_debug_backtrace.php';

function vdump()
{
  $d = debug_backtrace();
  $d = $d[0];

  $arr = vdump_parse_debug_backtrace($d);

  ob_start();
  if (!DEV) {
    $pt = "\t";
    echo '['.date('Y.m.d').' '.date('H:i:s').'] File \''.$arr['file'].'\''.PHP_EOL;
    foreach ($arr['args'] as $v) {

      echo $pt.'Строка: '.$arr['line'].' > ['.trim($v['name']).'] >'.PHP_EOL;
      var_dump($v['var']);
      echo '[- - - - - - - - - - - - - - - - - -]'.PHP_EOL;
    }

  } elseif (!CLI) {

    echo "<div style='width:auto;font-size:10pt;background-color:#323B44;padding:.3em;'>";
    echo '<style>body{margin:0;padding:0;}</style>';
    echo "<div style='width: auto;min-width: 50em;max-width: 120em;margin: 0 auto;padding: 0 3em;'>";
    echo "<div style='border-bottom: 1px dotted #000;color:#efdc3a;font-size:0.9em;line-height:1em;text-align:start;'>";

    echo 'файл => '.$arr['file'].'<br>';
    echo 'строка => '.$arr['line'].'<br>';

    echo '</div>';

    foreach ($arr['args'] as $v) {

      echo "<div style='border-bottom: 1px dotted #000;'>";

      echo "  <div style='display:inline-block;width:25%;vertical-align:top;background:#89e6b8;font-size:1.3em;font-weight:bold;text-align:right;line-height:1.5em;color:#000'>";
      echo trim($v['name']).' => ';
      echo '  </div>';

      echo "  <div style='display:inline-block;width:70%;vertical-align:top;background: #d65b36;'>";
      echo "    <pre style='margin:0.2em;padding:.3em;overflow:auto;line-height:1.1em;color: #000;text-align:start;background:#d65b36'>";
      var_dump($v['var']);
      // var_dump(htmlentities($v['var']));
      echo '    </pre>';
      echo '  </div>';

      echo '</div>';
    }
    echo '</div>';
    echo '</div>';

  } else {
    echo "\n\033[0;36m".$arr['file'].":\033[0m";
    foreach ($arr['args'] as $v) {
      echo "\n\033[0;33mСтрока:".$arr['line']." >\033[0;32m ".trim($v['name'])." > \033[0m";
      echo "\n";
      var_dump($v['var']);
      echo "\033[0;32m- - - - - - - - - - - - \033[0m\n";
    }
  }
  $string = ob_get_clean();

  if (!DEV) {
    $_file = __DIR__.'/log/vdump.log';
    file_put_contents($_file, $string, FILE_APPEND);
    chmod($_file, 0664);
  } else {
    echo $string;
  }
}
