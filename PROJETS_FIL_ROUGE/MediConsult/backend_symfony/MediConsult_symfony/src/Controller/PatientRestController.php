<?php

namespace App\Controller;


use App\DTO\PatientDTO;
use App\Entity\Patient;
use App\Mapper\PatientMapper;
use FOS\RestBundle\View\View;
use App\Service\PatientService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Put;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Delete;
use App\Service\Exception\PatientServiceException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use OpenApi\Annotations as OA;


/**
 * @OA\Info(
 *      description="Patient Management",
 *      version="V1",
 *      title="Patient Management"
 * )
 */
class PatientRestController extends AbstractFOSRestController
{

    private $patientService;

    const URI_PATIENT_COLLECTION = "/patients";
    const URI_PATIENT_INSTANCE = "/patients/id/{id}";
    const URI_PATIENT_COLLECTION_SPECIALISTES = "/patients/specialistes/{id}";
    const URI_PATIENT_COLLECTION_NOM = "/patients/{nom}";
    const URI_PATIENT_COLLECTION_RENDEZVOUS = "/patients/rendezvous/{id}";
    const URI_PATIENT_COLLECTION_EMAIL = "/patients/{email}";

    public function __construct(PatientService $patientService, EntityManagerInterface $entityManager, PatientMapper $patientMapper){
        $this->patientService = $patientService;
        $this->entityManager = $entityManager;
        $this->patientMapper = $patientMapper;
    }

/**
     * AFFICHAGE DE TOUS LES PATIENTS
     * @OA\Get(
     *     path="/patients",
     *     tags={"Patient"},
     *     summary="Returns a list of PatientDTO",
     *     description="Returns a list of PatientDTO",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/PatientDTO")    
     *     ),
     *      @OA\Response(
     *         response=404,
     *         description="If no PatientDTO found",    
     *     ),
     *      @OA\Response(
     *         response=500,
     *         description="Internal server Error. Please contact us",    
     *     )
     * )
     * @Get(PatientRestController::URI_PATIENT_COLLECTION)
     */
    public function searchAll()
    {
        try {
            $patients = $this->patientService->searchAll();
        } catch (PatientServiceException $e) {
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
        if($patients){
            return View::create($patients, Response::HTTP_OK, ["Content-type" => "application/json"]);
        } else {
            return View::create($patients, Response::HTTP_NOT_FOUND, ["Content-type" => "application/json"]);
        }
    }

    /**
     * POUR AFFICHER LES SPECIALISTES CONSULTES PAR UN PATIENT
     * @OA\Get(
     *  path="/patients/specialistes/{id}",
     *     tags={"Patient"},
     *     summary="Find specialistes saw by a patient",
     *     description="Return a list of specialistes saw by a patient ",
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
     *         @OA\JsonContent(ref="#/components/schemas/PatientDTO")
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
     * @Get(PatientRestController::URI_PATIENT_COLLECTION_SPECIALISTES)
     * @return Response
     */
    public function searchAllSpecialistes(int $id){
        try{
            $specialisteDTO = $this->patientService->searchAllSpecialistesForOnePatient($id);
        }catch(PatientServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR , ["Content-type"   =>  "application/json"]);
        }

        if($specialisteDTO !=null){
            return View :: create($specialisteDTO, Response::HTTP_OK, ["Content_type" => "application/json"]);
        }else{
            return View::create([], Response::HTTP_NOT_FOUND , ["Content-type"   =>  "application/json"]);
        }
        
    }

    /**
     * PERMET A UN PATIENT DE SUPPRIMER SON COMPTE
     * @OA\Delete(
     *     path="/patients/id/{id}",
     *     tags={"Patient"},
     *     summary="Delete patient by ID",
     *     description="Delete patient by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the patient that needs to be deleted",
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
     *         description="Patient not found"
     *     )
     * ),
     * @Delete(PatientRestController::URI_PATIENT_INSTANCE)
     *
     * @param [type] $id
     * @return void
     */
    public function remove(Patient $patient){
        try {
            $this->patientService->delete($patient);
            return View::create([], Response::HTTP_NO_CONTENT, ["Content-type" => "application/json"]);
        } catch(PatientServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
    }

    /**
     * PERMET A UN PATIENT DE CREER SON COMPTE
     * @OA\Post(
     *     path="/patients",
     *     tags={"Patient"},
     *     summary="Create a new PatientDTO",
     *     description="Create a new PatientDTO",
     *     @OA\Response(
     *         response=405,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Patient inserted successfully"
     *     ),
     *     @OA\RequestBody(
     *         description="PatientDTO JSON Object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PatientDTO")
     *     )
     * )
     * @Post(PatientRestController::URI_PATIENT_COLLECTION)
     * @ParamConverter("patientDto", converter="fos_rest.request_body")
     * @return void
     */
    public function create(PatientDTO $patientDto){
        try {
            $this->patientService->persist(new Patient(), $patientDto);
            return View::create([], Response::HTTP_CREATED, ["Content-type" => "application/json"]);
        } catch (PatientServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }

    }

    /**
     * PERMET A UN PATIENT DE MODIFIER SON PROFIL
     * @OA\Put(
     *     path="/patients/id/{id}",
     *     tags={"Patient"},
     *     summary="Update a patient",
     *     description="Update a patient",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the patient to be updated",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             minimum=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Patient not found"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation", 
     *         @OA\JsonContent(ref="#/components/schemas/PatientDTO")   
     *     ),
     *     @OA\RequestBody(
     *         description="Updated patient object",
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PatientDTO")
     *     )
     * )
     * @Put(PatientRestController::URI_PATIENT_INSTANCE)
     * @ParamConverter("patientDto", converter="fos_rest.request_body")
     * @param PatientDTO $patientDto
     * @return void
     */
    public function update(Patient $patient, PatientDTO $patientDto){
        try {
            $this->patientService->persist($patient, $patientDto);
            return View::create([], Response::HTTP_OK, ["Content-type" => "application/json"]);
        } catch (PatientServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
    }

    /**
     * PERMET D'AFFICHER UN PATIENT EN DETAIL
     * @OA\Get(
     *     path="/patients/id/{id}",
     *     tags={"Patient"},
     *     summary="Search Patient by id",
     *     description="Search Patient by id",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of patient that needs to be fetched",
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
     *         @OA\JsonContent(ref="#/components/schemas/PatientDTO")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Patient not found"
     *     )
     * )
     * @Get(PatientRestController::URI_PATIENT_INSTANCE)
     *
     * @return void
     */
    public function searchById(int $id){
        try {
            $patientDto = $this->patientService->searchById($id);
        }catch (PatientServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
        if($patientDto){
            return View::create($patientDto, Response::HTTP_OK, ["Content-type" => "application/json"]);
        } else {
            return View::create([], Response::HTTP_NOT_FOUND, ["Content-type" => "application/json"]);
        }
    }

    /**
     * PERMET DE RECHERCHER DES PATIENTS PAR NOM
     * @OA\Get(
     *     path="/patients/{nom}",
     *     tags={"Patient"},
     *     summary="Search Patient by nom",
     *     description="Search Patient by nom",
     *     @OA\Parameter(
     *         name="nom",
     *         in="path",
     *         description="Name of patient that needs to be fetched",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/PatientDTO")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid name supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Patient not found"
     *     )
     * )
     * @Get(PatientRestController::URI_PATIENT_COLLECTION_NOM)
     *
     * @return void
     */
    public function searchByNom(string $nom){
        try {
            $patientDto = $this->patientService->searchByNom($nom);
        }catch (PatientServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
        if($patientDto){
            return View::create($patientDto, Response::HTTP_OK, ["Content-type" => "application/json"]);
        } else {
            return View::create([], Response::HTTP_NOT_FOUND, ["Content-type" => "application/json"]);
        }
    }

    /**
     * POUR AFFICHER LES RENDEZ-VOUS D'UN PATIENT
     * @OA\Get(
     *  path="/patients/rendezvous/{id}",
     *     tags={"Patient"},
     *     summary="Find rendez-vous of a patient",
     *     description="Return a list of rendez-vous of a patient ",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The patient's id",
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
     *         @OA\JsonContent(ref="#/components/schemas/PatientDTO")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Patient not found"
     *     ),
     *      @OA\Response(
     *         response=500,
     *         description="Internal server Error. Please contact us",    
     *     )
     * )
     * @Get(PatientRestController::URI_PATIENT_COLLECTION_RENDEZVOUS)
     * @return Response
     */
    public function searchAllRendezVous(int $id){
        try{
            $rendezVousDTO = $this->patientService->searchAllRendezVousForOnePatient($id);
        }catch(PatientServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR , ["Content-type"   =>  "application/json"]);
        }

        if($rendezVousDTO !=null){
            return View :: create($rendezVousDTO, Response::HTTP_OK, ["Content_type" => "application/json"]);
        }else{
            return View::create([], Response::HTTP_NOT_FOUND , ["Content-type"   =>  "application/json"]);
        }
        
    }

    /**
     * PERMET DE RECHERCHER DES PATIENTS VIA ADRESSE EMAIL
     * @OA\Get(
     *     path="/patients/{email}",
     *     tags={"Patient"},
     *     summary="Search Patient by email adress",
     *     description="Search Patient by email adress",
     *     @OA\Parameter(
     *         name="email",
     *         in="path",
     *         description="Email adress of patient that needs to be fetched",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/PatientDTO")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid email supplied"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Patient not found"
     *     )
     * )
     * @Get(PatientRestController::URI_PATIENT_COLLECTION_EMAIL)
     *
     * @return void
     */
    public function searchByEmail(string $email){
        try {
            $patientDto = $this->patientService->searchByEmail($email);
        }catch (PatientServiceException $e){
            return View::create($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR, ["Content-type" => "application/json"]);
        }
        if($patientDto){
            return View::create($patientDto, Response::HTTP_OK, ["Content-type" => "application/json"]);
        } else {
            return View::create([], Response::HTTP_NOT_FOUND, ["Content-type" => "application/json"]);
        }
    }


}