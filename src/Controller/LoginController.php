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
        $usr = false;
        if (isset($_SESSION['userid'])) {
            $usr = $this->get('databaseManager')->getEntityManager()->getRepository("Entity\\User")->findOneBy(['id' => $_SESSION['userid'], 'active' => 1]);
        }
        if (!($usr instanceof User)) {
            if (empty($request->getPost()['username']) || empty($request->getPost()['username'])) {
                session_unset();
                session_destroy();
                header("Refresh:0");
            }
            $username = $request->getPost()['username'];
            $password = $request->getPost()['password'];

            $user = $this->get('databaseManager')->getEntityManager()->getRepository("Entity\\User")->findOneBy(['username' => $username, 'active' => 1]);
            if ($user instanceof User) {
                if (password_verify($password, $user->getPassword())) {
                    $_SESSION['userid'] = $user->getId();
                    if (!@isset($_COOKIE['trustpc']) & !@($_COOKIE['trustpc']==1)) {
                        return $this->render('security/2fa.html.twig', ['user' => $user]);
                    }else{
                        header("Location: /MattsMVC/public/admin/");
                    }

                } else {
                    session_unset();
                    session_destroy();
                    header("Refresh:0");
                }
            }

        } else {
            if (!@isset($request->getPost()['token'])) {
                header("Refresh:0");
            }
            $user = $this->get('databaseManager')->getEntityManager()->getRepository("Entity\\User")->findOneBy(['id' => $_SESSION['userid'], 'active' => 1]);
            $publicToken = $request->getPost()['token'];
            if ($this->get('googleAuth')->validateToken($user->getPrivateKey(), $publicToken)) {
                @session_start();
                $_SESSION['username'] = $user->getUsername();
                $_SESSION['authenticated'] = true;
                if ($request->getPost()['trust'] == "on") {
                    setcookie("trustpc", true, time()+(86400 * 30), '/');
                }
                header("Location: /MattsMVC/public/admin/");
            } else {
                session_destroy();
                header("Refresh:0");
            }
        }
    }

    /**
     * @Route(route="logout")
     */
    public function logout(Request $request, $args)
    {
        session_unset();
        session_destroy();
        header("Location: /MattsMVC/public/");
    }
}