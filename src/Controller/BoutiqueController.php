<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoutiqueController extends AbstractController{
    

    /**
     * @Route("/produits", name="boutique.index")
     * @return Response
     */
     public function index() : Response{
        return $this->render("boutique/index.html.twig", [
            'current_menu' => 'boutique'
        ]);
    }
}

?>