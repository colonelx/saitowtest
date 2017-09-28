<?php

namespace Saitow\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends BaseController
{
    public function indexAction(Request $request, Response $response)
    {
		//echo "sda";
		//die('Here!');
		return $this->renderView($response, 'home.twig');
	}
}
