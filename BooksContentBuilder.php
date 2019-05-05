<?php

require_once 'entities/Books.php';
require_once 'entities/Authors.php';

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
        $authors = new Authors();
        $editForm = file_get_contents('forms/editBookForm.html');
        $deleteForm = file_get_contents('forms/deleteBookForm.html');
        $addAuthorToBookForm = file_get_contents('forms/addAuthorToBookForm.html');
        $forms = $editForm . $deleteForm . $addAuthorToBookForm;
        
        $i = 0;
        $options = '';
        foreach ($authors->getList() as $key => $val) {
            if ($i === 0) {
                $options = '<option selected value="' . $val->getId() . '">' 
                        . $val->getName() . '</option>';
            } else {
                $options = $options . '<option value="' . $val->getId() . '">' 
                        . $val->getName() . '</option>';
            }
            $i++;
        }
        $forms = str_replace('{authors}', $options, $forms);

        foreach ($books->getList() as $key => $val) {
            $edit_block = '<div class="control"><a href="#editBookForm_' . $val->getId() . '">Редактировать</a></div>';
            $delete_block = '<div class="control"><a href="#deleteBookForm_' . $val->getId() . '">Удалить</a></div>';
            $addAuthorToBook_block = '<div class="control2"><a href="#addAuthorToBookForm_' . $val->getId() . '">Добавить</a></div>';
            
            $listAuthors = Book::getAuthorsOfBookInBD($val->getId());
            $i = 0;
            $stringAuthors = '';
            foreach ($listAuthors as $a_key => $a_val) {
                if ($i === 0) {
                    $stringAuthors = $a_val->getName();
                } else {
                    $stringAuthors = $stringAuthors . ', ' . $a_val->getName();
                }
                $i++;
            }
            if ($stringAuthors === '') $stringAuthors = 'Автор не известен';
            
            $book = '<table width="100%"><tr><td class="book_line">' . $val->getName() . ' '
                    . $edit_block . ' ' . $delete_block . '</td></tr><tr><td class="book_line_hr">' 
                    . $stringAuthors . $addAuthorToBook_block . '</td></tr></table>';
            $content = $content . $book;
            
            $currentForm = str_replace('{id}', $val->getId(), $forms);
            $currentForm = str_replace('{name}', $val->getName(), $currentForm);
            $content = $content . $currentForm;
        }
        
        return $content;
    }
}
