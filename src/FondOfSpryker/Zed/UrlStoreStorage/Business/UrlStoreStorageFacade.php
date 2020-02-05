<?php

namespace FondOfSpryker\Zed\UrlStoreStorage\Business;

use Spryker\Zed\UrlStorage\Business\UrlStorageFacade as SprykerUrlStorageFacade;

/**
 * @method \FondOfSpryker\Zed\UrlStoreStorage\Business\UrlStoreStorageBusinessFactory getFactory()
 */
class UrlStoreStorageFacade extends SprykerUrlStorageFacade implements UrlStoreStorageFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $urlIds
     *
     * @return void
     */
    public function publishUrl(array $urlIds)
    {
        $this->getFactory()->createUrlStorageWriter()->publish($urlIds);
    }
}
