<?php

require_once __DIR__ .'/.const.php';
require_once __DIR__ .'/vdump_find_name_variables.php';
require_once __DIR__ .'/vdump_file_reader.php';
require_once __DIR__ .'/vdump_parse_debug_backtrace.php';
require_once __DIR__ .'/vdump_view.php';

function vdump()
{
  $d = debug_backtrace();
  $d = $d[0];

  vdump_view($d);
}
