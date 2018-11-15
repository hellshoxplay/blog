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
     * Getting a article with a formatted slug for title
     *
     * @param string $slug The slugger
     *
     * @Route("blog/{slug<^[a-z0-9-]+$>}",
     *     defaults = {"slug" = null}, name = "blog_show")
     *  @return Response A response instance
     */
    public function show($slug): Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article with ' . $slug . ' title, found in article\'s table.'
            );
        }

        return $this->render(
            'blog/page.html.twig',
            [
                'article' => $article,
                'slug' => $slug,
            ]
        );
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

    /**
     * Show all row from article's entity
     *
     * @Route("/", name="homepage")
     * @return Response A response instance
     */
    public function index() : Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        return $this->render(
            'blog/index.html.twig',
            ['articles' => $articles]
        );
    }
    /**
     * @Route("/category/{category}/articles", name="list_by_category")
     * @return Response
     *
     */

    public function showByCategory(string $category): Response
    {
        $selectedcategory=$this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneby(['name'=>$category]);

        $articles=$this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(['category'=>$selectedcategory->getId()],['id'=>'desc'],3);

        return $this->render('blog/listbycategory.html.twig', [
                'articles'=>$articles,
                'category' => $selectedcategory,
            ]
        );
    }

}

