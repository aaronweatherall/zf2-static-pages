<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'pages' => array(
        'cms_admin' => false,
        'display_exceptions'       => false,
    ),
    'router' => array(
        'routes' => array(
            'zf2_static_pages' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '[/pages][/:action][/]',
                    'defaults' => array(
                        'controller' => 'zf2StaticPages\Controller\Pages',
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
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'zf2StaticPages\Controller\Pages' => 'zf2StaticPages\Controller\PagesController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Application' => __DIR__ . '/../view',
        ),
    ),
);
