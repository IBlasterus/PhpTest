<?php

/**
 * Сущность "Автор"
 *
 * @author Александр
 */
class Author {
    /**
     * ID автора
     * 
     * @var type int
     */
    protected $id;
    
    /**
     * Имя автора
     * 
     * @var type string
     */
    protected $name;
    
    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }
    
    /**
     * Получить ID автора
     * 
     * @return type int
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Получить имя автора
     * 
     * @return type string
     */
    public function getName() {
        return $this->name;
    }
    
    /**
     * Добавить автора в БД
     * 
     * @param type $name string
     */
    public static function addAuthorToBD($name) {
        $sql = 'CALL `author_insert`("' . $name . '")';
        $db = new DB();
        $db->query($sql);
    }
    
    /**
     * Редактировать автора
     * 
     * @param type $id int
     * @param type $name string
     */
    public static function editAuthorInBD($id, $name) {
        $sql = 'CALL `author_update`("' . $id . '", "' . $name . '")';
        $db = new DB();
        $db->query($sql);
    }
    
    /**
     * Удалить автора
     * 
     * @param type $id int
     */
    public static function deleteAuthorInBD($id) {
        $sql = 'CALL `author_delete`("' . $id . '")';
        $db = new DB();
        $db->query($sql);
    }
}
