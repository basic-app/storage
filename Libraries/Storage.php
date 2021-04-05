<?php

namespace BasicApp\Storage\Libraries;

use Webmozart\Assert\Assert;

class Storage extends \League\Flysystem\Filesystem
{

    public function writeFile(string $name, string $filename, array $options = [])
    {
        Assert::true(is_file($filename), 'File not found: ' . $filename);

        $content = file_get_contents($filename);

        return $this->write($name, $content);
    }

}