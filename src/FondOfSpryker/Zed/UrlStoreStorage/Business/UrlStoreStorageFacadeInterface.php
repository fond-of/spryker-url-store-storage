<?php

namespace FondOfSpryker\Zed\UrlStoreStorage\Business;

use Spryker\Zed\UrlStorage\Business\UrlStorageFacadeInterface as SprykerUrlStorageFacadeInterface;

interface UrlStoreStorageFacadeInterface extends SprykerUrlStorageFacadeInterface
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
    public function publishUrl(array $urlIds);
}
