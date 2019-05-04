<?php

require_once 'entities/Authors.php';

/**
 * Построитель контента страницы авторов
 *
 * @author Александр
 */
class AuthorsContentBuilder {

    /**
     * Шаблон формы
     * 
     * @var type String
     */
    protected $content;

    public function __construct() {
        $this->content = '<div class="add"><a href="#">Добавить автора</a></div>';
    }

    /**
     * Получить контент 
     * 
     * @return string
     */
    public function getContent() {
        $content = $this->content;
        $authors = new Authors();
        
        foreach ($authors->getList() as $key => $val) {
            $author = '<div class="line">' . $val->getName() . '</div>';
            $content = $content . $author;
        }
        return $content;
    }

}
