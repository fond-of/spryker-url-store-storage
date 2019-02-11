<?php

namespace FondOfSpryker\Zed\UrlStoreStorage\Communication\Plugin\Event\Listener;

use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\PropelOrm\Business\Transaction\DatabaseTransactionHandlerTrait;
use Spryker\Zed\Url\Dependency\UrlEvents;
use Spryker\Zed\UrlStorage\Communication\Plugin\Event\Listener\UrlStorageListener as SprykerUrlStorageListener;

/**
 * @method \Spryker\Zed\UrlStorage\Communication\UrlStorageCommunicationFactory getFactory()
 * @method \FondOfSpryker\Zed\UrlStoreStorage\Business\UrlStoreStorageFacadeInterface getFacade()
 */
class UrlStoreStorageListener extends SprykerUrlStorageListener
{
    use DatabaseTransactionHandlerTrait;

    use LoggerTrait;

    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\EventEntityTransfer[] $eventTransfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventTransfers, $eventName)
    {
        $this->preventTransaction();
        $urlIds = $this->getFactory()->getEventBehaviorFacade()->getEventTransferIds($eventTransfers);

        if ($eventName === UrlEvents::ENTITY_SPY_URL_DELETE ||
            $eventName === UrlEvents::URL_UNPUBLISH
        ) {
            $this->getFacade()->unpublishUrl($urlIds);

            return;
        }

        $this->getFacade()->publishUrl($urlIds);
    }
}
