<?php

namespace App\Controller;

use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;

#[Route(path:"/category", name:"category.")]
class CategoryController extends AbstractController
{
    #[Route("/create", name:"create", methods: ["GET", "POST"])]
    public function create(Request $request, EntityManagerInterface $em){
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($category);
            $em->flush();
            $this->addFlash("success","bien enregistré"); 
            return $this->redirectToRoute("category.index");
        }
        return $this->render("category/create.html.twig", [
            "form"=> $form,
        ]);
    }
  
    #[Route(path:"", name:"index")]
    public function store(CategoryRepository $categories){
        $data = $categories->findAll();
        return $this->render("category/index.html.twig", [
            "data"=> $data
        ]);
    }

    #[Route(path:"/edit/{id}", name:"edit", methods: ["GET","POST"])]
    public function edite(Request $request,Category $category, EntityManagerInterface $em){

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($category);
            $em->flush();
            $this->addFlash("success","bien modifié"); 
            return $this->redirectToRoute("category.index");
        }

        return $this->render("category/edit.html.twig", [
            "form"=> $form
        ]);
    }

    #[Route(path:"/del/{id}", name:"delete", methods:['POST'])]
    public function delete(Request $request, Category $category, EntityManagerInterface $em){
            $em->remove($category);
            $em->flush();
            $this->addFlash('success', 'Catégorie supprimée avec succès');
            return $this->redirectToRoute("category.index");
    }

    

    
}