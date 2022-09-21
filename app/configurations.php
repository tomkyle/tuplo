<?php

return array(

    'Configs.Array' => function($dic) : array
    {
        $tuplo = '.tuplo.yaml';
        $files = array();

        $cwd = getcwd();
        if ($cwd) {
            $files[] = implode(DIRECTORY_SEPARATOR, [$cwd, $tuplo]);
        }

        if (is_dir($_SERVER['HOME'])) {
            $files[] = implode(DIRECTORY_SEPARATOR, [$_SERVER['HOME'], $tuplo]);
        }

        do {
            $config_file = array_shift($files);
        } while (!is_file($config_file) and !empty($files));

        if (!is_file($config_file)) {
            $msg = sprintf("Could not find configuration file");
            throw new \RuntimeException($msg);
        }

        $config_content = file_get_contents($config_file);
        $config = Symfony\Component\Yaml\Yaml::parse($config_content);

        return $config;
    },

    'Configs.Container' => function($dic) : \Psr\Container\ContainerInterface
    {
        $configs = $dic->get('Configs.Array');
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions($configs);
        return $builder->build();
    },

);
