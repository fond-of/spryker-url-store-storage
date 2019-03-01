<?php

namespace FondOfSpryker\Zed\UrlStoreStorage\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\UrlStoreStorage\Business\Storage\UrlStorageWriter;
use org\bovigo\vfs\vfsStream;

class UrlStoreStorageFacadeTest extends Unit
{

    /**
     * @var \org\bovigo\vfs\vfsStreamDirectory
     */
    protected $vfsStreamDirectory;

    /**
     * @return void
     */
    public function _before()
    {
        $this->vfsStreamDirectory = vfsStream::setup('root', null, [
            'config' => [
                'Shared' => [
                    'stores.php' => file_get_contents(codecept_data_dir('stores.php')),
                    'config_default.php' => file_get_contents(codecept_data_dir('config_default.php')),
                ],
            ],
        ]);
    }

    public function testPublishUrl()
    {
        $urlStoreStorageFacade = new UrlStoreStorageFacade();

        //$urlStoreStorageFacade->publishUrl([]);

    }
}