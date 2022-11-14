<?php 

require __DIR__ .'/ReplitDB.php';

use \Dannsbass\ReplitDB as Db;

Db::set_data('name', 'Danns Bass');
Db::set_data('email', 'dannsbass@gmail.com');
Db::set_data('repo', 'https://github.com/dannsbass');
Db::set_data('country', 'Indonesia');

Db::delete_data('country');

echo Db::get_keys();

echo PHP_EOL;

echo Db::get_data('name');
