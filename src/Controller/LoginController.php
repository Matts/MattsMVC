<?php
namespace Controller;

use Matts\Annotations\Prefix;
use Matts\Controller\Controller;
use Matts\Controller\Request;

/**
 * @Prefix(route="login")
 */
class LoginController extends Controller
{

    public function handleRequest(Request $request)
    {
        dump($request->getRequest());
    }
}