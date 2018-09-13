<?php

App::pageAuth(['user'], "login");

// Example to get user
$user = User::findById(1);

$user = DB::getInstance()->prepare('SELECT * FROM users WHERE id = :id');
$user->execute(['id' => 1]);
$user = $user->fetchAll(PDO::FETCH_CLASS, 'User');

dd($user);
?>

