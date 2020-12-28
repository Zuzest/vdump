<?php

/**
 * [vdump_parse_debug_backtrace description]
 * @param  array $debug_backtrace [description]
 * @return array                  [description]
 */
function vdump_parse_debug_backtrace($debug_backtrace)
{
  extract($debug_backtrace);
  $string = vdump_file_reader($file, $line, $function);

  $sa = vdump_find_name_variables($string, $function);

  $new_arr = [
    'file' => $file,
    'line' => $line,
    'args' => [],
  ];
  foreach ($args as $k => $v) {
    $new_arr['args'][$k]['name'] = $sa[$k] ?? 'undefined_' . $k;
    $new_arr['args'][$k]['var'] = $v;
  }

  return $new_arr;
}
