<?php

require_once 'Author.php';

/**
 * Сущность "Список авторов"
 *
 * @author Александр
 */
class Authors {

    /**
     * Список авторов
     * 
     * @var type array
     */
    protected $list;

    public function __construct() {
        $this->list = [];
        $db = new DB();
        $result = $db->query('CALL author_select()');
        while ($row = $result->fetch_assoc()) {
            $author = new Author($row['id'], $row['name']);
            $this->list[] = $author;
        }
    }

    /**
     * Получить список авторов
     * 
     * @return type Список авторов
     */
    public function getList() {
        return $this->list;
    }
}
