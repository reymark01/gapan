<?php
session_start();

spl_autoload_register(function($class) {
	require_once '../../app/classes/'.$class.'.php';
});
