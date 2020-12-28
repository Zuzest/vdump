<?php

/**
 * [vdump_find_name_variables] ищем в строке названия переменных
 * @param  string $string        [description]
 * @param  string $function_name [description]
 * @return array                [description]
 */
function vdump_find_name_variables($string, $function_name)
{
  preg_match('~' . $function_name . "\((.*)\)~", $string, $sa);
  $string = $sa[1] ?? $string;

  $delimiter = [','];
  $open_quotes = ['\'', '"', '(', '['];
  $close_quotes = ['\'', '"', ')', ']'];
  $string = preg_split('//u', $string, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

  $arr = [];
  $quotes = 0;
  $str = '';
  $count = count($string);
  foreach ($string as $chars) {
    --$count;
    if ($quotes < 1) {
      if (in_array($chars, $open_quotes)) {
        $str .= $chars;
        ++$quotes;
        continue;
      }
      if (in_array($chars, $delimiter)) {
        $arr[] = $str;
        $str = '';
        continue;
      }
      $str .= $chars;
      if (0 === $count) {
        $arr[] = $str;
        $str = '';
        continue;
      }
    }
    if ($quotes > 0) {
      if (in_array($chars, $close_quotes)) {
        $str .= $chars;
        if (0 === $count) {
          $arr[] = $str;
          $str = '';
          continue;
        }
        --$quotes;
        continue;
      }
      if (in_array($chars, $open_quotes)) {
        $str .= $chars;
        ++$quotes;
        continue;
      }
      $str .= $chars;
      continue;
    }

  }

  return $arr;
}
