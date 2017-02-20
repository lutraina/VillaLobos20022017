<?php

namespace Blog\ServingBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Blog\ServingBundle\DependencyInjection\Compiler\CustomPass;
use Blog\ServingBundle\DependencyInjection\Compiler\TwigExtensionPass;

class BlogServingBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new TwigExtensionPass());
    }
    
}
