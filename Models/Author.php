<?php

class Author
{
    private $db;
    private $table = 'authors';

    private $id;
    private $name;

    public function __construct($db, $author_data = [])
    {
        $this->db = $db;
        if (isset($author_data['id'])) {
            $this->id = $author_data['id'];
            $this->name = @$author_data['name'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

        public function toArray () {
        return [
            "id" => $this->getId(),
            "name" => $this->getName()
        ];
    }

    public function getById($id) {
        return $this->db->getById($this->table, $id);
    }

    public function readAll() {
        return $this->db->readAll($this->table);
    }
}