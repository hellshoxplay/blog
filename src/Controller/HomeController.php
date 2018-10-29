<?php
/**
 * Created by PhpStorm.
 * User: wilder9
 * Date: 29/10/18
 * Time: 11:23
 */

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class HomeController extends AbstractController
{

    /**
     * @return Response
     * @throws \Exception
     * @route("/home")
     */
    public function index()
    {

        return $this->render('home.html.twig');

    }

}