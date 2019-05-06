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
        $deleteForm = file_get_contents('forms/deleteAuthorForm.html');
        $forms = $editForm . $deleteForm;

        foreach ($authors->getList() as $key => $val) {
            $edit_block = '<div class="control"><a href="#editAuthorForm_' . $val->getId() . '">Редактировать</a></div>';
            $delete_block = '<div class="control"><a href="#deleteAuthorForm_' . $val->getId() . '">Удалить</a></div>';
            
            $author = '<div class="line">' . $val->getName() . ' '
                    . $edit_block . ' ' . $delete_block . '</div>';
            $content = $content . $author;
            
            $currentForm = str_replace('{id}', $val->getId(), $forms);
            $currentForm = str_replace('{name}', $val->getName(), $currentForm);
            $content = $content . $currentForm;
        }
        
        $content = str_replace('{SELF_URL}', SELF_URL, $content);
        return $content;
    }
}
