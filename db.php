<?php 

require __DIR__ .'/ReplitDB.php';

use \Dannsbass\ReplitDB as Db;

// Set data
Db::set_data('name', 'John Doe');
Db::set_data('email', 'john.doe@example.com');

// Get data
echo Db::get_data('name'); // Outputs: John Doe
echo Db::get_data('email'); // Outputs: john.doe@example.com

// Delete data
Db::delete_data('email');

// List all keys
echo Db::get_keys();
