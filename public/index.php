<?php
if (is_readable(__DIR__.'/../function.php')) {
  require_once __DIR__.'/../function.php';
}

//далее подключаем ваш проект
vdump(__DIR__);
vdump($_POST, $_GET, 'да вообще что угодно', new Exception(), ['sasa',5,6=>'six','ping'=>'понг']);
