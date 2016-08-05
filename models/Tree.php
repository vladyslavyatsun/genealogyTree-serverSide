<?php
/**
 * Created by PhpStorm.
 * User: challenger
 * Date: 8/5/16
 * Time: 5:04 PM
 */

use Phalcon\Mvc\Model;
class Tree extends Model
{
    private $id;
    private $title;
    private $autor;


    public function initialize()
    {
        $this->hasMany("id", "Person", "tree_id");
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
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * @param mixed $autor
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

}
