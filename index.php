<?php
require 'php-activerecord/vendor/autoload.php';
require "app/core/main.php";
require "models/Attendance.php";

// ActiveRecord\Config::initialize(function($cfg)
// {
//    $cfg->set_model_directory('models');
//    $cfg->set_connections(
//      array(
//        'development' => 'mysql://root@localhost/app',
//      )
//    );
// });

// print_r(Attendance::find(1));

$app = new Main('192.168.1.201');

?>

