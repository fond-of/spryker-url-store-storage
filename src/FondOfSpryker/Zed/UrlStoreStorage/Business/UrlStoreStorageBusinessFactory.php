<?php

namespace FondOfSpryker\Zed\UrlStoreStorage\Business;

use Spryker\Shared\Log\LoggerTrait;
use FondOfSpryker\Zed\UrlStoreStorage\Business\Storage\UrlStorageWriter;
use Spryker\Zed\UrlStorage\Business\UrlStorageBusinessFactory as SprykerUrlStorageBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\UrlStoreStorage\UrlStorageConfig getConfig()
 * @method \Spryker\Zed\UrlStorage\Persistence\UrlStorageQueryContainerInterface getQueryContainer()
 */
class UrlStoreStorageBusinessFactory extends SprykerUrlStorageBusinessFactory
{
    /**
     * @return \Spryker\Zed\UrlStorage\Business\Storage\UrlStorageWriterInterface
     */
    public function createUrlStorageWriter()
    {
        return new UrlStorageWriter(
            $this->getUtilSanitizeService(),
            $this->getQueryContainer(),
            $this->getConfig()->isSendingToQueue()
        );
    }
}
