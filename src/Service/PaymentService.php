<?php

namespace Bone\Pay\Service;

use Exception;
use Omnipay\Common\GatewayInterface;
use Omnipay\Omnipay;

class PaymentService
{
    /** @var array [] */
    private $config;

    /**
     * PaymentService constructor.
     * @param array[] $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $name
     * @return GatewayInterface
     * @throws Exception
     */
    public function getAdapter(string $name): GatewayInterface
    {
        if (!isset($this->config['adapters'][$name])) {
            throw new Exception('no config found in bone-pay -> adapters');
        }

        $config = $this->config['adapters'][$name];
        $gateway = Omnipay::create($name);
        $gateway->initialize($config);

        return $gateway;
    }
}