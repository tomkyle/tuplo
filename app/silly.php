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

        $app->command('typora source1 [source2]', function ($source1, $source2, OutputInterface $output) use ($dic) {
            $sources = array_filter([$source1, $source2]);

            $uploader = $dic->get(Uploader\VariadicUploader::class);
            $result = $uploader( ...$sources );
            $result_str = implode(PHP_EOL, $result);

            $output->writeln($result);
        });

        return $app;
    }
);

