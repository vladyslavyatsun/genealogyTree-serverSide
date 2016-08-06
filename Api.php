<?php
use Phalcon\Http\Response;

function getTrees ($app) {
    $response = new Response();

    try {
        $query = "SELECT count(*) FROM trees";
        $trees = $app->modelsManager->executeQuery($query);


        if ($trees == false) {
            $response->setJsonContent(
                array(
                    'status' => 'NOT-FOUND'
                )
            );
        } else {
            $data = array();
            foreach ($trees as $tree) {
                $data[] = array(
                    'id' => (string)$tree->_id,
                    'title' => $tree->title,
                    'author' => $tree->author,
                );
            }
            $response->setStatusCode(201, "OK");
            $response->setContentType('application/json', 'UTF-8');
            $response->setJsonContent($data);
        }
    } catch (Exception $e) {
        $response->setStatusCode(409, "Conflict");
        $response->setJsonContent(
            array(
                'status' => 'ERROR',
                'exception' => $e->getMessage()
            )
        );
    }
    return $response->send();
}

function addTree($app)
{
    $response = new Response();
        $tree = $app->request->getJsonRawBody();
    openlog("myLog ------ ", LOG_PID | LOG_PERROR, LOG_LOCAL0);
    syslog(LOG_ERR, var_export($tree,true));
    closelog();
        $phql = "INSERT INTO trees (title, author) VALUES (:title:, :author:)";


        $status = $app->modelsManager->executeQuery($phql, array(
            'title' => $tree->title,
            'author' => $tree->author
        ));

        if ($status->success() == true) {

            // Меняем HTTP статус
            $response->setStatusCode(201, "Created");

            $tree->id = $status->getModel()->id;

            $response->setJsonContent(
                array(
                    'id' => $tree->id,
                    'title' => $tree->title,
                    'author' => $tree->author
                )
            );

        } else {
            $response->setStatusCode(409, "Conflict");
            $errors = array();
            foreach ($status->getMessages() as $message) {
                $errors[] = $message->getMessage();
            }

            $response->setJsonContent(
                array(
                    'status' => 'ERROR',
                    'messages' => $errors
                )
            );
        }
    return $response->send();
}

function updateTree($app, $id)
{
    $tree = $app->request->getJsonRawBody();
    openlog("myLog ------ ", LOG_PID | LOG_PERROR, LOG_LOCAL0);
    syslog(LOG_ERR, var_export($tree,true)."    ".$id);
    closelog();
    $phql = "UPDATE trees SET title = :title:, author = :author: WHERE id = :id:";

    $status = $app->modelsManager->executeQuery($phql, array(
        'id' => $id,
        'title' => $tree->title,
        'author' => $tree->author
    ));
    $response = new Response();

    if ($status->success() == true) {
        $response->setJsonContent(
            array(
                'id' => $id,
                'title' => $tree->title,
                'author' => $tree->author
            )
        );
    } else {

        $response->setStatusCode(409, "Conflict");

        $errors = array();
        foreach ($status->getMessages() as $message) {
            $errors[] = $message->getMessage();
        }

        $response->setJsonContent(
            array(
                'status'   => 'ERROR',
                'messages' => $errors
            )
        );
    }
    return $response;
}

function deleteTree($app, $id)
{

    $phql = "DELETE FROM trees WHERE id = :id:";
    $status = $app->modelsManager->executeQuery($phql, array(
        'id' => $id
    ));

    $response = new Response();

    if ($status->success() == true) {
        $response->setJsonContent(
            array(
                'status' => 'OK'
            )
        );
    } else {

        $response->setStatusCode(409, "Conflict");

        $errors = array();
        foreach ($status->getMessages() as $message) {
            $errors[] = $message->getMessage();
        }

        $response->setJsonContent(
            array(
                'status'   => 'ERROR',
                'messages' => $errors
            )
        );
    }
    return $response;
}

