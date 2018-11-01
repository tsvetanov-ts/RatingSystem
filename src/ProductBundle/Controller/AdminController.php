<?php

namespace ProductBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use ProductBundle\Entity\Product;
use ProductBundle\Entity\Reviews;
use UserBundle\Entity\User;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin_index")
     * @Security("has_role('ROLE_ADMIN')")
     */

    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('ProductBundle:Product')->loadTopRatedProducts();
        $users = $em->getRepository('UserBundle:User')->loadMostActiveUsers();
        $reviewsByProduct = $em->getRepository('ProductBundle:Reviews')->loadProductReviewsByUser();
        return $this->render('ProductBundle:Admin:index.html.twig', array(
            ['products' =>$products, 'users' =>$users, 'reviews'=>$reviewsByProduct]
        ));
    }

}
