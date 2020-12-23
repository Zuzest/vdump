<?php

require_once __DIR__ .'/.const.php';
require_once __DIR__ .'/vdump_find_name_variables.php';
require_once __DIR__ .'/vdump_file_reader.php';
require_once __DIR__ .'/vdump_parse_debug_backtrace.php';
require_once __DIR__ .'/vdump_view.php';
require_once __DIR__ .'/vdump_view_web.php';
require_once __DIR__ .'/vdump_view_cli.php';

function vdump()
{
  $d = debug_backtrace();
  $d = $d[0];

  vdump_view($d);
}

function vdumpe()
{
  $d = debug_backtrace();
  $d = $d[0];

  vdump_view($d, true);
}

function vdumpd()
{
  $d = debug_backtrace();
  $d = $d[0];

  vdump_view($d);

  exit;
}