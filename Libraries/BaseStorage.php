<?php
/**
 * @author basic-app <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\Storage\Libraries;

use Webmozart\Assert\Assert;

abstract class BaseStorage extends \League\Flysystem\Filesystem
{

    public $configName;

    public function writeFile(string $name, string $filename, array $options = [])
    {
        Assert::true(is_file($filename), 'File not found: ' . $filename);

        $content = file_get_contents($filename);

        return $this->write($name, $content, $options);
    }

    public function basePath(string $path = null) : string
    {
        $config = config($this->configName);

        Assert::notEmpty($config, 'Config not found: ' . $this->configName);

        $return = FCPATH . $config->basePath;
    
        if ($path)
        {
            $return .= '/' . $path;

        }

        return $return;
    }

    public function baseUrl(?string $url) : string
    {
        $config = config($this->configName);

        Assert::notEmpty($config, 'Config not found: ' . $this->configName);

        $return = $config->basePath;

        if ($url)
        {
            $return .= '/' . $url;
        }

        base_url($return);
    }

}