<?php

namespace FondOfSpryker\Zed\UrlStoreStorage\Persistence;

use Generated\Shared\Transfer\StoreTransfer;
use Orm\Zed\UrlStorage\Persistence\Map\SpyUrlStorageTableMap;
use Spryker\Zed\UrlStorage\Persistence\UrlStorageRepository as SprykerUrlStorageRepository;

/**
 * @method \FondOfSpryker\Zed\UrlStoreStorage\Persistence\UrlStoreStoragePersistenceFactory getFactory()
 */
class UrlStoreStorageRepository extends SprykerUrlStorageRepository implements UrlStoreStorageRepositoryInterface
{
    /**
     * @param int[] $urlIds
     * @param string[] $localeNames
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrl[][]
     */
    public function findLocalizedUrlsByUrlIdsAndStore(array $urlIds, array $localeNames, StoreTransfer $storeTransfer): array
    {
        $resourceTypeAndIds = $this->getResourceIdsGroupedByResourceTypeForUrlIdsAndStore($urlIds, $storeTransfer);
        $localizedUrlEntities = [];
        foreach ($resourceTypeAndIds as $resourceType => $resourceIds) {
            $resourceTypeEntities = $this->findUrlsByResourceTypeAndIdsAndStore($resourceType, $resourceIds, $localeNames, $storeTransfer);

            foreach ($resourceTypeEntities as $urlEntity) {
                $localizedUrlEntities[$urlEntity->getResourceType() . $urlEntity->getResourceId()][$urlEntity->getIdUrl()] = $urlEntity;
            }
        }

        return $localizedUrlEntities;
    }

    /**
     * @param array $urlIds
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     *
     * @return array
     */
    public function findUrlStorageByUrlIdsAndStore(array $urlIds, StoreTransfer $storeTransfer): array
    {
        return $this->getFactory()
            ->createSpyStorageUrlQuery()
            ->filterByFkUrl_In($urlIds)
            ->filterByStore($storeTransfer->getName())
            ->find()
            ->toKeyIndex(SpyUrlStorageTableMap::getTableMap()->getColumn(SpyUrlStorageTableMap::COL_FK_URL)->getPhpName());
    }

    /**
     * @param int[] $urlIds
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     *
     * @return array
     */
    protected function getResourceIdsGroupedByResourceTypeForUrlIdsAndStore(array $urlIds, StoreTransfer $storeTransfer): array
    {
        $urlEntities = $this->getFactory()
            ->getUrlQuery()
            ->filterByIdUrl_In($urlIds)
            ->filterByFkStore($storeTransfer->getIdStore())
            ->find();

        $resources = [];
        foreach ($urlEntities as $urlEntity) {
            $resources[$urlEntity->getResourceType()][$urlEntity->getResourceId()] = $urlEntity->getResourceId();
        }

        return $resources;
    }

    /**
     * @param string $resourceType
     * @param int[] $resourceIds
     * @param string[] $localeNames
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     *
     * @return \Orm\Zed\Url\Persistence\SpyUrl[]
     */
    protected function findUrlsByResourceTypeAndIdsAndStore(string $resourceType, array $resourceIds, array $localeNames, StoreTransfer $storeTransfer): array
    {
        return $this->getFactory()->getUrlQuery()
            ->filterByResourceTypeAndIds($resourceType, $resourceIds)
            ->filterByFkStore($storeTransfer->getIdStore())
            ->joinWithSpyLocale()
            ->useSpyLocaleQuery()
            ->filterByLocaleName_In($localeNames)
            ->endUse()
            ->find()
            ->getData();
    }
}
