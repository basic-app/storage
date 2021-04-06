<?php
/**
 * @author basic-app <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\Storage\Config;

use Webmozart\Assert\Assert;

class Services extends \CodeIgniter\Config\BaseService
{

    public static function storage($getShared = true)
    {
        if ($getShared)
        {
            return static::getSharedInstance(__FUNCTION__);
        }

        $config = config(Storage::class);

        Assert::notEmpty($config, 'Config not found: ' . Storage::class);

        $path = FCPATH . $config->basePath;

        $adapter = new \League\Flysystem\Local\LocalFilesystemAdapter($path);
    
        return new \BasicApp\Storage\Libraries\Storage($adapter);
    }

}