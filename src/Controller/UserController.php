<?php
namespace Controller;
use Matts\Annotations\Prefix;
use Matts\Controller\Controller;
use Matts\Controller\Request;

/**
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