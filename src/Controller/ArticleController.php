<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'app_article')]
    public function index(Request $request, ArticleRepository $articleRepository, CategoryRepository $categoryRepository, EntityManagerInterface $em): Response
    {   
        //$this->denyAccessUnlessGranted("ROLE_USER"); ou #[isBlanted(["blabla"])] Auth
        //$page = $request->query->get('page',1);
        //$articles = $articleRepository->articlePagination($page,2);
        //$limit = ceil($articles->count() / 2);
        //return $this->render('article/index.html.twig', [
        //    'articles' => $articles,
        //    'page'=> $page,
        //    "maxPage" => $limit
        //]);
        $page = $request->query->get('page',1);
        $articles = $articleRepository->articlePagination($page);
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }



    #[Route('/article/edite/{id}', name:'article.edite', methods: ['GET', "POST"])]
    public function update(Article $article, Request $request, EntityManagerInterface $em){
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get("thumbnailFile")->getData();
            $renamefile = $article->getId() . "." . $file->getClientOriginalExtension();
            $file->move($this->getParameter("kernel.project_dir") . '/' . "public/images/article", $renamefile);
            $article->setThumbnail($renamefile);
            $em->persist($article);
            $em->flush();
            $this->addFlash("success","bien modifier");
            return $this->redirectToRoute("app_article");
        }
        return $this->render("article/edit.html.twig", [
            "form"=> $form,
            "article"=> $article,
        ]);
    }
}
