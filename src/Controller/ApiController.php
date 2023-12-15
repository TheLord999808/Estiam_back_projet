<?php

namespace App\Controller;

use MongoDB\BSON\ObjectId;
use App\Document\Parrains;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    private $documentManager;

    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    #[Route('/api', name: 'app_api')]
    public function index(): Response
    {
    
    dd($this->documentManager);
    return $this->render('api/index.html.twig', [
    'controller_name' => 'ApiController',
    ]); 
    
    }

    #[Route('/parrains', name: 'app_api_parrains_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);

            $document = new Parrains();
            $document->setCivilite($data['Civilite']);
            $document->setNom($data['Nom']);
            $document->setPrenom($data['Prenom']);
            $document->setMandat($data['Mandat']);
            $document->setCirconscription($data['Circonscription']);
            $document->setDepartement($data['Departement']);
            $document->setCandidat($data['Candidat']);
            $document->setDatePublication($data['DatePublication']);

            $this->documentManager->persist($document);
            $this->documentManager->flush();

            $this->documentManager->persist($document);
            $this->documentManager->flush();
    
            
            return $this->json(['message' => 'Document created successfully', 'id' => $document->getId()], 201);
        } catch (\Exception $e) {
            return $this->json(['error' => $e->getMessage()], 500);
        }
    }

    #[Route('/parrains/{id}', name: 'app_api_parrains_read', methods: ['GET'])]
    public function read($id): JsonResponse
    {
        try {
            $objectId = new ObjectId($id);
            $document = $this->documentManager->getRepository(Parrains::class)->find($objectId);

            if (!$document) {
                return $this->json(['error' => 'Document not found'], 404);
            }

            // Transform $document to an array or use a serializer as needed
            $data = []; // Transform $document to array

            return $this->json($data);
        } catch (\Exception $e) {
            // Log the exception for debugging
            error_log('Exception in read method: ' . $e->getMessage());

            return $this->json(['error' => 'Internal server error'], 500);
        }
    }

    #[Route('/parrains/{id}', name: 'app_api_parrains_update', methods: ['put'])]
    public function update(Request $request, $id): JsonResponse
    {
        $document = $this->documentManager->getRepository(Parrains::class)->find($id);
    
        if (!$document) {
            return $this->json(['error' => 'Document not found'], 404);
        }
    
        $data = json_decode($request->getContent(), true);
    
        // Update document fields from $data
        $document->setCivilite($data['Civilite']);
        $document->setNom($data['Nom']);
        $document->setPrenom($data['Prenom']);
        $document->setMandat($data['Mandat']);
        $document->setCirconscription($data['Circonscription']);
        $document->setDepartement($data['Departement']);
        $document->setCandidat($data['Candidat']);
    
        // Ensure Data remains the same
        $document->setId($data['id']);
        $document->setDatePublication($data['DatePublication']); // Set the DatePublication field
    
        $this->documentManager->flush();
    
        return $this->json(['message' => 'Document updated successfully']);
    }    

    #[Route('/parrains/{id}', name: 'app_api_parrains_delete', methods: ['delete'])]
    public function delete($id): JsonResponse
    {
        $document = $this->documentManager->getRepository(Parrains::class)->find($id);

        if (!$document) {
            return $this->json(['error' => 'Document not found'], 404);
        }

        $this->documentManager->remove($document);
        $this->documentManager->flush();

        return $this->json(['message' => 'Document deleted successfully']);
    }
}
