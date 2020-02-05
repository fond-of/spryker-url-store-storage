<?php

namespace FondOfSpryker\Client\UrlStoreStorage;

use Spryker\Client\UrlStorage\UrlStorageClient as SprykerUrlStorageClient;

/**
 * @method \Spryker\Client\UrlStorage\UrlStorageFactory getFactory()
 */
class UrlStoreStorageClient extends SprykerUrlStorageClient
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param string $url
     * @param string $localeName
     *
     * @return array
     */
    public function matchUrl($url, $localeName)
    {
        return $this
            ->getFactory()
            ->createUrlStorageReader()
            ->matchUrl($url, $localeName);
    }
}
