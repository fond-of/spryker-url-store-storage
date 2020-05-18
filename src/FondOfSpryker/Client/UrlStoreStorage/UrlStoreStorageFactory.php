<?php

namespace FondOfSpryker\Client\UrlStoreStorage;

use FondOfSpryker\Client\UrlStoreStorage\Storage\UrlStorageReader;
use Spryker\Client\UrlStorage\UrlStorageFactory as SprykerUrlStorageFactory;

class UrlStoreStorageFactory extends SprykerUrlStorageFactory
{
    /**
     * @return \Spryker\Client\UrlStorage\Storage\UrlStorageReaderInterface
     */
    public function createUrlStorageReader()
    {
        return new UrlStorageReader(
            $this->getStorageClient(),
            $this->getSynchronizationService(),
            $this->getUtilEncodingService(),
            $this->getUrlStorageResourceMapperPlugins()
        );
    }
}
