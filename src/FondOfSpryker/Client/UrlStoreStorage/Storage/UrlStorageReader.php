<?php

namespace FondOfSpryker\Client\UrlStoreStorage\Storage;

use Generated\Shared\Transfer\SynchronizationDataTransfer;
use Generated\Shared\Transfer\UrlStorageTransfer;
use Spryker\Client\UrlStorage\Dependency\Client\UrlStorageToStorageInterface;
use Spryker\Shared\Kernel\Store;
use Spryker\Client\UrlStorage\Storage\UrlStorageReader as SprykerUrlStorageReader;

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
