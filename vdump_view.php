<?php

/**
 * Outputs information to a stream or file
 * @param array $debug_backtrace
 * @param bool $htmlentities
 */
function vdump_view(array $debug_backtrace, $htmlentities = false)
{
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
    vdump_view_web($arr, $htmlentities);
  } else {
    vdump_view_cli($arr);
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