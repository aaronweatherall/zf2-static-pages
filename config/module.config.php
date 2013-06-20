<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'controllers' => array(
        'invokables' => array(
            'StaticPages\Controller\Pages' => 'StaticPages\Controller\PagesController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'StaticPages' => __DIR__ . '/../view',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'StaticPages\Service\Template' => 'StaticPages\Service\TemplateServiceFactory',
        ),
    ),
);
