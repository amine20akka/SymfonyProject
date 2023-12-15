<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog')]
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
    public function create(Request $request, ArticleRepository $repo)
    {
        $article = new Article();
        $form = $this->createFormBuilder($article)
                    ->add('title', TextType::class, [
                        'attr' => [
                            'placeholder' => "Titre de l'article"
                        ]
                    ])
                    ->add('content', TextareaType::class, [
                        'attr' => [
                            'placeholder' => "Contenu de l'article"
                        ]
                    ])
                    ->add('image', TextType::class, [
                        'attr' => [
                            'placeholder' => "Contenu de l'article"
                        ]
                    ])
                    ->getForm();
        return $this->render('blog/create.html.twig',[
            'formArticle' => $form->createView()
        ]);
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
