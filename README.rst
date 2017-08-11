Amazon S3 Adapter for Shopware
==============================

.. image:: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
   :target: LICENSE.md

The Amazon S3 adapter allows you to manage your media files in shopware on an Amazon S3 account. In addition, you can use Amazon CloudFront for delivering    your files.

Building a package
------------------

Just run ``./build.sh``.

Install
-------

Download the plugin from the release page and enable it in shopware.

Usage
-----

Update your ``config.php`` in your root directory and fill in your own values::

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

Using IAM roles in EC2
----------------------

To make use of your configured IAM roles, omit the array keys `key` and `secret` or leave them empty. The plugin will retrieve the credentials from the EC2 metadata service automatically.


Value explanation
-----------------

type (required)
    Adapter type. Do not change.

mediaUrl (required)
    URL to access your media files. Usually your S3, CloudFront or custom domain endpoint

    e.g.: ``https://your-bucket-name.s3-website.eu-central-1.amazonaws.com/``

region (required)
    The S3 region, e.g. ``eu-central-1``

bucket (required)
    Your S3 bucket name

key
    Your Access Key ID

secret
    Your Secret Access Key

prefix
    An optional path prefix for your media files

endpoint
    Sets the S3 endpoint specifically (e.g. non-AWS S3)

metaOptions
    Allows setting options per file specific to `Flysystem S3 Adapter <https://github.com/thephpleague/flysystem-aws-s3-v3/blob/4dea5e457d046b43434824e68e64f45a8dc7eeda/src/AwsS3Adapter.php#L31>`_

License
-------

The MIT License (MIT). Please see `License File <LICENSE.md>`_ for more information.
