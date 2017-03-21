<?php
/**
 * Created by PhpStorm.
 * User: matth
 * Date: 3/21/2017
 * Time: 10:12 AM
 */

namespace Controller;


use Matts\Annotations\Permission;
use Matts\Annotations\Route;
use Matts\Controller\Controller;
use Matts\Controller\Request;

class AdminController extends Controller
{

    /**
     * @param Request $r
     *
     * @Route(route="admin")
     * @Permission(authenticated=true)
     * @return string
     */
    public function indexAction(Request $r){
        return $this->render('admin\index.html.twig');
    }

}