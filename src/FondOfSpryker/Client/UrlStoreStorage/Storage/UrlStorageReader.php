<?php

namespace FondOfSpryker\Client\UrlStoreStorage\Storage;

use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Spryker\Client\UrlStorage\Storage\UrlStorageReader as SprykerUrlStorageReader;
use Spryker\Shared\Kernel\Store;

class UrlStorageReader extends SprykerUrlStorageReader implements UrlStorageReaderInterface
{
    /**
     * @param string $url
     *
     * @return string
     */
    protected function getUrlKey($url)
    {
        $storeName = Store::getInstance()->getStoreName();
        $synchronizationDataTransfer = new SynchronizationDataTransfer();
        $synchronizationDataTransfer->setReference(rawurldecode($url));
        $synchronizationDataTransfer->setStore($storeName);

        return $this->synchronizationService->getStorageKeyBuilder(static::URL)->generateKey($synchronizationDataTransfer);
    }
}
