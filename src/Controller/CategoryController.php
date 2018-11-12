<?php
/**
 * Created by PhpStorm.
 * User: wilder9
 * Date: 12/11/18
 * Time: 10:32
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Category;


class CategoryController extends AbstractController
{

    /**
     * @Route("/category/{id}", name="show_category")
     */
    public function showcategory(Category $category): Response
    {
        return $this->render('blog/category.html.twig', ['category'=>$category]);
    }

}