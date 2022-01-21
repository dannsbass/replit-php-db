# Replit Database for PHP

This is a simple library for managing database on replit.com in PHP's environment

# Usage

- open [Replit Website](https://replit.com) and login to your account
- create new Repl
- choose `PHP Web Server` from `Template` and name it as you like
- copy `ReplitDB.php` or clone this repo
- `include` or `require` `ReplitDB.php` into your code
- open Replit's terminal (shell) and type `echo $REPLIT_DB_URL` to get the database URL
- copy dan paste the URL to your code

# Sample code

```php
<?php 

require __DIR__ .'/ReplitDB.php';

use \Dannsbass\ReplitDB;

$db = new ReplitDB(REPLIT_DB_URL); // get from terminal: echo $REPLIT_DB_URL

$db->set_data('name', 'Danns Bass');
$db->set_data('email', 'dannsbass@gmail.com');
$db->set_data('repo', 'https://github.com/dannsbass');
$db->set_data('country', 'Indonesia');

$db->delete_data('country');

echo $db->get_keys();

echo PHP_EOL;

echo $db->get_data('name');
```