<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'app_blog')]
    public function index(ArticleRepository $repo): Response
    {
        $articles = $repo->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'articles' => $articles
        ]);
    }

    #[Route('/', name: 'home')]
    public function home()
    {
        return $this->render('blog/home.html.twig');
    }

    
    #[Route("/blog/new" ,name:"blog_create")]
    public function create()
    {
        return $this->render('blog/create.html.twig');
    }

    #[Route("/blog/{id}", name: "blog_show")]
    public function show(ArticleRepository $repo, $id)
    {
        $article = $repo->find($id);
        return $this->render('blog/show.html.twig', [
            'article' => $article
        ]);
    }
}
