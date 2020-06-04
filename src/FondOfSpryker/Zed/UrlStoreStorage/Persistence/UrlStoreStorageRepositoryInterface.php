<?php

namespace FondOfSpryker\Zed\UrlStoreStorage\Persistence;

use Generated\Shared\Transfer\StoreTransfer;
use Spryker\Zed\UrlStorage\Persistence\UrlStorageRepositoryInterface as SprykerUrlStorageRepositoryInterface;

interface UrlStoreStorageRepositoryInterface extends SprykerUrlStorageRepositoryInterface
{
    /**
     * @param int[] $urlIds
     * @param string[] $localeNames
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrl[][]
     */
    public function findLocalizedUrlsByUrlIdsAndStore(array $urlIds, array $localeNames, StoreTransfer $storeTransfer): array;

    /**
     * @param array $urlIds
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     *
     * @return array
     */
    public function findUrlStorageByUrlIdsAndStore(array $urlIds, StoreTransfer $storeTransfer): array;
}
