<?php

namespace FondOfSpryker\Zed\UrlStoreStorage\Business\Storage;

use Generated\Shared\Transfer\UrlStorageTransfer;
use Orm\Zed\UrlStorage\Persistence\SpyUrlStorage;
use Spryker\Zed\UrlStorage\Business\Storage\UrlStorageWriter as SprykerUrlStorageWriter;

class UrlStorageWriter extends SprykerUrlStorageWriter
{
    /**
     * @param int[] $urlIds
     *
     * @return void
     */
    public function publish(array $urlIds)
    {
        $currentStore = $this->storeFacade->getCurrentStore();
        $localeNames = $currentStore->getAvailableLocaleIsoCodes();
        $urlEntityTransfers = $this->urlStorageRepository->findLocalizedUrlsByUrlIdsAndStore($urlIds, $localeNames, $currentStore);
        $urlStorageTransfers = $this->mapUrlsEntitiesToUrlStorageTransfers($urlEntityTransfers);
        $urlStorageEntities = $this->urlStorageRepository->findUrlStorageByUrlIdsAndStore(array_keys($urlStorageTransfers), $currentStore);

        $this->storeData($urlStorageTransfers, $urlStorageEntities);
    }

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
