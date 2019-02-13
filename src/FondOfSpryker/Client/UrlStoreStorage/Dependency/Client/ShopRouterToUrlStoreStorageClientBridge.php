<?php

namespace FondOfSpryker\Client\UrlStoreStorage\Dependency\Client;

use SprykerShop\Yves\ShopRouter\Dependency\Client\ShopRouterToUrlStorageClientBridge as SprykerShopRouterToUrlStorageClientBridge;

class ShopRouterToUrlStoreStorageClientBridge extends SprykerShopRouterToUrlStorageClientBridge implements ShopRouterToUrlStoreStorageClientInterface
{
    /**
     * @var \Spryker\Client\UrlStorage\UrlStorageClientInterface
     */
    protected $urlStorageClient;

    /**
     * @param \Spryker\Client\UrlStorage\UrlStorageClientInterface $urlStorageClient
     */
    public function __construct($urlStorageClient)
    {
        $this->urlStorageClient = $urlStorageClient;
    }

    /**
     * @param string $url
     * @param string $localeName
     *
     * @return array
     */
    public function matchUrl($url,$localeName)
    {
        return $this->urlStorageClient->matchUrl($url, $localeName);
    }
}
