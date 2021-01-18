<?php
require './src/Convert.php';
require './src/ConvertDate.php';
require './src/ConvertTime.php';
if(file_exists("../plibv4-assert")) {
	require "../plibv4-assert/src/Assert.php";
}

if(file_exists("./vendor/")) {
	require "./vendor/autoload.php";
}
