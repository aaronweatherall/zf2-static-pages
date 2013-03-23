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
        $template = $this->getTemplate() ;
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
     * @return bool
     */
    protected function getTemplate()
    {
        $controllerName = strtolower($this->params('controller'));
        $exp = explode('/', $this->getRequest()->getRequestUri());

        // Get the template path stack from the service manager
        $resolver = $this->getEvent()
            ->getApplication()
            ->getServiceManager()
            ->get('Zend\View\Resolver\TemplatePathStack');

        $template = implode(DIRECTORY_SEPARATOR, $exp) ;

        if (false === $resolver->resolve('static-pages' . DIRECTORY_SEPARATOR . 'pages' . $template)) {
            return false;
        }

        return $template;
    }
}
