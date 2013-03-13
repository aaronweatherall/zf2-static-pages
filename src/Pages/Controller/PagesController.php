<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pages\Controller;

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
        if ( $this->getTemplate() === FALSE ) {

            // If not, return a 404
            $this->getResponse()->setStatusCode( 404 );
        }

        // Return the requested template
        return new ViewModel( array( 'static' => TRUE, ) );
    }

    /**
     * Get path to template
     *
     * @return bool
     */
    protected function getTemplate()
    {

        // get requested controller and action
        $controllerName = strtolower( $this->params( 'controller' ) );
        $actionName = $this->params( 'action' );

        // Get the template path stack from the service manager
        $resolver = $this->getEvent()->getApplication()->getServiceManager()->get( 'Zend\View\Resolver\TemplatePathStack' );

        if ( FALSE === $resolver->resolve( $this->getTemplatePath( $controllerName, $actionName ) ) ) {
            return FALSE;
        }

        return TRUE;
    }

    /**
     * Get path to template
     *
     * @param $controllerName
     * @param $actionName
     *
     * @return string
     */
    protected function getTemplatePath( $controllerName, $actionName)
    {
        // TODO: Kinda hacky but it works
        // Change this function when a better way is discovered!

        return str_replace(array('\controller', '\\'), array('', '/'), $controllerName) . '/' . $actionName;
    }
}
