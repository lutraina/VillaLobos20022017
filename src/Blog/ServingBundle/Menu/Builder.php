<?php 

// src/AppBundle/Menu/Builder.php
namespace Blog\ServingBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Home', array('route' => 'homepage'));

        // access services from the container!
        $em = $this->container->get('doctrine')->getManager();
        // findMostRecent and Blog are just imaginary examples
        $blog = $em->getRepository('BlogServingBundle:Biographie')->find(1);

        $menu->addChild('Latest Blog Post', array(
            'route' => 'biographie_new',
            'routeParameters' => array('id' => $blog->getId())
        ));

        // create another menu item
        $menu->addChild('About Me', array('route' => 'biographie_new'));
        // you can also add sub level's to your menu's as follows
        $menu['About Me']->addChild('Edit profile', array('route' => 'biographie_new'));

        // ... add more children

        return $menu;
    }
}