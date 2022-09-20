<?php
use tomkyle\Uploader;
use Symfony\Component\Console\Output\OutputInterface;

return array(

    Uploader\Uploader::class => function($dic) : Uploader\Uploader
    {
        $filesystem = $dic->get(\League\Flysystem\Filesystem::class);
        $uploader = new Uploader\FlysystemUploader($filesystem);

        $prefix = dotenv('DOWNLOAD_PREFIX');
        return new Uploader\DownloadableUploader($uploader, $prefix);
    },

    Uploader\VariadicUploader::class => function($dic) : Uploader\VariadicUploader
    {
        $uploader = $dic->get(Uploader\Uploader::class);
        return new Uploader\VariadicUploader($uploader);
    },


    Silly\Application::class => function($dic) : Silly\Application
    {
        $app = new Silly\Application();
        $uploader = $dic->get(Uploader\VariadicUploader::class);

        $app->command('typora source1 [source2]', function ($source1, $source2) use ($uploader) {
            $sources = array_filter([$source1, $source2]);

            $results = $uploader( ...$sources );

            echo implode(PHP_EOL, $results), PHP_EOL;
        });

        return $app;
    }
);

