<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Client;
use App\Form\ClientType;
use Symfony\Component\HttpFoundation\Request;
use App\Service\ClientService;

use App\Service\Exception\ClientServiceException;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ClientController extends AbstractController
{

    private $clientService;


    public function __construct(ClientService $clientService, UrlGeneratorInterface $urlGenerator){
        $this->clientService = $clientService;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * Cette méthode affiche tous les clients dans un tableau
     * @Route("/clients", name="index_clients")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */

    public function index(): Response
    {
        try {
            $clients=$this->clientService->chercherTousClients();
        } catch (ClientServiceException $e){
            return $this->render('client/index_clients.html.twig', [
                "clients" => [],
                "error" => $e->getMessage()
            ]);
        }

        return $this->render('client/index_clients.html.twig', [
            "clients" => $clients
        ]);
    }

    /**
     * Cette méthode supprime un client depuis un bouton
     * @Route("/client/delete/{id}", name="suppression_client")
     * @IsGranted("ROLE_ADMIN")
     */

    public function delete(int $id, Request $request, CsrfTokenManagerInterface $csrfTokenManager): Response
    {
        try { // Pour prévenir les attaques Cross-Site Request Forgery (via URL) On ajoute un token (jeton d'authentification, non-connu) dans le lien. 
            $token = new CsrfToken('delete', $request->query->get('_csrf_token'));

            if(!$csrfTokenManager->isTokenValid($token)){
                return new RedirectResponse($this->urlGenerator->generate('index_categories')); // redirection vers page index après connexion
            }

            $client=$this->clientService->chercherUnClient($id);
            $client = $this->clientService->supprimerClient($client);
        } catch(ClientServiceException $e){
            return $this->redirectToRoute('index_clients', [
                "error" => $e->getMessage()
            ]);
        }

        return $this->redirectToRoute('index_clients');
    }
    

    /**
     * Cette méthode ajoute et modifie un client depuis un formulaire unique
     * @Route("/client/add", name="add_client")
     * @Route("/client/edit/{id}", name="edit_client")
     * @IsGranted("ROLE_ADMIN")
     */
    
    public function addOrEdit(?Client $client, Request $request): Response
    {
        try {
            if (!$client) {
                $client = new Client();
            }

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $client=$this->clientService->ajouterClientBdd($client);
                return $this->redirectToRoute('index_clients');
            }
        } catch(ClientServiceException $e){
            return $this->render('client/add_client.html.twig', [
                "form" => [],
                "error" => $e->getMessage()
            ]);
        }

        return $this->render('client/add_client.html.twig', [
            "form" => $form->createView()
        ]);
    }


    /**
     * Cette méthode affiche le détail d'un client depuis un bouton
     * @Route("/client/detail/{id}", name="detail_client")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */

    public function detail(int $id): Response
    {
        try {
            $client=$this->clientService->chercherUnClient($id);
        } catch(ClientServiceException $e){
            return $this->render('client/detail_client.html.twig', [
                "client" => [],
                "error" => $e->getMessage()
            ]);
        }
        return $this->render('client/detail_client.html.twig', [
            "client" => $client
        ]);
    }


    /**
     * Cette méthode affiche les commandes d'un client depuis un bouton
     * @Route("/client/{id}/commandes", name="commandes_client")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */

    public function afficherCommandes(int $id): Response
    {
        try {
            $client=$this->clientService->chercherUnClient($id);
        } catch(ClientServiceException $e){
            return $this->render('client/commandes_client.html.twig', [
                "client" => [],
                "error" => $e->getMessage()
            ]);
        }
        return $this->render('client/commandes_client.html.twig', [
            "client" => $client
        ]);
    }



}
