<?php
namespace Controller;

use Entity\User;
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
 * Class LoginController
 * @package Controller
 *
 */
class LoginController extends Controller
{
    /**
     * @Route(route="login")
     */
    public function loginAction(Request $request, $args)
    {
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route(route="login", method="POST")
     */
    public function loginPostAction(Request $request)
    {
        if (empty($_SESSION['userid'])) {
            if (!isset($request->getPost()['username']) || !isset($request->getPost()['username'])) {
                header("Refresh:0");
            }
            $username = $request->getPost()['username'];
            $password = $request->getPost()['password'];

            $user = $this->get('databaseManager')->getEntityManager()->getRepository("Entity\\User")->findOneBy(['username' => $username, 'active' => 1]);
            if ($user instanceof User) {
                if (password_verify($password, $user->getPassword())) {
                    $_SESSION['userid'] = $user->getId();
                    return $this->render('security/2fa.html.twig', ['user' => $user]);
                } else {
                    return $this->render('security/login.html.twig');
                }
            }
        } else {
            if (!isset($request->getPost()['token'])) {
                header("Refresh:0");
            }
            $user = $this->get('databaseManager')->getEntityManager()->getRepository("Entity\\User")->findOneBy(['id' => $_SESSION['userid'], 'active' => 1]);
            $publicToken = $request->getPost()['token'];
            if ($this->get('googleAuth')->validateToken($user->getPrivateKey(), $publicToken)) {
                @session_start();
                $_SESSION['username'] = $user->getUsername();
                $_SESSION['authenticated'] = true;
                header("Location: /MattsMVC/public/admin/");
            } else {
                session_destroy();
                header("Refresh:0");
            }
        }
    }

    /**
     * @Route(route="generate", method="GET")
     */
    public function generateSecret(Request $request)
    {
        dump($this->get('googleAuth')->generatePrivateKey());
    }

    /**
     * @Route(route="token", method="POST")
     */
    public function generateToken(Request $request)
    {
        dump($this->get('googleAuth')->generateToken($request->getPost()['secret']));
    }

    /**
     * @Route(route="check", method="POST")
     */
    public function checkToken(Request $request)
    {
        dump($this->get('googleAuth')->validateToken($request->getPost()['secret'], $request->getPost()['token']));
    }


    /**
     * @Route(route="login/$test")
     */
    public function handleRequest(Request $request)
    {
        dump($this->get('googleAuth')->validateToken("WOVSCLT4ZW7WNXLQ", "913999"));
    }
}