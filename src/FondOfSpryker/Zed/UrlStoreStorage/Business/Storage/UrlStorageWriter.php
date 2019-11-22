<?php

namespace FondOfSpryker\Zed\UrlStoreStorage\Business\Storage;

use ArrayObject;
use Generated\Shared\Transfer\UrlStorageTransfer;
use Orm\Zed\Store\Persistence\SpyStoreQuery;
use Orm\Zed\Url\Persistence\SpyUrlQuery;
use Orm\Zed\UrlStorage\Persistence\SpyUrlStorage;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Store\Business\StoreFacadeInterface;
use Spryker\Zed\Url\Persistence\Propel\AbstractSpyUrl;
use Spryker\Zed\UrlStorage\Business\Exception\MissingResourceException;
use Spryker\Zed\UrlStorage\Dependency\Service\UrlStorageToUtilSanitizeServiceInterface;
use Spryker\Zed\UrlStorage\Persistence\UrlStorageQueryContainerInterface;

use Spryker\Zed\UrlStorage\Business\Storage\UrlStorageWriter as SprykerUrlStorageWriter;

class UrlStorageWriter extends SprykerUrlStorageWriter
{

    /**
     * @var \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * UrlStorageWriter constructor.
     *
     * @param \Spryker\Zed\UrlStorage\Dependency\Service\UrlStorageToUtilSanitizeServiceInterface $utilSanitize
     * @param \Spryker\Zed\UrlStorage\Persistence\UrlStorageQueryContainerInterface $queryContainer
     * @param $isSendingToQueue
     * @param \Spryker\Zed\Store\Business\StoreFacadeInterface $storeFacade
     */
    public function __construct(
        UrlStorageToUtilSanitizeServiceInterface $utilSanitize,
        UrlStorageQueryContainerInterface $queryContainer,
        $isSendingToQueue,
        StoreFacadeInterface $storeFacade
    ) {
        parent::__construct($utilSanitize, $queryContainer, $isSendingToQueue);
        $this->storeFacade = $storeFacade;
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

        $resource = $this->findResourceArguments($urlStorageTransfer->toArray());

        $urlStorageEntity->setByName('fk_' . $resource[static::RESOURCE_TYPE], $resource[static::RESOURCE_VALUE]);
        $urlStorageEntity->setUrl($urlStorageTransfer->getUrl());
        $urlStorageEntity->setFkUrl($urlStorageTransfer->getIdUrl());
        $urlStorageEntity->setData($urlStorageTransfer->modifiedToArray());
        $urlStorageEntity->setIsSendingToQueue($this->isSendingToQueue);
        $urlStorageEntity->save();
    }
}
