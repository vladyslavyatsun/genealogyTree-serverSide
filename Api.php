<?php
use Phalcon\Http\Response;
function getTrees ($app) {
    $response = new Response();

    try {
        $query = "SELECT Trees.id, Trees.title, Trees.author, count(Persons.id) AS countOfPerson FROM Trees LEFT JOIN Persons ON Trees.id = Persons.tree_id GROUP BY Trees.id";
        $treesWithCountOfPerson = $app->modelsManager->executeQuery($query);

        if ($treesWithCountOfPerson == false) {
            $response->setJsonContent(
                array(
                    'status' => 'NOT-FOUND'
                )
            );
        } else {
            $data = array();
            foreach ($treesWithCountOfPerson as $row) {

                $data[] = array(
                    'id' => (string)$row->id,
                    'title' => $row->title,
                    'author' => $row->author,
                    'countOfPerson'=> $row->countOfPerson
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
    $tree = $app->request->getJsonRawBody();

    $treeInDB = new Trees();
    $response = new Response();

    try {
            $treeInDB->setTitle($tree->title);
            $treeInDB->setAuthor($tree->author);
            $treeInDB->create();

            $response->setJsonContent(
                array(
                    'id' => $treeInDB->getId(),
                    'title' => $treeInDB->getTitle(),
                    'author' => $treeInDB->getAuthor()
                )
            );
            $response->setStatusCode(201, "OK");
            $response->setContentType('application/json', 'UTF-8');
    }
    catch (Exception $e){
        $response->setStatusCode(409, "Conflict");
        $response->setJsonContent(
            array(
                'status'   => 'ERROR',
                'messages' => $e->getMessage()
            )
        );
    }
    return $response->send();
}

function updateTree($app, $id)
{
    $tree = $app->request->getJsonRawBody();

    $treeInDB = Trees::findFirst($id);
    $response = new Response();

    try {
        if ($treeInDB) {
            $treeInDB->setTitle($tree->title);
            $treeInDB->setAuthor($tree->author);
            $treeInDB->save();

            $response->setJsonContent(
                array(
                    'id' => $treeInDB->getId(),
                    'title' => $treeInDB->getTitle(),
                    'author' => $treeInDB->getAuthor()
                )
            );
            $response->setStatusCode(201, "OK");
            $response->setContentType('application/json', 'UTF-8');
        }
        else
        {
            throw new Exception("no element with id = ".$id);
        }

    }
    catch (Exception $e){
        $response->setStatusCode(409, "Conflict");
        $response->setJsonContent(
            array(
                'status'   => 'ERROR',
                'messages' => $e->getMessage()
            )
        );
    }
    return $response->send();
}

function deleteTree($id)
{
    $treeInDB = Trees::findFirst($id);
    $response = new Response();

    try {
        if ($treeInDB) {
            $treeInDB->delete();
            $response->setStatusCode(204, "Deleted");
        }
        else
        {
            throw new Exception("no element with id = ".$id);
        }

    }
    catch (Exception $e){
        $response->setStatusCode(409, "Conflict");
        $response->setJsonContent(
            array(
                'status'   => 'ERROR',
                'messages' => $e->getMessage()
            )
        );
    }
    return $response->send();
}


function getPerson($id){
    $personInDB = Persons::findFirst($id);
    $response = new Response();

    try {
        if ($personInDB) {
            $response->setJsonContent(
                array(
                    'id' => $personInDB->getId(),
                    'firstName' => $personInDB->getFirstName(),
                    'lastName' => $personInDB->getLastName(),
                    'middleName' => $personInDB->getMiddleName(),
                    'gender' => $personInDB->getGender(),
                    'mother_id' => $personInDB->getMotherId(),
                    'father_id' => $personInDB->getFatherId(),
                    'tree_id' => $personInDB->getTreeId()
                )
            );
            $response->setStatusCode(201, "OK");
            $response->setContentType('application/json', 'UTF-8');
        }
        else
        {
            throw new Exception("no element with id = ".$id);
        }

    }
    catch (Exception $e){
        $response->setStatusCode(409, "Conflict");
        $response->setJsonContent(
            array(
                'status'   => 'ERROR',
                'messages' => $e->getMessage()
            )
        );
    }
    return $response->send();
}

function addPerson($app){
    $person = $app->request->getJsonRawBody();

    $response = new Response();
    $personInDB = new Persons();

    try {
            $personInDB->setFirstName($person->firstName);
            $personInDB->setLastName($person->lastName);
            $personInDB->setMiddleName($person->middleName);
            $personInDB->setLastName($person->lastName);
            $personInDB->setGender($person->gender);
            $personInDB->setMotherId($person->mother_id);
            $personInDB->setFatherId($person->father_id);
            $personInDB->setTreeId($person->tree_id);

            $personInDB->create();

            $response->setJsonContent(
                array(
                    'id' => $personInDB->getId(),
                    'firstName' => $personInDB->getFirstName(),
                    'lastName' => $personInDB->getLastName(),
                    'middleName' => $personInDB->getMiddleName(),
                    'gender' => $personInDB ->getGender(),
                    'mother_id' => $personInDB->getMotherId(),
                    'father_id' => $personInDB->getFatherId(),
                    'tree_id' => $personInDB->getTreeId()
                )
            );
            $response->setStatusCode(201, "OK");
            $response->setContentType('application/json', 'UTF-8');

    }
    catch (Exception $e){
        $response->setStatusCode(409, "Conflict");
        $response->setJsonContent(
            array(
                'status'   => 'ERROR',
                'messages' => $e->getMessage()
            )
        );
    }
    return $response->send();
}

function updatePerson($app, $id)
{
    $person = $app->request->getJsonRawBody();

    $personInDB = Persons::findFirst($id);
    $response = new Response();

    try {
        if ($personInDB) {
            $personInDB->setFirstName($person->firstName);
            $personInDB->setLastName($person->lastName);
            $personInDB->setMiddleName($person->middleName);
            $personInDB->setLastName($person->lastName);
            $personInDB->setGender($person->gender);
            $personInDB->setMotherId($person->mother_id);
            $personInDB->setFatherId($person->father_id);

            $personInDB->save();

            $response->setJsonContent(
                array(
                    'id' => $personInDB->getId(),
                    'firstName' => $personInDB->getFirstName(),
                    'lastName' => $personInDB->getLastName(),
                    'middleName' => $personInDB->getMiddleName(),
                    'gender' => $personInDB ->getGender(),
                    'mother_id' => $personInDB->getMotherId(),
                    'father_id' => $personInDB->getFatherId(),
                    'tree_id' => $personInDB->getTreeId()
                )
            );
            $response->setStatusCode(201, "OK");
            $response->setContentType('application/json', 'UTF-8');
        }
        else
        {
            throw new Exception("no element with id = ".$id);
        }

    }
    catch (Exception $e){
        $response->setStatusCode(409, "Conflict");
        $response->setJsonContent(
            array(
                'status'   => 'ERROR',
                'messages' => $e->getMessage()
            )
        );
    }
    return $response->send();

}


function deletePerson($id)
{
    $personInDB = Persons::findFirst($id);
    $response = new Response();

    try {
        if ($personInDB) {
            $personInDB->delete();
            $response->setStatusCode(204, "Deleted");
        }
        else
        {
            throw new Exception("no element with id = ".$id);
        }

    }
    catch (Exception $e){
        $response->setStatusCode(409, "Conflict");
        $response->setJsonContent(
            array(
                'status'   => 'ERROR',
                'messages' => $e->getMessage()
            )
        );
    }
    return $response->send();
}


function getPersonInTree($id)
{

        $response = new Response();
        try {
            $tree = Trees::findFirst($id);
            $persons = Persons::find("tree_id = '" . $tree->id . "'");

            $data = array();
            foreach ($persons as $row) {
                $data[] = array(
                    'id' => $row->getId(),
                    'firstName' => $row->getFirstName(),
                    'lastName' => $row->getLastName(),
                    'middleName' => $row->getMiddleName(),
                    'gender' => $row->getGender(),
                    'mother_id' => $row->getMotherId(),
                    'father_id' => $row->getFatherId(),
                    'tree_id' => $row->getTreeId()
                );
            }
            $response->setStatusCode(201, "OK");
            $response->setContentType('application/json', 'UTF-8');
            $response->setJsonContent($data);
        } catch (Exception $e) {
            $response->setStatusCode(409, "Conflict");
            $response->setJsonContent(
                array(
                    'status' => 'ERROR',
                    'messages' => $e->getMessage()
                )
            );
        }
        return $response->send();
}