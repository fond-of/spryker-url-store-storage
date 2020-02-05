<?php

namespace FondOfSpryker\Zed\UrlStoreStorage\Business;

use FondOfSpryker\Zed\UrlStoreStorage\Business\Storage\UrlStorageWriter;
use Spryker\Zed\UrlStorage\Business\UrlStorageBusinessFactory as SprykerUrlStorageBusinessFactory;
use Spryker\Zed\UrlStorage\Dependency\Facade\UrlStorageToStoreFacadeInterface;
use Spryker\Zed\UrlStorage\UrlStorageDependencyProvider;

/**
 * @method \FondOfSpryker\Zed\UrlStoreStorage\UrlStorageConfig getConfig()
 * @method \FondOfSpryker\Zed\UrlStoreStorage\Persistence\UrlStorageQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\UrlStoreStorage\Persistence\UrlStorageRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\UrlStoreStorage\Persistence\UrlStoreStorageEntityManagerInterface getEntityManager()()
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
     * @return \Spryker\Zed\UrlStorage\Dependency\Facade\UrlStorageToStoreFacadeInterface
     */
    public function getStoreFacade(): UrlStorageToStoreFacadeInterface
    {
        return $this->getProvidedDependency(UrlStorageDependencyProvider::FACADE_STORE);
    }
}
