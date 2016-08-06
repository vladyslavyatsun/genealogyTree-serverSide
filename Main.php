<?php

use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;
require_once('Api.php');


try {
$loader = new Loader();

$loader->registerDirs(
    array(
        __DIR__ . '/models/'
    )
)->register();

$di = new FactoryDefault();

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
    $app->get('/api/trees', function () use ($app) {
        getTrees($app);
    });

    $app->post('/api/trees', function () use ($app) {
        addTree($app);
    });

    $app->put('/api/trees/{id:[0-9]+}', function ($id) use ($app) {
        updateTree($app, $id);
    });

    $app->delete('/api/trees/{id:[0-9]+}', function ($id) use ($app) {
        deleteTree($app, $id);
    });

    $app->notFound(function () use ($app) {
        $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    });



    $app->get('/api/persons/{id:[0-9]+}', function ($id) use ($app) {
        getPersons($app, $id);
    });

    $app->post('/api/trees', function () use ($app) {
        addTree($app);
    });

    $app->put('/api/trees/{id:[0-9]+}', function ($id) use ($app) {
        updateTree($app, $id);
    });


} catch (Exception $e) {
    openlog("myLog ------ ", LOG_PID | LOG_PERROR, LOG_LOCAL0);
    syslog(LOG_ERR, "".$e);
    closelog();

}
$app->handle();




