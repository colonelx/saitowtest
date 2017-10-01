<?php

namespace Saitow\Controller;

use Saitow\Exceptions\TiresNotFoundException;
use Saitow\Library\Paginator;
use Saitow\Library\TiresDataSource;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends BaseController
{
    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     */
    public function indexAction(Request $request, Response $response, $args)
    {
        $orderBy = $_SESSION['orderBy'];
        $tiresRepo = $this->container->tiresRepository;
        $allTires = $tiresRepo->getAll(['orderBy' => $orderBy]);

        $page = (isset($args['page'])) ? $args['page'] : 1;
        $perPage = $this->container->config['productsPerPage'];
        $paginator = new Paginator($page, $perPage, $allTires);

        return $this->renderView($response, 'home.twig', [
            'tires' => $paginator->getPageItems(),
            'links' => $paginator->getPaginationLinks(),
            'orderBy' => $orderBy,
            'orderByOptions' => [
                TiresDataSource::ORDERBY_MANUFACTURE,
                TiresDataSource::ORDERBY_PRICE
            ]
        ]);
    }

    public function searchAction(Request $request, Response $response, $args)
    {
        $orderBy = $_SESSION['orderBy'];
        $tiresRepo = $this->container->tiresRepository;
        $allTires = $tiresRepo->getAll([
            'orderBy' => $orderBy,
            'searchTerm' => $args['term']
        ]);

        $page = (isset($args['page'])) ? $args['page'] : 1;
        $perPage = $this->container->config['productsPerPage'];
        $paginator = new Paginator($page, $perPage, $allTires);

        return $this->renderView($response, 'search.twig', [
            'tires' => $paginator->getPageItems(),
            'links' => $paginator->getPaginationLinks(),
            'orderBy' => $orderBy,
            'searchTerm' => $args['term'],
            'orderByOptions' => [
                TiresDataSource::ORDERBY_MANUFACTURE,
                TiresDataSource::ORDERBY_PRICE
            ]
        ]);
    }

    public function changeOrderAction(Request $request, Response $response)
    {
        $orderBy = $request->getParsedBodyParam('orderBy');
        $_SESSION['orderBy'] = $orderBy;
        $returnUrl = $request->getParsedBodyParam('returnUrl');

        return $response->withRedirect($returnUrl);
    }

    public function itemAction(Request $request, Response $response, $args)
    {
        try {
            $tiresRepo = $this->container->tiresRepository;
            $tire = $tiresRepo->get($args);
        } catch (TiresNotFoundException $ex) {
            $notFoundHandler = $this->container->get('notFoundHandler');
            return $notFoundHandler($request, $response);
        }

        return $this->renderView($response, 'tire.twig', [
            'orderByOptions' => [
                TiresDataSource::ORDERBY_MANUFACTURE,
                TiresDataSource::ORDERBY_PRICE
            ],
            'item' => $tire
        ]);
    }
}
