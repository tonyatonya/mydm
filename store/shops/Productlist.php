<?php

session_start();
require_once "initapp.php";

class Productlist{

    function __construct($post)
    {
        $command = $post;
        echo $command;
        switch($command){
            case 'loadProduct' : $this->loadProduct();

        }
    }

    function loadProduct(){
        echo "alert('TEST')";
    }

}