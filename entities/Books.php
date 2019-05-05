<?php

require_once 'Book.php';

/**
 * Сущность "Список книг"
 *
 * @author Александр
 */
class Books {

    /**
     * Список книг
     * 
     * @var type array
     */
    protected $list;

    public function __construct() {
        $this->list = [];
        $db = new DB();
        $result = $db->query('CALL book_select()');
        while ($row = $result->fetch_assoc()) {
            $book = new Book($row['id'], $row['name']);
            $this->list[] = $book;
        }
    }

    /**
     * Получить список книг
     * 
     * @return type Список авторов
     */
    public function getList() {
        return $this->list;
    }
}
