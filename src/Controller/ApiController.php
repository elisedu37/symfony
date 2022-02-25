<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Group;
use App\Repository\CategoryRepository;
use App\Repository\GroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ApiController extends AbstractController
{
    #[Route('/api/category', name: 'api_category', methods:["GET"])]
    public function index(CategoryRepository $categoryRepository, SerializerInterface $serializer): Response
    {
        $categories = $categoryRepository->findAll();

        $json = $serializer->serialize($categories,'json', ['groups' => 'category:read']);

        $response = new JsonResponse($json, 200, [], true);

        return $response;
    }

    #[Route('/api/category', name: 'api_category_create', methods:["POST"])]
    public function create(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator){
        $jsonRecu = $request->getContent();
        try{
            $category = $serializer->deserialize($jsonRecu, Category::class, 'json');
            $errors = $validator->validate($category);
            if(count($errors)>0){
                return $this->json($errors, 400);
            }
            $em->persist($category);
            $em->flush();
            return $this->json($category, 201, [], ['groups'=>'post:read']);
        } catch(NotEncodableValueException  $e){
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ],400);
        }
    }

    #[Route('/api/category/{id}', name: 'api_category_update', methods:["PUT"])]
    public function update(Request $request, Category $category, EntityManagerInterface $em, ValidatorInterface $validator):Response
    {
        $jsonRecu = json_decode($request->getContent());
        try{
        if ($jsonRecu->label){
            $category->setLabel($jsonRecu->label);
        }
        $em->persist($category);
        $em->flush();
        return $this->json($category,201,[],['groups'=>'post:read']);
    }   catch(NotEncodableValueException  $e){
        return $this->json([
            'status' => 400,
            'message' => $e->getMessage()
        ],400); 

    }}

    #[Route('/api/group', name: 'api_group', methods:["GET"])]
    public function groupindex(GroupRepository $groupRepository, SerializerInterface $serializer): Response
    {
        $groups = $groupRepository->findAll();

        $json = $serializer->serialize($groups,'json', ['groups' => 'category:read']);

        $response = new JsonResponse($json, 200, [], true);

        return $response;
    }

    #[Route('/api/group', name: 'api_group_create', methods:["POST"])]
    public function groupcreate(Request $request, SerializerInterface $serializer, EntityManagerInterface $em, ValidatorInterface $validator){
        $jsonRecu = $request->getContent();
        try{
            $groups = $serializer->deserialize($jsonRecu, Group::class, 'json');
            $errors = $validator->validate($groups);
            if(count($errors)>0){
                return $this->json($errors, 400);
            }
            $em->persist($groups);
            $em->flush();
            return $this->json($groups, 201, [], ['groups'=>'post:read']);
        } catch(NotEncodableValueException  $e){
            return $this->json([
                'status' => 400,
                'message' => $e->getMessage()
            ],400);
        }
    }

    #[Route('/api/category/{id}', name: 'api_category_delete', methods:["DELETE"])]
    public function deleteCategory(Category $category, EntityManagerInterface $em ):Response
    {
        $em->remove($category);
        $em->flush();
        return $this->json($category,204,[],['groups'=>'post:read']);
    }

  

}
