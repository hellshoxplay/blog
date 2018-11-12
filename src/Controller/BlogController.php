<?php
/**
 * Created by PhpStorm.
 * User: wilder9
 * Date: 29/10/18
 * Time: 15:59
 */

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{
    /**
     *
     * @Route("/blog/{slug}", name="blog_show", requirements={"slug" ="[a-z0-9-]+"})
     */
    public function show($slug = "article-sans-titre")
    {
        return $this->render('blog/page.html.twig', ['slug' => ucwords(str_replace("-", " ", $slug))]);

    }

    /**
     * @Route("/category/{category}", name="show_articles_in_category")
     *
     */
    public function showCategorywitharticles(Category $category): Response
    {
        return $this->render('blog/articles.html.twig', [
                'articles' => $category->getArticles(),
                'category' => $category,
            ]
        );
    }

}
