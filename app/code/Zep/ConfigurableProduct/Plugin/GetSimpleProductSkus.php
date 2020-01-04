<?php
/**
 * Plugin to obtain the sku og simple product 
 * inside a collecion of configurable product
 * 
 * Copyright © ZepHakase. All rights are reserved
 * See COPYING.txt for license details.
 */

 namespace Zep\ConfigurableProduct\Plugin;

 

 class GetSimpleProductSkus
 {
    /**
     * @var \Magento\Framework\Json\EncoderInterface
    */
    protected $jsonEncoder;

    /**
     * @var \Magento\Framework\Json\DecoderInterface
    */
    protected $jsonDecoder;

    public function __construct(
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\Json\DecoderInterface $jsonDecoder
    )   {
            $this->jsonEncoder = $jsonEncoder;
            $this->jsonDecoder = $jsonDecoder;
    } 

    public function afterGetJsonConfig(Magento\ConfigurableProduct\Block\Product\View\Type\Configurable $subject, $result) {
        $config = $this->jsonDecoder->decode($result);

        $config['skus'] = [];
        foreach ($subject->getAllowProducts() as $simpleProduct) {
            $config['skus'][$simpleProduct->getId()] = $simpleProduct->getSku();
        }
        
        return $this->jsonEncoder->encode($config);
    }
 }