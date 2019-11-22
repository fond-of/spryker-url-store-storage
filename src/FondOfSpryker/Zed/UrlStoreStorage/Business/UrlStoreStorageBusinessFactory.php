<?php

namespace FondOfSpryker\Zed\UrlStoreStorage\Business;

use FondOfSpryker\Zed\CategoryExtendStorage\CategoryExtendStorageDependencyProvider;
use FondOfSpryker\Zed\UrlStoreStorage\UrlStoreStorageDependencyProvider;
use Spryker\Shared\Log\LoggerTrait;
use FondOfSpryker\Zed\UrlStoreStorage\Business\Storage\UrlStorageWriter;
use Spryker\Zed\Store\Business\StoreFacadeInterface;
use Spryker\Zed\UrlStorage\Business\UrlStorageBusinessFactory as SprykerUrlStorageBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\UrlStoreStorage\UrlStorageConfig getConfig()
 * @method \Spryker\Zed\UrlStorage\Persistence\UrlStorageQueryContainerInterface getQueryContainer()
 */
class UrlStoreStorageBusinessFactory extends SprykerUrlStorageBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\UrlStoreStorage\Business\Storage\UrlStorageWriter|\Spryker\Zed\UrlStorage\Business\Storage\UrlStorageWriterInterface
     */
    public function createUrlStorageWriter(): UrlStorageWriter
    {
        return new UrlStorageWriter(
            $this->getUtilSanitizeService(),
            $this->getQueryContainer(),
            $this->getConfig()->isSendingToQueue(),
            $this->getStoreFacade()
        );
    }

    /**
     * @throws
     *
     * @return \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    protected function getStoreFacade(): StoreFacadeInterface
    {
        return $this->getProvidedDependency(UrlStoreStorageDependencyProvider::FACADE_STORE);
    }
}
