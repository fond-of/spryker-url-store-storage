<?php

namespace FondOfSpryker\Zed\UrlStoreStorage\Business\Storage;

use Generated\Shared\Transfer\UrlStorageTransfer;
use Orm\Zed\UrlStorage\Persistence\SpyUrlStorage;
use Spryker\Zed\Store\Business\StoreFacadeInterface;
use Spryker\Zed\UrlStorage\Business\Storage\UrlStorageWriter as SprykerUrlStorageWriter;
use Spryker\Zed\UrlStorage\Dependency\Service\UrlStorageToUtilSanitizeServiceInterface;
use Spryker\Zed\UrlStorage\Persistence\UrlStorageQueryContainerInterface;

class UrlStorageWriter extends SprykerUrlStorageWriter
{
    /**
     * @var \Spryker\Zed\Store\Business\StoreFacadeInterface
     */
    protected $storeFacade;

    /**
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

        parent::storeDataSet($urlStorageTransfer, $urlStorageEntity);
    }
}
