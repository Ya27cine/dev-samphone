<?php
namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class AdminBoutiqueController extends AbstractController {
    /**
     * @var ProduitRepository
     */
    private $produitRepository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    function __construct(ProduitRepository $produitRepository, EntityManagerInterface $em)
    {
        $this->produitRepository = $produitRepository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin.produit.index")
     * @return Responsese
     */
    public function index() : Response{
        $produits = $this->produitRepository->findAll();
        return $this->render("admin/produit/index.html.twig", compact('produits'));
    }


    /**
     * @Route("/admin/produit/create", name="admin.produit.new")
     */
    public function new(Request $request) : Response{

        $produit = new Produit;
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest( $request );

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($produit);
            $this->em->flush();
            return $this->redirectToRoute("admin.produit.index");
        }

        return $this->render("admin/produit/new.html.twig", [
            'produit' => $produit,
            'form' => $form->createView()
        ]);
    }



    /**
     * @Route("/admin/produit/{id}", name="admin.produit.edit")
     */
    public function edit(Produit $produit, Request $request) : Response{
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest( $request );

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            return $this->redirectToRoute("admin.produit.index");
        }

        return $this->render("admin/produit/edit.html.twig", [
            'produit' => $produit,
            'form' => $form->createView()
        ]);
    }
}
?>


