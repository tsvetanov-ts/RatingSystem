<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;

umask(0000);

$loader = require_once __DIR__.'/app/bootstrap.php.cache';
Debug::enable();

require_once __DIR__.'/app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$kernel->boot();

$container = $kernel->getContainer();
$container->enterScope('request');
$container->set('request', $request);

// all our setup is done!!!!!!

$em = $container->get('doctrine')
    ->getManager()
;

$product_repo = $em
    ->getRepository('ProductBundle:Product');
$review_repo = $em
    ->getRepository('ProductBundle:Reviews');


//var_dump($product_repo->loadAverageProductRating(2));
//var_dump($product_repo->loadTopRatedProducts(5));
//var_dump($product_repo->selectStar());
var_dump($review_repo->findAll());
