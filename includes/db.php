<?php

require_once "config.php";

$connection = mysqli_connect(
	$config['db']['server'],
	$config['db']['username'],
	$config['db']['password'],
	$config['db']['db_name']

);

if ($connection==false){
	echo "Ошибка! Не удалось соедениться с базой данных!";
	exit();
}