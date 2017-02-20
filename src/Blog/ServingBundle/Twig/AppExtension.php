<?php
// src/Blog/ServingBundle/AntispamServing/Antispam.php

namespace Blog\ServingBundle\Twig;

//use Symfony\Component\DependencyInjection\ContainerAwareInterface;
//use Symfony\Component\DependencyInjection\ContainerAwareTrait;

use Psr\Log\LoggerInterface;

class AppExtension extends \Twig_Extension
{
    //use ContainerAwareTrait;
	
    private $logger;

    public function __construct(LoggerInterface $logger){
        $this->logger = $logger;
    }
  
  /**
   * Vérifie si le texte est un spam ou non
   *
   * @param string $text
   * @return bool
   */
  public function isEmail($text)
  {
    $this->logger->info(__METHOD__);
        
    if($text == 'mail'){
        //throw new \Exception('Votre message a été détecté comme spam !');
        $this->logger->info(__METHOD__ . ' - Detecté adresse mail :' . $text);
        return;
    }
    return 'retour Email correct';
  }
  
  // Twig va exécuter cette méthode pour savoir quelle(s) fonction(s) ajoute notre service
  public function getFunctions()
  {
    return array(
      'checkIfEmail' => new \Twig_Function_Method($this, 'isEmail')
    );
  }
  
  // La méthode getName() identifie votre extension Twig, elle est obligatoire
  public function getName()
  {
    return 'AppExtension';
  }
  
  
  public function addExtension(\Twig_Extension $extension)
    {
        $this->logger->debug(__METHOD__);
        $this->extensions[] = $extension;
        $this->logger->debug(serialize($this->extensions));
        
    }
    
}