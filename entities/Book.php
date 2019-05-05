<?php

/**
 * Сущность "Книга"
 *
 * @author Александр
 */
class Book {
    /**
     * ID книги
     * 
     * @var type int
     */
    protected $id;
    
    /**
     * Наименование книги
     * 
     * @var type string
     */
    protected $name;
    
    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }
    
    /**
     * Получить ID книги
     * 
     * @return type int
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Получить наименование книги
     * 
     * @return type string
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Добавить книгу в БД
     * 
     * @param type $name string
     */
    public static function addBookToBD($name) {
        $sql = 'CALL `book_insert`("' . $name . '")';
        $db = new DB();
        $db->query($sql);
    }
    
    /**
     * Редактировать книгу
     * 
     * @param type $id int
     * @param type $name string
     */
    public static function editBookInBD($id, $name) {
        $sql = 'CALL `book_update`("' . $id . '", "' . $name . '")';
        $db = new DB();
        $db->query($sql);
    }
    
    /**
     * Удалить книгу
     * 
     * @param type $id int
     */
    public static function deleteBookInBD($id) {
        $sql = 'CALL `book_delete`("' . $id . '")';
        $db = new DB();
        $db->query($sql);
    }
    
    /**
     * Получить авторов книги
     * 
     * @param type $id int
     */
    public static function getAuthorsOfBookInBD($id) {
        $sql = 'CALL `book_select_author`("' . $id . '")';
        $db = new DB();
        $result = $db->query($sql);
        $listAuthors = [];
        while ($row = $result->fetch_assoc()) {
            $author = new Author($row['id'], $row['name']);
            $listAuthors[] = $author;
        }
        return $listAuthors;
    }
}