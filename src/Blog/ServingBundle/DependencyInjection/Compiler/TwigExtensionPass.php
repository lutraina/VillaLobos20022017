<?php
// src/Blog/ServingBundle/DependencyInjection/Compiler/TwigExtensionPass.php
namespace Blog\ServingBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class TwigExtensionPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        
        $definitionLogger = $container->findDefinition('logger');
        $definitionLogger->addMethodCall('pushHandler', array(new Reference('monolog.handler.main')));
        $definitionLogger->addMethodCall('debug', array('Logger CREATED!'));
        
        
        $definition = $container->findDefinition('blog_twig_extension');
        if($definition){ $definitionLogger->addMethodCall('debug', array('found twig extension!')); }
        $definition->addMethodCall('addExtension', array(new Reference('blog_twig_extension')));
        
        $definition = $container->findDefinition('blog.twig_extension_chain');
        if($definition){ $definitionLogger->addMethodCall('debug', array('found twig extension CHAIN !')); }
        $taggedServices = $container->findTaggedServiceIds('twig.extension');
        if($taggedServices){ $definitionLogger->addMethodCall('debug', array('found tagged services !' . serialize($taggedServices))); }
        
        
        $definition = $container->findDefinition('blog_serving.ckeditor');
        if($definition){ $definitionLogger->addMethodCall('debug', array('found twig extension CKEDITOR !')); }
        $taggedServices = $container->findTaggedServiceIds('form.type');
        if($taggedServices){ $definitionLogger->addMethodCall('debug', array('found tagged services  form type!' . serialize($taggedServices))); }
        $parent = $definition->addMethodCall('setName');
        //$definitionLogger->addMethodCall('debug', array($parent));
        
                                //        // always first check if the primary service is defined
                                //        if (!$container->has('blog.twig_extension_chain')) {
                                //            return;
                                //        }
                                //
                                //        $definition = $container->findDefinition('blog.twig_extension_chain');
                                //
                                //        
                                //        //var_dump($definition);
                                //        // find all service IDs with the blog.twig_extension_chain
                                //        $taggedServices = $container->findTaggedServiceIds('twig.extension');
                                //        //var_dump('%%%%%%%%%%%%');
                                //        //var_dump(count($taggedServices));
                                //        foreach ($taggedServices as $id => $tags) {
                                //            $definition->addMethodCall('addExtension', array(new Reference($id)));
                                //        }    
            
            
//            foreach ($tags as $attributes) {
                // add the transport service to the ChainTransport service
//                $definition = $container->findDefinition('logger');
//                $definition->addMethodCall('debug', array('Logger CREATED!'));
        
        
//                $definition->addMethodCall('addExtension', 
//                    array(
//                        new Reference($id),
//                        $attributes["alias"]
//                ));
                //$definition->addMethodCall('getTest2', array(new Reference($id)));
//             }    
        
    }
}
