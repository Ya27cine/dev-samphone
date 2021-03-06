<?php
namespace App\Controller;



use App\Entity\Contact;
use App\Entity\Produit;
use App\Entity\ProduitSearch;
use App\Form\ContactType;
use App\Form\ProduitSearchType;
use App\Notification\ContactNotif;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     public function index(PaginatorInterface $paginator, Request $request) : Response{

         // create form search :
         $pd_search = new ProduitSearch();
         $form = $this->createForm(ProduitSearchType::class, $pd_search);
         $form->handleRequest($request);

         // get All produit
         $query = $this->depot->findAllProduitsByQuery($pd_search);

         // gene pagin
         $produits = $paginator->paginate(
             $query, /* query NOT result */
             $request->query->getInt('page', 1), /*page number*/
             6 /*limit per page*/
         );

        return $this->render("boutique/index.html.twig", [
            'current_menu' => 'boutique',
            'produits'     =>  $produits,
            'form'         =>  $form->createView()
        ]);
    }

    /**
     * @Route("/produit/{slug}/{id}", name="boutique.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Responsese
     */
    public function show($id, string $slug,Request $request, ContactNotif $notification) : Response{
        // get item from DB :
        $produit = $this->depot->find($id);

        if($produit->getSlug() !== $slug){
            return $this->redirectToRoute("boutique.show",[
                "id" => $produit->getId(),
                "slug" => $produit->getSlug()
            ], 301);
        }

        // prepare zone contat
        $contact = new Contact();
        $contact->setProduit($produit);
        $form_contact = $this->createForm(ContactType::class, $contact);
        $form_contact->handleRequest($request);

        if($form_contact->isValid() && $form_contact->isSubmitted()){
            $notification->Notify($contact);
            $this->addFlash("success", "Votre email a  bien été envoyé");
           // return $this->redirectToRoute("boutique.show",[
          //      "id" => $produit->getId(),
           //     "slug" => $produit->getSlug()
           // ]);
        }


        return $this->render("boutique/show.html.twig", [
            'current_menu' => 'boutique',
            'produit' => $produit,
            'form_contact' => $form_contact->createView()
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


