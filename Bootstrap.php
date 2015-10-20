<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

require(__DIR__ . "/vendor/autoload.php");

use League\Flysystem\AdapterInterface;
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class Shopware_Plugins_Frontend_SwagMediaS3_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{
    /**
     * Returns the version of the plugin
     *
     * @return string
     */
    public function getVersion()
    {
        return "1.0.0";
    }

    /**
     * Returns a marketing friendly name of the plugin.
     *
     * @return string
     */
    public function getLabel()
    {
        return "Media Adapter: S3";
    }

    /**
     * Returns plugin info
     *
     * @return array
     */
    public function getInfo()
    {
        return [
            'version'     => $this->getVersion(),
            'label'       => $this->getLabel(),
            'supplier'    => 'shopware AG',
            'description' => 'Amazon S3-Erweiterung für die Media Adapter',
            'support'     => 'Shopware Forum',
            'link'        => 'http://www.shopware.com',
        ];
    }

    /**
     * Template method which will be called when the plugin will be uninstalled.
     *
     * @return bool
     */
    public function uninstall()
    {
        return true;
    }

    /**
     * Template method which will be called when the plugin will be installed.
     *
     * @return bool
     */
    public function install()
    {
        $this->subscribeEvent('Shopware_Collect_MediaAdapter_s3', 'createS3Adapter');

        return true;
    }

    /**
     * Creates adapter instance
     *
     * @param Enlight_Event_EventArgs $args
     * @return AdapterInterface
     */
    public function createS3Adapter(Enlight_Event_EventArgs $args)
    {
        $defaultConfig = [
            'key' => '',
            'secret' => '',
            'region' => '',
            'version' => 'latest',
            'bucket' => '',
            'prefix' => ''
        ];

        $config = array_merge($defaultConfig, $args->get('config'));

        $client = S3Client::factory([
            'credentials' => [
                'key'    => $config['key'],
                'secret' => $config['secret'],
            ],
            'region' => $config['region'],
            'version' => $config['version']
        ]);

        return new AwsS3Adapter($client, $config['bucket'], $config['prefix']);
    }
}
