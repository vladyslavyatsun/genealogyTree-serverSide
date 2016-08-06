<?php
/**
 * Created by PhpStorm.
 * User: challenger
 * Date: 8/5/16
 * Time: 5:04 PM
 */

use Phalcon\Mvc\Model;
class Trees extends Model
{
    private $id;
    private $title;
    private $author;


    public function initialize()
    {
        $this->hasMany("id", "Persons", "tree_id");
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    function __toString()
    {
        return "id = ".$this->id."title = ".$this->title." author = ".$this->author;
    }


}
