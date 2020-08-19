<?php

declare(strict_types=1);

namespace Bone\Pay;

use Barnacle\Container;
use Barnacle\RegistrationInterface;
use Bone\Controller\Init;
use Bone\Pay\Controller\PayController;
use Bone\Pay\Service\PaymentService;
use Bone\Router\Router;
use Bone\Router\RouterConfigInterface;
use Bone\View\ViewEngine;

class PayPackage implements RegistrationInterface, RouterConfigInterface
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
            $payConfig = $c->get('bone-pay');
            $paymentService = new PaymentService($payConfig);

            return Init::controller(new PayController($paymentService), $c);
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

        return $router;
    }
}
