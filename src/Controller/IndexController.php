<?php
namespace src\Controller;
use vendor\core\annotation\Prefix;
use vendor\Core\Controller\Controller;
use vendor\Core\Controller\Request;


/**
 * @Prefix(route="")
 */
class IndexController extends Controller
{
    public function handleRequest(Request $request)
    {
        $this->render("index.html");
    }
}