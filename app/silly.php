<?php
use tomkyle\Uploader;
use Symfony\Component\Console\Output\OutputInterface;

return array(


    Uploader\VariadicUploadCommand::class => function($dic) : Uploader\VariadicUploadCommand
    {
        $configs = $dic->get('Configs.Container');
        return new Uploader\VariadicUploadCommand($configs);
    },

    Silly\Application::class => function($dic) : Silly\Application
    {
        $app = new Silly\Edition\PhpDi\Application("app", "v0", $dic);

        $configs = $dic->get('Configs.Array');

        foreach($configs as $name => $config)
        {
            $pattern = sprintf('%s [--name=] sources*', $name);
            $app->command($pattern, Uploader\VariadicUploadCommand::class)->defaults(['name' => $name]);
        }

        return $app;
    }
);

