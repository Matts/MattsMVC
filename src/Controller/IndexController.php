<?php
/**
 * Created by PhpStorm.
 * User: Matt
 * Date: 3/15/2017
 * Time: 5:45 PM
 */

namespace Controller;


use Matts\Annotations\Prefix;
use Matts\Controller\Controller;
use Matts\Controller\Request;

/**
 * Class IndexController
 * @package Controller
 *
 * @Prefix(route="")
 */
class IndexController extends Controller
{
        public function handleRequest(Request $request)
        {
            return $this->render('index.html.twig');
        }
}