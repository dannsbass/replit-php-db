<?php 

require __DIR__ .'/ReplitDB.php';

use \Dannsbass\ReplitDB;

$db = new ReplitDB('REPLIT_DB_URL'); // get from terminal: echo $REPLIT_DB_URL

$db->set_data('name', 'Danns Bass');
$db->set_data('email', 'dannsbass@gmail.com');
$db->set_data('repo', 'https://github.com/dannsbass');
$db->set_data('country', 'Indonesia');

$db->delete_data(['country','email','repo']);

echo $db->get_keys();

echo PHP_EOL;

echo $db->get_data('name');

