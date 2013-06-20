<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'StaticPages' => array(
        'cms_admin' => false,
        'display_exceptions'       => false,
    ),
    'router' => array(
        'routes' => array(
            'StaticPages' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/pages][/:action][/:params][/]',
                    'defaults' => array(
                        'controller' => 'StaticPages\Controller\Pages',
                        'action' => 'index'
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'wildcard' => array(
                        'type' => 'Wildcard'
                    )
                )
            )
        ),
    ),
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
);
