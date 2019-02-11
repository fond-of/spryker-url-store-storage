<?php

namespace FondOfSpryker\Zed\UrlStoreStorage\Communication\Plugin\Event\Subscriber;

use FondOfSpryker\Zed\UrlStoreStorage\Communication\Plugin\Event\Listener\UrlStoreStorageListener;
use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Url\Dependency\UrlEvents;
use Spryker\Zed\UrlStorage\Communication\Plugin\Event\Subscriber\UrlStorageEventSubscriber as SprykerUrlStorageEventSubscriber;


class UrlStoreStorageEventSubscriber extends SprykerUrlStorageEventSubscriber
{
    /**
     * @api
     *
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection)
    {
        $this->addUrlPublishStorageListener($eventCollection);
        $this->addUrlUnpublishStorageListener($eventCollection);
        $this->addUrlCreateStorageListener($eventCollection);
        $this->addUrlUpdateStorageListener($eventCollection);
        $this->addUrlDeleteStorageListener($eventCollection);
        $this->addRedirectCreateStorageListener($eventCollection);
        $this->addRedirectUpdateStorageListener($eventCollection);
        $this->addRedirectDeleteStorageListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addUrlPublishStorageListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(UrlEvents::URL_PUBLISH, new UrlStoreStorageListener());
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addUrlUnpublishStorageListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(UrlEvents::URL_UNPUBLISH, new UrlStoreStorageListener());
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addUrlCreateStorageListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(UrlEvents::ENTITY_SPY_URL_CREATE, new UrlStoreStorageListener());
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addUrlUpdateStorageListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(UrlEvents::ENTITY_SPY_URL_UPDATE, new UrlStoreStorageListener());
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addUrlDeleteStorageListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(UrlEvents::ENTITY_SPY_URL_DELETE, new UrlStoreStorageListener());
    }
}
