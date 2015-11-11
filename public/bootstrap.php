<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$paths = ['entities'];
$isDevMode = true;

$dbParams = [
    'driver' => 'pdo_mysql',
    'user' => 'vagrant',
    'password' => null,
    'dbname' => 'orm_talk',
    'host' => 'localhost',
    'port' => '3307'
];

$config = Setup::createAnnotationMetadataConfiguration([__DIR__."/config/yaml"], $isDevMode);
$EntityManager = EntityManager::create($dbParams, $config);

$capsule = new Capsule;

$capsule->addConnection($dbParams);

$capsule->setEventDispatcher(new Dispatcher(new Container));

$capsule->setAsGlobal();

$capsule->bootEloquent();
