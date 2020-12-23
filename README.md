# vdump
перед началом работы переименовываем файл **.const.php.example** в **.const.php**

подключаем файл vdump.php в начало проекта
```php
<?php
if (is_readable(путь до файла.'/vdump.php')) {
  require_once путь до файла.'/vdump.php';
}
vdump(__DIR__);
vdump($_POST, $_GET, 'да вообще что угодно', new Exception(), ['sasa',5,6=>'six','ping'=>'понг']);
```
и используем vdump($var,$var1,$var2,....)
радуемся

![](https://github.com/Zuzest/vdump/blob/master/vdump.png "пример вывода функции")
