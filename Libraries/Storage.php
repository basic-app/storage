<?php
/**
 * @author basic-app <dev@basic-app.com>
 * @license MIT
 * @link https://basic-app.com
 */
namespace BasicApp\Storage\Libraries;

use BasicApp\Storage\Config\Storage as StorageConfig;

class Storage extends BaseStorage
{

    public $configName = StorageConfig::class;

}