<?php

/**
 * [vdump_file_reader] читает файл в месте вызова функции
 * @param  string $file          [description]
 * @param  int    $line          [description]
 * @param  string $function_name [description]
 * @return string                [description]
 */
function vdump_file_reader($file, $line, $function_name)
{

  static $files_array = [];

  $fh = fopen($file, "r");

  $rows = [];
  $row_count = 1;
  $prev_start_line = 0;
  while ($str = fgets($fh)) {
    $end_line = $row_count;
    $rows[$row_count] = $prev_start_line;

    $prev_start_line += strlen($str);

    ++$row_count;

    if ($row_count > $line) {
      $trim_str = trim($str);
      if (false !== strrpos($trim_str, ';')) {
        break;
      }
    }
  }
  $files_array[$file] = $rows;

  $revers_rows = array_slice($files_array[$file], 0, $end_line);
  $revers_rows = array_reverse($revers_rows);
  $string = '';
  foreach ($revers_rows as $start_line => $seek) {

    fseek($fh, $seek, SEEK_SET);
    $fgets = fgets($fh);
    $pos = strpos($fgets, $function_name . '(');
    $string = trim($fgets) . $string;

    if (false !== $pos) {
      break;
    }
  }

  return $string;
}
