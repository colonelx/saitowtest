<?php
namespace Saitow\Controller;

use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

abstract class BaseController
{
	protected $container;
    protected $api;

    /**
     * BaseController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    /**
     * Renders a view using twig
     * @param $resposne
     * @param $view
     * @param null $data
     */
    protected function renderView($resposne, $view, $data = null)
    {
		if (is_array($data)) {
            $this->container->view->render($resposne, $view, $data);
        } else {
            $this->container->view->render($resposne, $view);
        } 
    }

}
