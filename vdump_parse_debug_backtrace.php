<?php

/**
 * Parses debug backtrace|
 * анализирует обратную трассировку отладки
 * @param array $debug_backtrace
 * @return array
 */
function vdump_parse_debug_backtrace(array $debug_backtrace) : array
{
  extract($debug_backtrace);
  $string = vdump_file_reader($file, $line, $function);

  $sa = vdump_find_name_variables($string, $function);

  $new_arr = [
    'file' => $file,
    'line' => $line,
    'args' => [],
  ];
  foreach($args as $k => $v) {
    $new_arr['args'][$k]['name'] = $sa[$k] ?? 'undefined_'. $k;
    $new_arr['args'][$k]['var'] = $v;
  }

  return $new_arr;
}