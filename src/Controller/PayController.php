<?php declare(strict_types=1);

namespace Bone\Pay\Controller;

use Bone\Controller\Controller;
use Bone\Pay\Service\PaymentService;
use Laminas\Diactoros\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PayController extends Controller
{
    /** @var PaymentService */
    private $paymentService;

    /**
     * PayController constructor.
     * @param PaymentService $paymentService
     */
    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * @param ServerRequestInterface $request
     * @param array $args
     * @return ResponseInterface $response
     * @throws \Exception
     */
    public function indexAction(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $body = $this->view->render('pay::index', []);

        return new HtmlResponse($body);
    }
}
