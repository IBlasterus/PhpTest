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
     * @var type string
     */
    protected $content;

    public function __construct() {
        $content = '<div class="add"><a href="#addAuthorForm">Добавить автора</a></div>';
        $this->content = $content . file_get_contents('forms/addAuthorForm.html');
    }

    /**
     * Получить контент 
     * 
     * @return string
     */
    public function getContent() {
        $content = $this->content;
        $authors = new Authors();
        $editForm = file_get_contents('forms/editAuthorForm.html');

        foreach ($authors->getList() as $key => $val) {
            $edit_block = '<div class="control"><a href="#editAuthorForm_' . $val->getId() . '">Редактировать</a></div>';
            $delete_block = '<div class="control"><a href="#">Удалить</a></div>';
            $author = '<div class="line">' . $val->getName() . ' '
                    . $edit_block . ' ' . $delete_block . '</div>';
            $content = $content . $author;
            $currentEditForm = str_replace('{id}', $val->getId(), $editForm);
            $currentEditForm = str_replace('{name}', $val->getName(), $currentEditForm);
            $content = $content . $currentEditForm;
        }
        
        return $content;
    }

}
