<?php
session_start();
//Include models
spl_autoload_register(function ($class_name) {
    if(file_exists('../model/' . $class_name . '.php')) {
        include '../model/' . $class_name . '.php';
    }
    else{
        include '../class/' . $class_name . '.php';
    }
});


if(isset($_GET['page'])) {
    $page = $_GET['page'];
    if(!file_exists("../pages/$page.php")){
        App::redirect('home');
    }
}
else{
    App::redirect('home');
}
