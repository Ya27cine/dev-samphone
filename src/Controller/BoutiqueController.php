<?php
namespace App\Controller;



use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class BoutiqueController extends AbstractController {
    
    /**
     *  @var ProduitRepositoryository
     */
    private $depot;
    /**
     * @var ObjectManager
     */
    private $objectManager;


    function __construct(ProduitRepository $depot, EntityManagerInterface $objectManager)
    {
        $this->depot = $depot;
        $this->objectManager = $objectManager;
    }

    /**
     * @Route("/produits", name="boutique.index")
     * @return Responsese
     */
     public function index() : Response{
        return $this->render("boutique/index.html.twig", [
            'current_menu' => 'boutique'
        ]);
    }

    /**
     * @Route("/produit/{slug}/{id}", name="boutique.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Responsese
     */
    public function show($id, string $slug) : Response{
        $produit = $this->depot->find($id);

        if($produit->getSlug() !== $slug){
            return $this->redirectToRoute("boutique.show",[
                "id" => $produit->getId(),
                "slug" => $produit->getSlug()
            ], 301);
        }

        return $this->render("boutique/show.html.twig", [
            'current_menu' => 'boutique',
            'produit' => $produit,
        ]);
    }


}



/** Ajouter un produit dans la base de donnees : 
 *  $boutique = new Produit();    
*   $boutique->setTitre('Samsung J5 2016 Or 16GO')
          *       ->setPrix(135)
          *       ->setDescri("Etat de tel 10/10, Peu Utlise")
          *       ->setQuantitie(2);
      *  $em = $this->getDoctrine()->getManager();
       * $em->persist( $boutique );
        *$em->flush();

 // get data and update
$repository = $this->depot->findAllPasCher();

$repository[0]->setPrix(125);
$this->objectManager->flush();


 */

?>


