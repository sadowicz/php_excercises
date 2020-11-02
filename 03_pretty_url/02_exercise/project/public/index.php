<?php
$parts = explode('/', $_SERVER['REQUEST_URI']);
array_shift($parts);
$page = $parts[0];

if($page == ''){
    $page = 'home';
}
elseif(!file_exists('../views/'.$page.'.php')){
    $page = '404';
}
include '../views/layout.php'
?>