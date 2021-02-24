<?php

namespace PierreMiniggio\TikTokDownloader;

class Downloader
{

    protected string $bashScriptPath;

    public function __construct()
    {
        $this->bashScriptPath =
            __DIR__
            . DIRECTORY_SEPARATOR
            . '..'
            . DIRECTORY_SEPARATOR
            . 'vendor'
            . DIRECTORY_SEPARATOR
            . 'pierreminiggio'
            . DIRECTORY_SEPARATOR
            . 'shell-tiktok-downloader'
            . DIRECTORY_SEPARATOR
            . 'tikwm.sh'
        ;
    }

    /**
     * @throws DownloadFailedException
     */
    public function downloadWithoutWatermark(string $videoUrl, string $destinationFile): void
    {
        ob_start();
        $res = shell_exec(
            'bash '
                . $this->bashScriptPath
                . ' '
                . escapeshellarg($videoUrl)
                . ' '
                . escapeshellarg($destinationFile)
                . ' 2>&1'
        );
        $res2 = ob_get_clean();

        if (str_contains($res, '100,0%')) {
            return;
        }

        throw new DownloadFailedException($res | $res2);
    }
}
