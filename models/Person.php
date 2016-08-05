<?php
/**
 * Created by PhpStorm.
 * User: challenger
 * Date: 8/5/16
 * Time: 5:04 PM
 */
use Phalcon\Mvc\Model;
class Person extends Model
{
    private $id;
    private $tree_id;
    private $firstName;
    private $lastName;
    private $middleName;
    private $gender;
    private $mother_id;
    private $father_id;


    public function initialize()
    {
        $this->belongsTo("tree_id", "Tree", "id");
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTreeId()
    {
        return $this->tree_id;
    }

    /**
     * @param mixed $tree_id
     */
    public function setTreeId($tree_id)
    {
        $this->tree_id = $tree_id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @param mixed $middleName
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getMotherId()
    {
        return $this->mother_id;
    }

    /**
     * @param mixed $mother_id
     */
    public function setMotherId($mother_id)
    {
        $this->mother_id = $mother_id;
    }

    /**
     * @return mixed
     */
    public function getFatherId()
    {
        return $this->father_id;
    }

    /**
     * @param mixed $father_id
     */
    public function setFatherId($father_id)
    {
        $this->father_id = $father_id;
    }

}