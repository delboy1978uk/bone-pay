<?php

declare(strict_types=1);

namespace Bone\Pay;

use Barnacle\Container;
use Barnacle\EntityRegistrationInterface;
use Barnacle\RegistrationInterface;
use Bone\Controller\Init;
use Bone\Pay\Controller\PayApiController;
use Bone\Pay\Controller\PayController;
use Bone\Router\Router;
use Bone\Router\RouterConfigInterface;
use Bone\View\ViewEngine;
use Laminas\Diactoros\ResponseFactory;
use League\Route\RouteGroup;
use League\Route\Strategy\JsonStrategy;

class PayPackage implements RegistrationInterface, RouterConfigInterface, EntityRegistrationInterface
{
    /**
     * @param Container $c
     */
    public function addToContainer(Container $c)
    {
        /** @var ViewEngine $viewEngine */
        $viewEngine = $c->get(ViewEngine::class);
        $viewEngine->addFolder('pay', __DIR__ . '/View/Pay/');

        $c[PayController::class] = $c->factory(function (Container $c) {
            return Init::controller(new PayController(), $c);
        });

        $c[PayApiController::class] = $c->factory(function (Container $c) {
            return new PayApiController();
        });
    }

    /**
     * @param Container $c
     * @param Router $router
     * @return Router
     */
    public function addRoutes(Container $c, Router $router): Router
    {
        $router->map('GET', '/pay', [PayController::class, 'indexAction']);

        $factory = new ResponseFactory();
        $strategy = new JsonStrategy($factory);
        $strategy->setContainer($c);

        $router->group('/api', function (RouteGroup $route) {
            $route->map('GET', '/pay', [PayApiController::class, 'indexAction']);
        })
        ->setStrategy($strategy);

        return $router;
    }
}
