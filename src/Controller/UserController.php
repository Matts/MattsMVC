<?php
namespace Controller;
use Matts\Annotations\Prefix;
use Matts\Annotations\Route;
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
 */
class UserController extends Controller
{
    /**
     * @param Request $request
     * @return string
     *
     * @Route(route="users")
     */
    public function handleRequest(Request $request, $args)
    {
        $result = $this->get('databaseManager')->getEntityManager()->getRepository("Entity\\User")->findAll();

        return $this->render("users.html.twig", ['dir' => webdir,'result'=>$result]);
    }
}