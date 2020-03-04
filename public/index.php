<?php

# autoloader
require __DIR__.'/../vendor/autoload.php';


echo "start";
echo "<pre>";
var_dump($_SERVER['REQUEST_URI']);
echo "</pre>";

# method
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if ($_SERVER['REQUEST_URI'] == '/') {
        #render the page

        $app = new \App\Controllers\AppController();

        echo $app();
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

}
if ($_SERVER['REQUEST_METHOD'] === 'UPDATE') {

}

# need a route for view

# to define route
#$_SERVER['REQUEST_URI']
