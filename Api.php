<?php
use Phalcon\Http\Response;

function getTrees ($app) {
    $response = new Response();


    openlog("myScriptLog", LOG_PID | LOG_PERROR, LOG_LOCAL0);
    syslog(LOG_ERR, "6785436257832467856783496956783");
    closelog();
    try {
        $query = "SELECT * FROM lab1DB.trees";
        openlog("myScriptLog", LOG_PID | LOG_PERROR, LOG_LOCAL0);
        syslog(LOG_ERR, "6785436257832467856783496956783");
        closelog();

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