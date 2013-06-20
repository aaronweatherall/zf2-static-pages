<?php

namespace StaticPages\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods as Hydrator;

/**
 * Simple authentication provider factory
 *
 * @author Ingo Walz <ingo.walz@googlemail.com>
 */
class templateServiceFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $request = $serviceLocator->get('Request');
        $path = 'static-pages' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR;
        $exp = explode('/', $request->getRequestUri());
        if ($exp[0] == '') unset($exp[0]);

        $template = $path . implode(DIRECTORY_SEPARATOR, $exp);

        $exp = explode('/', $template);
        $action = end($exp);

        $resolver = $serviceLocator->get('Zend\View\Resolver\TemplatePathStack');

        if ($resolver->resolve($template)) {
            return $action;
        };

        return true;
    }

}