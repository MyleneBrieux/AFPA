<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use App\Form\ProduitType;
use Symfony\Component\HttpFoundation\Request;
use App\Service\ProduitService;

use App\Service\Exception\ProduitServiceException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class ProduitController extends AbstractController {

    private $produitService;


    public function __construct(ProduitService $produitService, UrlGeneratorInterface $urlGenerator){
        $this->produitService = $produitService;
        $this->urlGenerator = $urlGenerator;
    }


    /**
     * Cette méthode affiche tous les produits dans un tableau
     * @Route("/produits", name="index_produits")
     */

    public function index(): Response
    {
        try {
            $produits=$this->produitService->chercherTousProduits();
        } catch (ProduitServiceException $e){
            return $this->render('produits/index.html.twig', [
                "produits" => [],
                "error" => $e->getMessage()
            ]);
        }

        return $this->render('produits/index.html.twig', [
            "produits" => $produits
        ]);
    }


    /**
     * Cette méthode supprime un produit depuis un bouton
     * @Route("/produit/delete/{id}", name="suppression_produit")
     * @IsGranted("ROLE_ADMIN")
     */

    public function delete(int $id, Request $request, CsrfTokenManagerInterface $csrfTokenManager): Response
    {
        try { // Pour prévenir les attaques Cross-Site Request Forgery (via URL) On ajoute un token (jeton d'authentification, non-connu) dans le lien. 
            $token = new CsrfToken('delete', $request->query->get('_csrf_token'));

            if(!$csrfTokenManager->isTokenValid($token)){
                return new RedirectResponse($this->urlGenerator->generate('index_produits')); // redirection vers page index après connexion
            }

            $produit=$this->produitService->chercherUnProduit($id);
            $produit = $this->produitService->supprimerProduit($produit);
        } catch(ProduitServiceException $e){
            return $this->redirectToRoute('index_produits', [
                "error" => $e->getMessage()
            ]);
        }

        return $this->redirectToRoute('index_produits');
    }
    

    /**
     * Cette méthode ajoute et modifie un produit depuis un formulaire unique
     * @Route("/produit/add", name="add_produits")
     * @Route("/produit/edit/{id}", name="edit_produit")
     * @IsGranted("ROLE_ADMIN")
     */
    
    public function addOrEdit(?Produit $produit, Request $request): Response
    {
        try {
            if (!$produit) {
                $produit = new Produit();
            }

            $form = $this->createForm(ProduitType::class, $produit);
            $form->handleRequest($request);

            dump($produit);
            if ($form->isSubmitted() && $form->isValid()) {
                $produit=$this->produitService->ajouterProduitBdd($produit);
    
                return $this->redirectToRoute('index_produits');
            }
        } catch(ProduitServiceException $e){
            return $this->render('produits/add_produit.html.twig', [
                "form" => [],
                "error" => $e->getMessage()
            ]);
        }

        return $this->render('produits/add_produit.html.twig', [
            "form" => $form->createView()
        ]);

    }


    /**
     * Cette méthode affiche le détail d'un produit depuis un bouton
     * @Route("/produit/detail/{id}", name="detail_produit")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */

    public function detail(int $id): Response
    {
        try {
            $produit=$this->produitService->chercherUnProduit($id);
        } catch(ProduitServiceException $e){
            return $this->render('produits/detail_produit.html.twig', [
                "produit" => [],
                "error" => $e->getMessage()
            ]);
        }
        return $this->render('produits/detail_produit.html.twig', [
            "produit" => $produit
        ]);
    }

}
