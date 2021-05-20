<?php

namespace BasicApp\Storage;

use Webmozart\Assert\Assert;
use BasicApp\Storage\Config\Storage as StorageConfig;

trait StorageTestTrait
{

    public function setUpStorage() : void
    {
        $config = config(StorageConfig::class);

        if ($config)
        {
            $config->basePath = 'test-storage';
        }
    }

    public function tearDownStorage()
    {
        $config = config(StorageConfig::class);

        if ($config)
        {
            helper(['file']);

            $result = delete_files(FCPATH . 'test-storage');

            Assert::true($result);
        }
    }

    public function storageFile(string $source, string $name = null)
    {
        if (!$name)
        {
            $name = basename($source);
        }

        $config = config(StorageConfig::class);

        $this->assertNotEmpty($config);

        $storage = service('storage');

        $this->assertNotEmpty($storage);

        $storage->writeFile($name, $source);

        $filename = $storage->path($name);

        return [
            'name' => basename($filename),
            'type' => mime_content_type($filename),
            'tmp_name' => $filename,
            'error' => 0,
            'size' => filesize($filename)
        ];
    }


}