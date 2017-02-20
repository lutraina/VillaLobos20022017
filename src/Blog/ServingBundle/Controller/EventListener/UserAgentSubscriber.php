<?php

namespace Blog\ServingBundle\Controller\EventListener;

use \Symfony\Component\EventDispatcher\EventSubscriberInterface;
use \Psr\Log\LoggerInterface;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;


class UserAgentSubscriber implements EventSubscriberInterface
{
    /**
     *
     * @var logger 
     */
    private $logger;
    
    public function __construct(LoggerInterface $logger) {
        $this->logger =  $logger;
    }
    
    public function onKernelRequest(GetResponseEvent $event){
        $this->logger->info('Raaaaaaaaaawwwwwwwwww');
        //dump($event);
        $request = $event->getRequest();
        $headers = $request->headers->get('User-Agent');
        $this->logger->info('The user agent is : ' . $headers);
        
//        if (rand(0, 100) > 50) {
            //$response = new Response('Come back later');
            //$event->setResponse($response);
//        }
        
       /* $request->attributes->set('_controller', function($id) {
            return new Response('Hello Dinosaur! id : ' . $id);
        });*/
    
    }
    
    public static function getSubscribedEvents() {
        
        // constant that means kernel.request
    
        return array(
            KernelEvents::REQUEST => 'onKernelRequest',
            //KernelEvents::CONTROLLER => 'onKernelRequest',
        );
    }

    
}