# Replit Database for PHP

This is a simple library for managing database on replit.com in PHP's environment

## Change Log

Change all methods to static methods.

## Usage

- open [Replit Website](https://replit.com) and login to your account
- create new Repl
- choose `PHP Web Server` from `Template` and name it as you like
- copy `ReplitDB.php` or clone this repo
- `include` or `require` `ReplitDB.php` into your code
- open Replit's terminal (shell) and type `echo $REPLIT_DB_URL` to get the database URL
- copy dan paste the URL to your code

## Sample code

```php
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
```

## Methods

- `set_data($key, $value)` for example: `Db::set_data('name', 'dannsbass')`
- `delete_data($key)` for example: `Db::delete_data('name')` or `Db::delete_data(['name', 'email'])`
- `get_keys()` to get all data keys, you can pass a prefix as a parameter like this `Db::get_keys('name')` to get all keys that begin with `name` like `name1`, `name2`, `names`, etc.
- `get_data($key)` to get a specific data, for example: `Db::get_data('email')`