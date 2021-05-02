<?php

namespace PierreMiniggio\TikTokDownloader;

class Downloader
{

    protected string $bashScriptPath;

    public function __construct()
    {
        $projectPath =
            __DIR__
            . DIRECTORY_SEPARATOR
            . '..'
            . DIRECTORY_SEPARATOR
        ;

        $bashFilename = 'tikwm.sh';
        $bashFilenameInsideProject =
            'shell-tiktok-downloader'
            . DIRECTORY_SEPARATOR
            . $bashFilename
        ;

        $potentialsPaths = [
            $projectPath
                . 'vendor'
                . DIRECTORY_SEPARATOR
                . 'pierreminiggio'
                . DIRECTORY_SEPARATOR
                . $bashFilenameInsideProject
            ,
            $projectPath
                . '..'
                . DIRECTORY_SEPARATOR
                . $bashFilenameInsideProject 
        ];

        foreach ($potentialsPaths as $potentialsPath) {
            if (file_exists($potentialsPath)) {
                $this->bashScriptPath = $potentialsPath;
                break;
            }
        }
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
