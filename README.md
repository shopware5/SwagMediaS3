# Amazon S3 Adapter for Shopware

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

The Amazon S3 adapter allows you to manage your media files in shopware on an Amazon S3 account. In addition, you can use Amazon CloudFront for delivering your files.

## Install

Download the plugin from the release page and enable it in shopware.

## Usage

Update your `config.php` in your root directory and fill in your own values

```php
'cdn' => [
    'backend' => 's3',
    'adapters' => [
        's3' => [
            'type' => 's3',
            'mediaUrl' => 'YOUR_S3_OR_CLOUDFRONT_ENDPOINT',
            'key' => 'YOUR_AWS_KEY',
            'secret' => 'YOUR_AWS_SECRET',
            'region' => 'YOUR_S3_REGION',
            'bucket' => 'YOUR_S3_BUCKET_NAME',
            'prefix' => ''
        ]
    ]
]
```

## Value explanation


| Name | Required | Description |
|------|----------|-------------|
| type | Yes | Adapter type. Do not change. |
| mediaUrl | Yes | Either S3, CloudFront or custom domain endpoint |
| key | Yes | Your Access Key ID |
| secret | Yes | Your Secret Access Key |
| region | Yes | The S3 region, e.g. `eu-central-1` |
| bucket | Yes | Your S3 bucket name |
| prefix | No | An optional path prefix for your media files |

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
