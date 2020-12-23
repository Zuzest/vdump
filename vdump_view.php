<?php

/**
 * [vdump_view]
 * @param  [type] $debug_backtrace [description]
 * @return [type]                  [description]
 */
function vdump_view($debug_backtrace) {
  $arr = vdump_parse_debug_backtrace($debug_backtrace);

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
    vdump_view_web($arr);
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