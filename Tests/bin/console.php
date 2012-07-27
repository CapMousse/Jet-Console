<?php

include_once __DIR__ . '/../../autoload.dist.php';

Use Jet\Console\Console;

$app = new Console('testCommand', 'beta 1');

$dirName = __DIR__."/../Fixtures";
$dir = scandir($dirName);

foreach ($dir as $file) {
    $fileInfos = pathinfo($dirName .'/'. $file);

    if ($fileInfos['extension'] !== "php") {
        continue;
    }

    $namespace = '\\Jet\\Console\\Command';
    $reflection = new \ReflectionClass('Tests\\Fixtures\\'.$fileInfos['filename']);

    if ($reflection->isSubclassOf($namespace.'\\AbstractCommand') && $reflection->isAbstract() === false) {
        $app->addCommand($reflection->newInstance());
    }
}

$app->run();