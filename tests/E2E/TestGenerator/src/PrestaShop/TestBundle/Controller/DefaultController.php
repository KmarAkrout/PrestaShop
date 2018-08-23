<?php

namespace PrestaShop\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PrestaShopTestBundle:Default:index.html.twig');
    }
}
