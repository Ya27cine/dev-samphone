<?php
namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{

     /**
     * @Route("/", name="home")
     * @return Response
     */
     public function index(ProduitRepository $produitRepository) : Response{
            $produits = $produitRepository->findLatest();
            return $this->render("pages/home.html.twig",[
                'produits' => $produits
            ]);
     }
}

?>