<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Adresse;
use App\Form\AdresseType;
use Symfony\Component\HttpFoundation\Request;
use App\Service\AdresseService;

use App\Service\Exception\AdresseServiceException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AdresseController extends AbstractController
{

    private $adresseService;


    public function __construct(AdresseService $adresseService, UrlGeneratorInterface $urlGenerator){
        $this->adresseService = $adresseService;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * Cette méthode affiche toutes les adresses dans un tableau
     * @Route("/adresses", name="index_adresses")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */

    public function index(): Response
    {
        try {
            $adresses=$this->adresseService->chercherToutesAdresses();
        } catch (AdresseServiceException $e){
            return $this->render('adresse/index_adresses.html.twig', [
                "adresses" => [],
                "error" => $e->getMessage()
            ]);
        }

        return $this->render('adresse/index_adresses.html.twig', [
            "adresses" => $adresses
        ]);
    }

    /**
     * Cette méthode supprime une adresse depuis un bouton
     * @Route("/adresse/delete/{id}", name="suppression_adresse")
     * @IsGranted("ROLE_ADMIN")
     */

    public function delete(int $id, Request $request, CsrfTokenManagerInterface $csrfTokenManager): Response
    {
        try { // Pour prévenir les attaques Cross-Site Request Forgery (via URL) On ajoute un token (jeton d'authentification, non-connu) dans le lien. 
            $token = new CsrfToken('delete', $request->query->get('_csrf_token'));

            if(!$csrfTokenManager->isTokenValid($token)){
                return new RedirectResponse($this->urlGenerator->generate('index_adresses')); // redirection vers page index après connexion
            }

            $adresse=$this->adresseService->chercherUneAdresse($id);
            $adresse=$this->adresseService->supprimerAdresse($adresse);
        } catch(AdresseServiceException $e){
            return $this->redirectToRoute('index_adresses', [
                "error" => $e->getMessage()
            ]);
        }

        return $this->redirectToRoute('index_adresses');
    }
    

    /**
     * Cette méthode ajoute et modifie une adresse depuis un formulaire unique
     * @Route("/adresse/add", name="add_adresse")
     * @Route("/adresse/edit/{id}", name="edit_adresse")
     * @IsGranted("ROLE_ADMIN")
     */
    
    public function addOrEdit(?Adresse $adresse, Request $request): Response
    {
        try {
            if (!$adresse) {
                $adresse = new Adresse();
            }

        $form = $this->createForm(AdresseType::class, $adresse);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $adresse=$this->adresseService->ajouterAdresseBdd($adresse);
                return $this->redirectToRoute('index_adresses');
            }
        } catch(AdresseServiceException $e){
            return $this->render('adresse/add_adresse.html.twig', [
                "form" => [],
                "error" => $e->getMessage()
            ]);
        }

        return $this->render('adresse/add_adresse.html.twig', [
            "form" => $form->createView()
        ]);
    }


    /**
     * Cette méthode affiche le détail d'une adresse depuis un bouton
     * @Route("/adresse/detail/{id}", name="detail_adresse")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */

    public function detail(int $id): Response
    {
        try {
            $adresse=$this->adresseService->chercherUneAdresse($id);
        } catch(AdresseServiceException $e){
            return $this->render('adresse/detail_adresse.html.twig', [
                "adresse" => [],
                "error" => $e->getMessage()
            ]);
        }
        return $this->render('adresse/detail_adresse.html.twig', [
            "adresse" => $adresse
        ]);
    }
}
