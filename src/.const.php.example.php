<?php

defined('DEV') or define('DEV', false);
defined('CLI') or define('CLI', php_sapi_name() === 'cli');

if (DEV) {
  ini_set('display_errors', 1);
} else {
  ini_set('display_errors', 0);
}
error_reporting(E_ALL);