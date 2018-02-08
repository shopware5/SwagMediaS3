<?php
/*
 * (c) shopware AG <info@shopware.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace SwagMediaS3;

require __DIR__. '/vendor/autoload.php';

use Shopware\Components\Plugin;
use League\Flysystem\AdapterInterface;
use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class SwagMediaS3 extends Plugin
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            'Shopware_Collect_MediaAdapter_s3' => 'createS3Adapter'
        ];
    }

    /**
     * Creates adapter instance
     *
     * @param \Enlight_Event_EventArgs $args
     * @return AdapterInterface
     */
    public function createS3Adapter(\Enlight_Event_EventArgs $args)
    {
        $defaultConfig = [
            'key' => '',
            'secret' => '',
            'region' => '',
            'version' => 'latest',
            'bucket' => '',
            'prefix' => '',
            'endpoint' => null,
            'metaOptions' => []
        ];

        $config = array_merge($defaultConfig, $args->get('config'));

        $clientConfig = [
            'region' => $config['region'],
            'endpoint' => $config['endpoint'],
            'version' => $config['version'],
        ];

        if (!empty($config['key'])) {
            $clientConfig['credentials'] = [
                'key' => $config['key'],
                'secret' => $config['secret'],
            ];
        }

        $client = new S3Client($clientConfig);

        return new AwsS3Adapter($client, $config['bucket'], $config['prefix'], $config['metaOptions']);
    }
}
