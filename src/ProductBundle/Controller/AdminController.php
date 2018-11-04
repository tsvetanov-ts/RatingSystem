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
     * @Template()
     * @Method("GET")
     */

    public function indexAction()
    {
        $users = [];
        $em = $this->getDoctrine()->getManager();
        $topProducts = $em->getRepository('ProductBundle:Product')->loadTopRatedProducts();
        $users = $em->getRepository('UserBundle:User')->loadMostActiveUsers();
        $reviewsByProduct = $em->getRepository('ProductBundle:Reviews')->loadProductReviewsByUser();
        return $this->render('admin/index.html.twig',
            ['topProducts' =>$topProducts, 'users' =>$users, 'reviews'=>$reviewsByProduct]
        );
    }

    /**
     * @Route("/admin/review", name="admin_update_review")
     * @Security("has_role('ROLE_ADMIN')")
     * @Method({"GET", "POST"}) GET for testing only - todo method must be changed!
     */
    public function updaeReviewAction(Request $request)
    {
        $params = $request->query->all();

        $em = $this->getDoctrine()->getManager();
        $review = $em->getRepository(Reviews::class)->find($params['id']);

        if (!$review) {
            throw $this->createNotFoundException(
                'No review found for id '.$params['id']
            );
        }

        //flip value: disproved gets approved and vice versa
        $review->setIsApproved(!(boolval($params['isApproved'])));
        $em->flush();

        return $this->redirectToRoute('admin_index');

    }

}
