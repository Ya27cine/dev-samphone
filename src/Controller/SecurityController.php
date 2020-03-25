<?php
namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
    {
        /**
         * @Route("/login", name="login")
         */
        public function login(AuthenticationUtils $authenticationUtils)
        {
            // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();

            // last username entered by the user
            $lastUsername = $authenticationUtils->getLastUsername();

            return $this->render('security/login.html.twig', [
                'last_username' => $lastUsername,
                'error'         => $error,
            ]);
        }
    }
//$2y$12$JA/n1Yqj79EWpq9YOORdDeXQl0yhgEyXN117uZ8QKCEufNV5PcPLm
?>


