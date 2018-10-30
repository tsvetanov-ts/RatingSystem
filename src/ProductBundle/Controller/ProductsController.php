<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductsController extends Controller
{
    /**
     * @Route("/products")
     */
    public function indexAction()
    {
        return $this->render('ProductBundle:Products:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/products/{id}")
     */
    public function productAction($id)
    {
        return $this->render('ProductBundle:Products:product.html.twig', array(
            'id' => $id
        ));
    }

}
