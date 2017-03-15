<?php
namespace Controller;
use Matts\Annotations\Prefix;
use Matts\Controller\Controller;
use Matts\Controller\Request;

/**
 * Copyright (c) 2017 Matthew Smeets
 *
 * Created By: Matt
 * Date: 3/15/2017
 *
 * Class UserController
 * @package Controller
 *
 * @Prefix(route="users")
 */
class UserController extends Controller
{
    public function handleRequest(Request $request)
    {
        $result = $this->get('databaseManager')->getEntityManager()->getRepository("Entity\\User")->findAll();

        return $this->render("users.html.twig", ['result'=>$result]);
    }
}