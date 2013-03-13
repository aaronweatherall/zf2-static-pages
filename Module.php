<?php
namespace Pages;

class Module
{
    // Autoload classes from classmap and src folder
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
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