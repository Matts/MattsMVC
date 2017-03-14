<?php
namespace src\Controller;

use vendor\core\annotation\Prefix;
use vendor\Core\Controller\Controller;
use vendor\Core\Controller\Request;

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