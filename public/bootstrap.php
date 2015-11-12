<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$isDevMode = true;

$dbParams = [
    'driver' => 'pdo_mysql',
    'user' => 'vagrant',
    'password' => null,
    'dbname' => 'orm_talk',
    'host' => 'localhost',
    'port' => '3307'
];

$config = Setup::createAnnotationMetadataConfiguration([__DIR__."/../application/model/doctrine"], $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);

$capsule = new Capsule;

$dbParams['username'] = 'vagrant';
$dbParams['driver'] = 'mysql';
$dbParams['database'] = 'orm_talk';
$dbParams['collation'] = 'utf8_unicode_ci';
$dbParams['charset'] = 'utf8';

$capsule->addConnection($dbParams);

$capsule->setEventDispatcher(new Dispatcher(new Container));

$capsule->setAsGlobal();

$capsule->bootEloquent();
