<?php

require_once 'entities/Books.php';

/**
 * Построитель контента страницы книг
 *
 * @author Александр
 */
class BooksContentBuilder {

    /**
     * Шаблон формы
     * 
     * @var type string
     */
    protected $content;

    public function __construct() {
        $content = '<div class="add"><a href="#addBookForm">Добавить книгу</a></div>';
        $this->content = $content . file_get_contents('forms/addBookForm.html');
    }

    /**
     * Получить контент 
     * 
     * @return string
     */
    public function getContent() {
        $content = $this->content;
        $books = new Books();
        $editForm = file_get_contents('forms/editBookForm.html');
        $deleteForm = file_get_contents('forms/deleteBookForm.html');
        $forms = $editForm . $deleteForm;

        foreach ($books->getList() as $key => $val) {
            $edit_block = '<div class="control"><a href="#editBookForm_' . $val->getId() . '">Редактировать</a></div>';
            $delete_block = '<div class="control"><a href="#deleteBookForm_' . $val->getId() . '">Удалить</a></div>';
            
            $book = '<div class="line">' . $val->getName() . ' '
                    . $edit_block . ' ' . $delete_block . '</div>';
            $content = $content . $book;
            
            $currentForm = str_replace('{id}', $val->getId(), $forms);
            $currentForm = str_replace('{name}', $val->getName(), $currentForm);
            $content = $content . $currentForm;
        }
        
        return $content;
    }
}
