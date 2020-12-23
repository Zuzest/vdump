<?php

/**
 * Forming a view for writing to a file
 * @param array $parse_backtrace
 */
function vdump_view_cli(array $parse_backtrace)
{
  echo "\n\033[0;36m".$parse_backtrace['file'].":\033[0m";
  foreach ($parse_backtrace['args'] as $v) {
    echo "\n\033[0;33mСтрока:".$parse_backtrace['line']." >\033[0;32m ".trim($v['name'])." > \033[0m";
    echo "\n";
    var_dump($v['var']);
    echo "\033[0;32m- - - - - - - - - - - - \033[0m\n";
  }
}