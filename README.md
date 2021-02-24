# php-tiktok-downloader

```console
composer require pierreminiggio/tiktok-downloader
```

```php
use PierreMiniggio\TikTokDownloader\Downloader;

$downloader = new Downloader();
$downloader->downloadWithoutWatermark(
    'https://www.tiktok.com/@pierreminiggio/video/6927183021980306693',
    __DIR__ . DIRECTORY_SEPARATOR . 'video.mp4'
);
```
