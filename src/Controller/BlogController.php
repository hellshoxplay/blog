<?php
/**
 * Created by PhpStorm.
 * User: wilder9
 * Date: 29/10/18
 * Time: 15:59
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{
    /**
     *
     * @Route("/blog/{slug}", name="blog_show", requirements={"slug" ="[a-z0-9-]+"})
     */
    public function show($slug ="article-sans-titre")
    {
        return $this->render('blog/page.html.twig',['slug'=> ucwords(str_replace("-"," ",$slug))]);

    }

}
