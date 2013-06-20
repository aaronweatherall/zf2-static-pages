<?php
namespace StaticPages;

use Zend\Mvc\MvcEvent;
use Zend\Mvc\Router\SimpleRouteStack;
use Zend\Mvc\Router\Http\Literal;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $app = $e->getApplication();
        $sm = $app->getServiceManager();
        $request = $sm->get('Request');
        $resolved = $sm->get('StaticPages\Service\Template');

        if ($resolved !== true) {
            $routeStack = new SimpleRouteStack;
            $route = Literal::factory(array(
                'route' => $request->getRequestUri(),
                'defaults' => array(
                    'controller' => 'StaticPages\Controller\Pages',
                    'action'     => $resolved,
                ),
            ));
            $routeStack->addRoute('StaticPage', $route);
            $e->setRouter($routeStack);
        }

    }

    // Autoload classes from classmap and src folder
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    // Get default module configration file
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

}