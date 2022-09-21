<?php
use tomkyle\Uploader;

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

        foreach($configs as $use => $config)
        {
            $description = $config['description'] ?? sprintf("Use '%s' configuration", $use);
            $pattern = sprintf('%s [--use=] sources*', $use);
            $app->command($pattern, Uploader\VariadicUploadCommand::class)
                ->defaults(['use' => $use])
                ->descriptions($description, [
                    '--use'   => sprintf("Name of upload configuration, defaults to '%s'", $use)
                ]);
        }

        return $app;
    }
);

