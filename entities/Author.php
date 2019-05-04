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
}
