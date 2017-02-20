<?php
// src/Blog/ServingBundle/AntispamServing/Antispam.php

namespace Blog\ServingBundle\AntispamServing;

//use Symfony\Component\DependencyInjection\ContainerAwareInterface;
//use Symfony\Component\DependencyInjection\ContainerAwareTrait;

use Psr\Log\LoggerInterface;

class Antispam extends \Twig_Extension
{
    //use ContainerAwareTrait;
	
    private $logger;
	private $mailer;

	public function __construct(LoggerInterface $logger, \Swift_Mailer $mailer){
		$this->logger = $logger;
		$this->mailer = $mailer;
   }
  
  /**
   * Vérifie si le texte est un spam ou non
   *
   * @param string $text
   * @return bool
   */
  public function isSpam($text)
  {
      
    //$logger = $this->container->get('logger');
    $this->logger->info('Nous avons récupéré le logger');
        
    if(strlen($text) > 10){
        throw new \Exception('Votre message a été détecté comme spam !');
    }
    
    return 'retour Antispam correct';
  }
  
  // Twig va exécuter cette méthode pour savoir quelle(s) fonction(s) ajoute notre service
  public function getFunctions()
  {
    return array(
      'checkIfSpam' => new \Twig_Function_Method($this, 'isSpam')
    );
  }
  
  // La méthode getName() identifie votre extension Twig, elle est obligatoire
  public function getName()
  {
    return 'Antispam';
  }
  
}