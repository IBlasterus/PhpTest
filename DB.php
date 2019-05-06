<?php

/**
 * Класс для работы с базой данных
 *
 * @author Александр
 */
class DB {

    /**
     * Линк к базе данных
     * 
     * @var type Link to DB
     */
    private $link;

    function __construct() {
        $link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or die("Ошибка " . mysqli_error($link));
        $this->link = $link;
    }

    function __destruct() {
        $this->link->close();
    }

    /**
     * Выполнить запрос
     * 
     * @param type $sql string
     * @return type query result
     */
    public function query($sql) {
        $result = $this->link->query($sql) or die("Ошибка " . mysqli_error($this->link));
        if ($result) {
            return $result;
        }
    }

}
