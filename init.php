<?php
session_start();
ob_start();

spl_autoload_register(function($className){
  $classFile = __DIR__ . '/classes/class.' . strtolower($className) . '.php';
  if(file_exists($classFile)){
    require $classFile;
  }

  require 'vendor/autoload.php';
  $whoops = new \Whoops\Run;
  $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler); //PrettyPageHandler //JsonResponseHandler
  $whoops->register();
});

Helper::Load();

require 'system/config.php';
$db = new basicdb($config['db']['host'], $config['db']['name'], $config['db']['user'], $config['db']['pass']);