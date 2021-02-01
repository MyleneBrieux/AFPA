<?php

namespace App\Controller;


use App\DTO\RendezVousDTO;
use App\Entity\RendezVous;
use App\Mapper\RendezVousMapper;
use FOS\RestBundle\View\View;
use App\Service\RendezVousService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Put;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use App\Service\Exception\RendezVousServiceException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;


/**
 * @OA\Info(
 *      description="RendezVous Management",
 *      version="V1",
 *      title="RendezVous Management"
 * )
 */
class RendezVousRestController extends AbstractFOSRestController
{

    private $rendezVousService;

    const URI_RENDEZVOUS_COLLECTION = "/rendezvous";
    const URI_RENDEZVOUS_INSTANCE = "/rendezvous/{id}";

    public function __construct(RendezVousService $rendezVousService, EntityManagerInterface $entityManager, RendezVousMapper $rendezVousMapper){
        $this->rendezVousService = $rendezVousService;
        $this->entityManager = $entityManager;
        $this->rendezVousMapper = $rendezVousMapper;
    }
    

    /**
     * PERMET DE SUPPRIMER UN RENDEZ-VOUS
     * @OA\Delete(
     *     path="/rendezvous/{id}",
     *     tags={"RendezVous"},
     *     summary="Delete rendezVous by ID",
     *     description="Delete rendezVous by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the rendezVous that needs to be deleted",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             minimum=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="RendezVous not found"
     *     )
     * ),
     * @Delete(RendezVousRestController::URI_RENDEZVOUS_INSTANCE)
     *
     * @param [type] $id
     * @return void
     */
    public function remove(RendezVous $rendezVous){
        try {
            $this->rendezVousService->delete($rendezVous);
            return View::create([], Response::HTTP_NO_CONTENT, ["Content-type" => "application/json"]);
        } catch(RendezVousServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
    }

    /**
     * PERMET DE PRENDRE UN RENDEZ-VOUS
     * @OA\Post(
     *     path="/rendezvous",
     *     tags={"RendezVous"},
     *     summary="Create a new RendezVousDTO",
     *     description="Create a new RendezVousDTO",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="RendezVous inserted successfully"
     *     ),
     *     @OA\RequestBody(
     *         description="RendezVousDTO JSON Object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/RendezVousDTO")
     *     )
     * )
     * @Post(RendezVousRestController::URI_RENDEZVOUS_COLLECTION)
     * @ParamConverter("rendezVousDto", converter="fos_rest.request_body")
     * @return void
     */
    public function create(RendezVousDTO $rendezVousDto){
        try {
            $this->rendezVousService->persist(new RendezVous(), $rendezVousDto);
            return View::create([], Response::HTTP_CREATED, ["Content-type" => "application/json"]);
        } catch (RendezVousServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }

    }

    /**
     * PERMET DE MODIFIER UN RENDEZ-VOUS
     * @OA\Put(
     *     path="/rendezvous/{id}",
     *     tags={"RendezVous"},
     *     summary="Update a rendezVous",
     *     description="Update a rendezVous",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the rendezVous to be updated",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             minimum=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="RendezVous not found"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation", 
     *         @OA\JsonContent(ref="#/components/schemas/RendezVousDTO")   
     *     ),
     *     @OA\RequestBody(
     *         description="Updated rendezVous object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/RendezVousDTO")
     *     )
     * )
     * @Put(RendezVousRestController::URI_RENDEZVOUS_INSTANCE)
     * @ParamConverter("rendezVousDto", converter="fos_rest.request_body")
     * @param RendezVousDTO $rendezVousDto
     * @return void
     */
    public function update(RendezVous $rendezVous, RendezVousDTO $rendezVousDto){
        try {
            $this->rendezVousService->persist($rendezVous, $rendezVousDto);
            return View::create([], Response::HTTP_OK, ["Content-type" => "application/json"]);
        } catch (RendezVousServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
    }

    /**
     * PERMET D'AFFICHER UN RENDEZ-VOUS EN PARTICULIER
     * @OA\Get(
     *     path="/rendezvous/{id}",
     *     tags={"RendezVous"},
     *     summary="Search rendezVous by id",
     *     description="Search rendezVous by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of rendezVous that needs to be fetched",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             minimum=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/RendezVousDTO")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="RendezVous not found"
     *     )
     * )
     * @Get(RendezVousRestController::URI_RENDEZVOUS_INSTANCE)
     *
     * @return void
     */
    public function searchById(int $id){
        try {
            $rendezVousDto = $this->rendezVousService->searchById($id);
        }catch (RendezVousServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
        if($rendezVousDto){
            return View::create($rendezVousDto, Response::HTTP_OK, ["Content-type" => "application/json"]);
        } else {
            return View::create([], Response::HTTP_NOT_FOUND, ["Content-type" => "application/json"]);
        }
    }

    


}
