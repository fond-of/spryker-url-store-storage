<?php

namespace FondOfSpryker\Zed\UrlStoreStorage\Business\Storage;

use ArrayObject;
use Generated\Shared\Transfer\UrlStorageTransfer;
use Orm\Zed\Store\Persistence\SpyStoreQuery;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Orm\Zed\UrlStorage\Persistence\SpyUrlStorage;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Url\Persistence\Propel\AbstractSpyUrl;
use Spryker\Zed\UrlStorage\Business\Exception\MissingResourceException;
use Spryker\Zed\UrlStorage\Dependency\Service\UrlStorageToUtilSanitizeServiceInterface;
use Spryker\Zed\UrlStorage\Persistence\UrlStorageQueryContainerInterface;

use Spryker\Zed\UrlStorage\Business\Storage\UrlStorageWriter as SprykerUrlStorageWriter;

class UrlStorageWriter extends SprykerUrlStorageWriter
{
    use LoggerTrait;

    /**
     * @param \Generated\Shared\Transfer\UrlStorageTransfer $urlStorageTransfer
     * @param \Orm\Zed\UrlStorage\Persistence\SpyUrlStorage|null $urlStorageEntity
     *
     * @return void
     */
    protected function storeDataSet(UrlStorageTransfer $urlStorageTransfer, ?SpyUrlStorage $urlStorageEntity = null)
    {
        if ($urlStorageEntity === null) {
            $urlStorageEntity = new SpyUrlStorage();
        }

        $resource = $this->findResourceArguments($urlStorageTransfer->toArray());

        $urlStorageEntity->setByName('fk_' . $resource[static::RESOURCE_TYPE], $resource[static::RESOURCE_VALUE]);
        $urlStorageEntity->setUrl($urlStorageTransfer->getUrl());
        $urlStorageEntity->setFkUrl($urlStorageTransfer->getIdUrl());
        $urlStorageEntity->setData($urlStorageTransfer->modifiedToArray());
        $urlStorageEntity->setIsSendingToQueue($this->isSendingToQueue);
        $urlStorageEntity->setStore($this->getStoreName($urlStorageTransfer));
        $urlStorageEntity->save();
    }

    /**
     * @param \Generated\Shared\Transfer\UrlStorageTransfer $urlStorageTransfer
     *
     * @return string
     */
    protected function getStoreName(UrlStorageTransfer $urlStorageTransfer): string
    {
        $urlEntity = SpyUrlQuery::create()
            ->filterByIdUrl($urlStorageTransfer->getIdUrl())
            ->findOne();

        if ($urlEntity == null) {
            return '';
        }

        $storeEntity = SpyStoreQuery::create()
            ->filterByIdStore($urlEntity->getFkStore())
            ->findOne();

        return $storeEntity->getName();
    }
}
