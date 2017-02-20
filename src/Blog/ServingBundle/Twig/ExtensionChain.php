<?php 
// src/Blog/ServingBundle/Twig/ExtensionChain.php

namespace Blog\ServingBundle\Twig;
use Psr\Log\LoggerInterface;

class ExtensionChain
{
    private $extensions;
    

     private $logger;
   
    public function __construct(LoggerInterface $logger)
    {
        $this->extensions = array();
        $this->logger = $logger;
    }

    public function addExtension(\Twig_Extension $extension)
    {
        $this->logger->debug(__METHOD__);
        $this->extensions[] = $extension;
    }
    
    public function getExtension($alias)
    {
        if (array_key_exists($alias, $this->extensions)) {
            return $this->extensions[$alias];
        }
    }
    
    public function getTest($alias)
    {
        $this->logger->debug('Logger CREATED V.2!');
                //var_dump('coco');
        if (array_key_exists($alias, $this->extensions)) {
            return $this->extensions[$alias];
        }
    }
    
    public function getTest2()
    {
        $this->logger->debug('Logger CREATED V.2!');
                var_dump('coco');
    }
    
    
}
