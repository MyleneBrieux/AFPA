<?php

namespace App\Controller;


use App\DTO\SpecialisteDTO;
use App\Entity\Specialiste;
use FOS\RestBundle\View\View;
use OpenApi\Annotations as OA;
use App\Mapper\SpecialisteMapper;
use App\Service\SpecialisteService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Put;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use App\Service\Exception\SpecialisteServiceException;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


/**
 * @OA\Info(
 *      description="Specialiste Management",
 *      version="V1",
 *      title="Specialiste Management"
 * )
 */
class SpecialisteRestController extends AbstractFOSRestController
{

    private $praticienService;

    const URI_SPECIALISTE_COLLECTION = "/specialistes";
    const URI_SPECIALISTE_COLLECTION_SPECIALITE = "/specialistes/{specialite}";
    const URI_SPECIALISTE_INSTANCE = "/specialistes/id/{id}";
    const URI_SPECIALISTE_COLLECTION_PATIENTS = "/specialistes/patients/{id}";
    const URI_SPECIALISTE_COLLECTION_RENDEZVOUS = "/specialistes/rendezvous/{id}";

    public function __construct(SpecialisteService $specialisteService, EntityManagerInterface $entityManager, SpecialisteMapper $specialisteMapper){
        $this->specialisteService = $specialisteService;
        $this->entityManager = $entityManager;
        $this->specialisteMapper = $specialisteMapper;
    }

    /**
     * AFFICHAGE DE TOUS LES SPECIALISTES
     * @OA\Get(
     *     path="/specialistes",
     *     tags={"Specialiste"},
     *     summary="Returns a list of SpecialisteDTO",
     *     description="Returns a list of SpecialisteDTO",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/SpecialisteDTO")    
     *     ),
     *      @OA\Response(
     *         response=404,
     *         description="If no SpecialisteDTO found",    
     *     ),
     *      @OA\Response(
     *         response=500,
     *         description="Internal server Error. Please contact us",    
     *     )
     * )
     * @Get(SpecialisteRestController::URI_SPECIALISTE_COLLECTION)
     */
    public function searchAll()
    {
        try {
            $specialistes = $this->specialisteService->searchAll();
        } catch (SpecialisteServiceException $e) {
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
        if($specialistes){
            return View::create($specialistes, Response::HTTP_OK, ["Content-type" => "application/json"]);
        } else {
            return View::create($specialistes, Response::HTTP_NOT_FOUND, ["Content-type" => "application/json"]);
        }
    }

    /**
     * SUPPRESSION D'UN SPECIALISTE / SON PROPRE COMPTE
     * @OA\Delete(
     *     path="/specialistes/id/{id}",
     *     tags={"Specialiste"},
     *     summary="Delete specialiste by ID",
     *     description="Delete specialiste by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the specialiste that needs to be deleted",
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
     *         description="Specialiste not found"
     *     )
     * ),
     * @Delete(SpecialisteRestController::URI_SPECIALISTE_INSTANCE)
     *
     * @param [type] $id
     * @return void
     */
    public function remove(Specialiste $specialiste){
        try {
            $this->specialisteService->delete($specialiste);
            return View::create([], Response::HTTP_NO_CONTENT, ["Content-type" => "application/json"]);
        } catch(SpecialisteServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
    }

    /**
     * CREATION D'UN SPECIALISTE / CREATION DE SON COMPTE
     * @OA\Post(
     *     path="/specialistes",
     *     tags={"Specialiste"},
     *     summary="Create a new SpecialisteDTO",
     *     description="Create a new SpecialisteDTO",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Specialiste inserted successfully"
     *     ),
     *     @OA\RequestBody(
     *         description="SpecialisteDTO JSON Object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/SpecialisteDTO")
     *     )
     * )
     * @Post(SpecialisteRestController::URI_SPECIALISTE_COLLECTION)
     * @ParamConverter("specialisteDto", converter="fos_rest.request_body")
     * @return void
     */
    public function create(SpecialisteDTO $specialisteDto){
        try {
            $this->specialisteService->persist(new Specialiste(), $specialisteDto);
            return View::create([], Response::HTTP_CREATED, ["Content-type" => "application/json"]);
        } catch (SpecialisteServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }

    }

    /**
     * MODIFICATION D'UN SPECIALISTE / DE SON PROPRE PROFIL
     * @OA\Put(
     *     path="/specialistes/id/{id}",
     *     tags={"Specialiste"},
     *     summary="Update a specialiste",
     *     description="Update a specialiste",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the specialiste to be updated",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             minimum=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Specialiste not found"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation", 
     *         @OA\JsonContent(ref="#/components/schemas/SpecialisteDTO")   
     *     ),
     *     @OA\RequestBody(
     *         description="Updated specialiste object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/SpecialisteDTO")
     *     )
     * )
     * @Put(SpecialisteRestController::URI_SPECIALISTE_INSTANCE)
     * @ParamConverter("specialisteDto", converter="fos_rest.request_body")
     * @param SpecialisteDTO $specialisteDto
     * @return void
     */
    public function update(Specialiste $specialiste, SpecialisteDTO $specialisteDto){
        try {
            $this->specialisteService->persist($specialiste, $specialisteDto);
            return View::create([], Response::HTTP_OK, ["Content-type" => "application/json"]);
        } catch (SpecialisteServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
    }

    /**
     * POUR AFFICHER UN SPECIALISTE EN DETAIL
     * @OA\Get(
     *     path="/specialistes/id/{id}",
     *     tags={"Specialiste"},
     *     summary="Search Specialiste by id",
     *     description="Search Specialiste by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of specialiste that needs to be fetched",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/SpecialisteDTO")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Specialiste not found"
     *     )
     * )
     * @Get(SpecialisteRestController::URI_SPECIALISTE_INSTANCE)
     *
     * @return void
     */
    public function searchById(int $id){
        try {
            $specialisteDto = $this->specialisteService->searchById($id);
        }catch (SpecialisteServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
        if($specialisteDto){
            return View::create($specialisteDto, Response::HTTP_OK, ["Content-type" => "application/json"]);
        } else {
            return View::create([], Response::HTTP_NOT_FOUND, ["Content-type" => "application/json"]);
        }
    }

    /**
     * POUR AFFICHER LES SPECIALISTES SELON UNE SPECIALITE
     * @OA\Get(
     *     path="/specialistes/{specialite}",
     *     tags={"Specialiste"},
     *     summary="Search Specialiste by specialite",
     *     description="Search Specialiste by specialite",
     *     @OA\Parameter(
     *         name="specialite",
     *         in="path",
     *         description="Group specialistes by specialite",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/SpecialisteDTO")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid specialite supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Specialiste not found"
     *     )
     * )
     * @Get(SpecialisteRestController::URI_SPECIALISTE_COLLECTION_SPECIALITE)
     *
     * @return void
     */
    public function searchSpecialistesBySpecialite(string $specialite){
        try {
            $specialisteDto = $this->specialisteService->searchBySpecialite($specialite);
        }catch (SpecialisteServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
        if($specialisteDto){
            return View::create($specialisteDto, Response::HTTP_OK, ["Content-type" => "application/json"]);
        } else {
            return View::create([], Response::HTTP_NOT_FOUND, ["Content-type" => "application/json"]);
        }
    }

    /**
     * POUR AFFICHER LES PATIENTS D'UN SPECIALISTE
     * @OA\Get(
     *     path="/specialistes/patients/{id}",
     *     tags={"Specialiste"},
     *     summary="Return a list of patients for a specialiste",
     *     description="Return a list of patients for a specialiste",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The specialiste's id for who we search the patients",
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
     *         @OA\JsonContent(ref="#/components/schemas/SpecialisteDTO")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Specialiste not found"
     *     )
     * )
     * @Get(SpecialisteRestController::URI_SPECIALISTE_COLLECTION_PATIENTS)
     * @return Response
     */
    public function searchAllPatients(int $id){
        try{
            $patientDTO = $this->specialisteService->searchAllPatientsForOneSpecialiste($id);
        }catch(SpecialisteServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR , ["Content-type"   =>  "application/json"]);
        }
        if($patientDTO !=null){
            return View :: create($patientDTO, Response::HTTP_OK, ["Content_type" => "application/json"]);
        }else{
            return View::create([], Response::HTTP_NOT_FOUND , ["Content-type"   =>  "application/json"]);
        }
        
    }

    /**
     * POUR AFFICHER LES RENDEZ-VOUS D'UN SPECIALISTE
     * @OA\Get(
     *  path="/specialistes/rendezvous/{id}",
     *     tags={"Specialiste"},
     *     summary="Find rendez-vous of a specialiste",
     *     description="Return a list of rendez-vous of a specialiste",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The specialiste's id",
     *         required=true,
     *         @OA\Schema(
     *             type="number",
     *             format="int64",
     *             minimum=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/SpecialisteDTO")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Specialiste not found"
     *     ),
     *      @OA\Response(
     *         response=500,
     *         description="Internal server Error. Please contact us",    
     *     )
     * )
     * @Get(SpecialisteRestController::URI_SPECIALISTE_COLLECTION_RENDEZVOUS)
     * @return Response
     */
    public function searchAllRendezVous(int $id){
        try{
            $rendezVousDTO = $this->specialisteService->searchAllRendezVousForOneSpecialiste($id);
        }catch(SpecialisteServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR , ["Content-type"   =>  "application/json"]);
        }

        if($rendezVousDTO !=null){
            return View :: create($rendezVousDTO, Response::HTTP_OK, ["Content_type" => "application/json"]);
        }else{
            return View::create([], Response::HTTP_NOT_FOUND , ["Content-type"   =>  "application/json"]);
        }
        
    }


}
