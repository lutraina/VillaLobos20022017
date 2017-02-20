<?php

namespace Blog\ServingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Blog\ServingBundle\AntispamServing\Antispam;
use Blog\ServingBundle\Twig\AppExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Blog\ServingBundle\Entity\Biographie;
use Symfony\Component\HttpFoundation\Request;

use Psr\Log\LoggerInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/homepage", name="homepage")
     */
    public function indexAction()
    {
        $this->logger = $this->get('logger');
        $this->logger->info('*****************' . __METHOD__);
        
        $mailer = $this->container->get('mailer'); 
        
        $em = $this->getDoctrine()->getManager();
        $biographies = $em->getRepository('BlogServingBundle:Biographie')->findAll();

        return $this->render('BlogServingBundle:Default:index.html.twig', array(
            'biographies' => $biographies,
            'text' => 'mail'
        ));
                
    }
    
    /**
     * @Route("/homepage/{id}", name="homepage_show")
     */
    public function showAction($id, Biographie $biographie)
    {
        //$deleteForm = $this->createDeleteForm($biographie);

        return $this->render('BlogServingBundle:Default:show.html.twig', array(
            'biographie' => $biographie,
            'text' => 'mail'
            //'delete_form' => $deleteForm->createView(),
        ));
    }
}
