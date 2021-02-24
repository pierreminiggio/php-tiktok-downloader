<?php

namespace PierreMiniggio\TikTokDownloaderTest;

use PHPUnit\Framework\TestCase;
use PierreMiniggio\TikTokDownloader\Downloader;
use PierreMiniggio\TikTokDownloader\DownloadFailedException;

class DownloaderTest extends TestCase
{

    public function testSuccessfullDownload(): void
    {
        $downloader = new Downloader();
        $downloader->downloadWithoutWatermark(
            'https://www.tiktok.com/@pierreminiggio/video/6927183021980306693',
            $mp4 = __DIR__ . DIRECTORY_SEPARATOR . 'success.mp4'
        );
        
        self::assertSame(true, file_exists($mp4));
    }

    public function testBadVideo(): void
    {
        $downloader = new Downloader();
        $this->expectException(DownloadFailedException::class);
        $downloader->downloadWithoutWatermark(
            'https://www.tiktok.com/@pierreminiggio/video/69271830219803066932',
            __DIR__ . DIRECTORY_SEPARATOR . 'failed.mp4'
        );
    }
}
