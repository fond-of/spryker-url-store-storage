<?php

namespace FondOfSpryker\Zed\UrlStoreStorage\Business\Storage;

use Generated\Shared\Transfer\UrlStorageTransfer;
use Orm\Zed\UrlStorage\Persistence\SpyUrlStorage;
use Spryker\Zed\UrlStorage\Business\Storage\UrlStorageWriter as SprykerUrlStorageWriter;
use Spryker\Zed\UrlStorage\Dependency\Facade\UrlStorageToStoreFacadeInterface;
use Spryker\Zed\UrlStorage\Dependency\Service\UrlStorageToUtilSanitizeServiceInterface;
use Spryker\Zed\UrlStorage\Persistence\UrlStorageEntityManagerInterface;
use Spryker\Zed\UrlStorage\Persistence\UrlStorageQueryContainerInterface;
use Spryker\Zed\UrlStorage\Persistence\UrlStorageRepositoryInterface;

class UrlStorageWriter extends SprykerUrlStorageWriter
{
    /**
     * @param \Generated\Shared\Transfer\UrlStorageTransfer $urlStorageTransfer
     * @param \Orm\Zed\UrlStorage\Persistence\SpyUrlStorage|null $urlStorageEntity
     *
     * @return void
     */
    protected function storeDataSet(UrlStorageTransfer $urlStorageTransfer, ?SpyUrlStorage $urlStorageEntity = null): void
    {
        if ($urlStorageEntity === null) {
            $storeName = $this->storeFacade->getCurrentStore()->getName();
            $urlStorageEntity = new SpyUrlStorage();
            $urlStorageEntity->setStore($storeName);
        }

        parent::storeDataSet($urlStorageTransfer, $urlStorageEntity);
    }
}
