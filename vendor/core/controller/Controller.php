<?php

namespace vendor\Core\Controller;


class Controller
{
    public function handleRequest(Request $request){
        echo "Default Handling";
    }

    public function render($filename){
        include sourcedir . "/View/" . $filename;
    }
}