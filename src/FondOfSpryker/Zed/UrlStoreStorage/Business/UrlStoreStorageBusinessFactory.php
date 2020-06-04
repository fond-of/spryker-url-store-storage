<?php

namespace FondOfSpryker\Zed\UrlStoreStorage\Business;

use FondOfSpryker\Zed\UrlStoreStorage\Business\Storage\UrlStorageWriter;
use Spryker\Zed\UrlStorage\Business\UrlStorageBusinessFactory as SprykerUrlStorageBusinessFactory;
use Spryker\Zed\UrlStorage\Dependency\Facade\UrlStorageToStoreFacadeInterface;
use Spryker\Zed\UrlStorage\UrlStorageDependencyProvider;

/**
 * @method \FondOfSpryker\Zed\UrlStoreStorage\UrlStoreStorageConfig getConfig()
 * @method \FondOfSpryker\Zed\UrlStoreStorage\Persistence\UrlStoreStorageQueryContainerInterface getQueryContainer()
 * @method \FondOfSpryker\Zed\UrlStoreStorage\Persistence\UrlStoreStorageRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\UrlStoreStorage\Persistence\UrlStoreStorageEntityManagerInterface getEntityManager()()
 */
class UrlStoreStorageBusinessFactory extends SprykerUrlStorageBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\UrlStoreStorage\Business\Storage\UrlStorageWriter|\Spryker\Zed\UrlStorage\Business\Storage\UrlStorageWriterInterface
     */
    public function createUrlStorageWriter()
    {
        return new UrlStorageWriter(
            $this->getUtilSanitizeService(),
            $this->getRepository(),
            $this->getEntityManager(),
            $this->getStoreFacade(),
            $this->getConfig()->isSendingToQueue()
        );
    }
}
