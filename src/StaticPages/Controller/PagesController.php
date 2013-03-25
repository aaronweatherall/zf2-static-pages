<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace StaticPages\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Controller\Action;
use Zend\View\Model\ViewModel;

class PagesController extends AbstractActionController
{

    /**
     * Overload default not found action to check for a template
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function notFoundAction()
    {
        // Check if a template exists for the current requested action
        $template = $this->getTemplate();
        if (false === $template) {
            // If not, return a 404
            $this->getResponse()->setStatusCode(404);
        }

        // Return the requested template
        $viewModel = new ViewModel(array('static' => true,));
        $viewModel->setTemplate($template);

        return $viewModel;
    }

    /**
     * Get path to template
     *
     * @return string, bool
     */
    protected function getTemplate()
    {
        // Create Directory Separator define shortcut
        if (! defined('DS')) {
            define('DS', DIRECTORY_SEPARATOR);
        }

        $path = 'static-pages' . DS . 'pages' . DS;
        $routeParams = $this->getEvent()->getRouteMatch()->getParams();

        // Get the template path stack from the service manager
        $resolver = $this->getEvent()
            ->getApplication()
            ->getServiceManager()
            ->get('Zend\View\Resolver\TemplatePathStack');

        // Get the request URI (to deal with extra un-named parameters
        $exp = explode('/', $this->getRequest()->getRequestUri());

        // Slice out any prefix aka pages
        $template = $path . implode(DS, array_slice($exp, array_search($routeParams['action'], $exp)));

        // Attempt to resolve the template
        $resolved_template = $resolver->resolve($template);

        // If template is not found, return false
        if (false === $resolved_template) {
            return false;
        }

        // Return the template to the viewManager
        return $template;
    }
}
