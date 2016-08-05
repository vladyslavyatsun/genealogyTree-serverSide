<?php

use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;
require_once('Api.php');

// Используем Loader() для автозагрузки нашей модели
$loader = new Loader();

$loader->registerDirs(
    array(
        __DIR__ . '/models/'
    )
)->register();

$di = new FactoryDefault();

// Настраиваем сервис базы данных
$di->set('db', function () {
    return new PdoMysql(
        array(
            "host"     => "localhost",
            "username" => "root",
            "password" => "",
            "dbname"   => "lab1DB"
        )
    );
});


// Создаем и привязываем DI к приложению
$app = new Micro($di);

// Получение всех роботов
$app->get('/api', function () use ($app) {
    getTrees($app);
});


$app->handle();




