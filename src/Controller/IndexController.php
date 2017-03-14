<?php
namespace Controller;
use Matts\Annotations\Prefix;
use Matts\Controller\Controller;
use Matts\Controller\Request;

/**
 * @Prefix(route="")
 */
class IndexController extends Controller
{
    public function handleRequest(Request $request)
    {
        $result = $this->get('databaseManager')->getEntityManager()->getRepository("Entity\\User")->findAll();
        foreach ($result as $row){
            echo "Username: ".$row->getUsername(). "<br/>";
            echo "Password: ".$row->getPassword(). "<br/>";
            echo "Active: ".$row->getActive(). "<br/>";
        }
        $this->render("index.html");
    }
}