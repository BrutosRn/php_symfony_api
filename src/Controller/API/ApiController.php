<?php
namespace App\Controller\API;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route(path:"/api/articles", name:"api.article")]
    public function index(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAll();
        return $this->json($articles, 200, [], ["groups" => ["article.index"]]);
    }
}