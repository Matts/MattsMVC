<?php
namespace Controller;

use Doctrine\ORM\EntityManager;
use Entity\User;
use Matts\Annotations\Permission;
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
     * @Permission(authenticated=true)
     */
    public function listUsers(Request $request, $args)
    {
        $result = $this->get('databaseManager')->getEntityManager()->getRepository("Entity\\User")->findAll();

        return $this->render("users.html.twig", ['result' => $result]);
    }

    /**
     * @param Request $request
     * @return string
     *
     * @Route(route="users/$id", method="GET")
     */
    public function getUser(Request $request, $args)
    {
        $result = $this->get('databaseManager')->getEntityManager()->getRepository("Entity\\User")->findBy(['id' => $args['id']]);
        return $this->render("users.html.twig", ['result' => $result]);
    }

    /**
     * @param Request $request
     * @return string
     *
     * @Route(route="users", method="POST")
     */
    public function addUser(Request $request, $args)
    {
        /**
         * @var EntityManager $em
         */
        $em = $this->get('databaseManager')->getEntityManager();
        $user = new User();
        $user->setUsername($request->getPost()['username']);
        $user->setActive($request->getPost()['active']);
        $user->setPassword(password_hash($request->getPost()['password'], PASSWORD_BCRYPT));
        $user->setPrivateKey($this->get('googleAuth')->generatePrivateKey());
        $em->persist($user);
        $em->flush();
        return json_encode(['200']);
    }
}