<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorie;
use App\Form\CategorieType;
use Symfony\Component\HttpFoundation\Request;
use App\Service\CategorieService;

use App\Service\Exception\CategorieServiceException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CategorieController extends AbstractController
{

    private $categorieService;


    public function __construct(CategorieService $categorieService, UrlGeneratorInterface $urlGenerator){
        $this->categorieService = $categorieService;
        $this->urlGenerator = $urlGenerator;
    }


    /**
     * Cette méthode affiche tous les catégories dans un tableau
     * @Route("/categories", name="index_categories")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */

    public function index(): Response
    {
        try {
            $categories=$this->categorieService->chercherToutesCategories();
        } catch (CategorieServiceException $e){
            return $this->render('categorie/index_categories.html.twig', [
                "categories" => [],
                "error" => $e->getMessage()
            ]);
        }

        return $this->render('categorie/index_categories.html.twig', [
            "categories" => $categories
        ]);
    }

    /**
     * Cette méthode supprime une catégorie depuis un bouton
     * @Route("/categorie/delete/{id}", name="suppression_categorie")
     * @IsGranted("ROLE_ADMIN")
     */

    public function delete(int $id, Request $request, CsrfTokenManagerInterface $csrfTokenManager): Response
    {
        try { // Pour prévenir les attaques Cross-Site Request Forgery (via URL) On ajoute un token (jeton d'authentification, non-connu) dans le lien. 
            $token = new CsrfToken('delete', $request->query->get('_csrf_token'));

            if(!$csrfTokenManager->isTokenValid($token)){
                return new RedirectResponse($this->urlGenerator->generate('index_categories')); // redirection vers page index après connexion
            }

            $categorie=$this->categorieService->chercherUneCategorie($id);
            $categorie = $this->categorieService->supprimerCategorie($categorie);
        } catch(CategorieServiceException $e){
            return $this->redirectToRoute('index_categories', [
                "error" => $e->getMessage()
            ]);
        }

        return $this->redirectToRoute('index_categories');
    }
    

    /**
     * Cette méthode ajoute et modifie une catégorie depuis un formulaire unique
     * @Route("/categorie/add", name="add_categorie")
     * @Route("/categorie/edit/{id}", name="edit_categorie")
     * @IsGranted("ROLE_ADMIN")
     */
    
    public function addOrEdit(?Categorie $categorie, Request $request): Response
    {
        try {
            if (!$categorie) {
                $categorie = new Categorie();
            }

        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $categorie=$this->categorieService->ajouterCategorieBdd($categorie);
                return $this->redirectToRoute('index_categories');
            }
        } catch(CategorieServiceException $e){
            return $this->render('categorie/add_categorie.html.twig', [
                "form" => [],
                "error" => $e->getMessage()
            ]);
        }

        return $this->render('categorie/add_categorie.html.twig', [
            "form" => $form->createView()
        ]);
    }


    /**
     * Cette méthode affiche le détail d'une catégorie depuis un bouton
     * @Route("/categorie/detail/{id}", name="detail_categorie")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */

    public function detail(int $id): Response
    {
        try {
            $categorie=$this->categorieService->chercherUneCategorie($id);
        } catch(CategorieServiceException $e){
            return $this->render('categorie/detail_categorie.html.twig', [
                "categorie" => [],
                "error" => $e->getMessage()
            ]);
        }
        return $this->render('categorie/detail_categorie.html.twig', [
            "categorie" => $categorie
        ]);
    }
}
