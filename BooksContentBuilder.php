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
        $deleteAuthorFromBookForm = file_get_contents('forms/deleteAuthorFromBookForm.html');
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
            $options2 = '';
            foreach ($listAuthors as $a_key => $a_val) {
                if ($i === 0) {
                    $stringAuthors = $a_val->getName();
                    $options2 = '<option selected value="' . $a_val->getId() . '">' 
                        . $a_val->getName() . '</option>';
                } else {
                    $stringAuthors = $stringAuthors . ', ' . $a_val->getName();
                    $options2 = $options2 . '<option value="' . $a_val->getId() . '">' 
                        . $a_val->getName() . '</option>';
                }
                $i++;
            }
            if ($stringAuthors === '') {
                $stringAuthors = 'Автор не известен';
                $deleteAuthorFromBook_block = '';
                $currentForm = $forms;
            } else {
                $deleteAuthorFromBook_block = '<div class="control2"><a href="#deleteAuthorFromBookForm_' . $val->getId() . '">Удалить</a></div>';
                $forms = $forms . $deleteAuthorFromBookForm;
                $currentForm = str_replace('{authors_of_the_book}', $options2, $forms);
            }
            
            $book = '<table width="100%"><tr><td class="book_line">' . $val->getName() . ' '
                    . $edit_block . ' ' . $delete_block . '</td></tr><tr><td class="book_line_hr">' 
                    . $stringAuthors . $addAuthorToBook_block . $deleteAuthorFromBook_block 
                    . '</td></tr></table>';
            $content = $content . $book;
            
            $currentForm = str_replace('{id}', $val->getId(), $currentForm);
            $currentForm = str_replace('{name}', $val->getName(), $currentForm);
            $content = $content . $currentForm;
        }
        
        $content = str_replace('{SELF_URL}', SELF_URL, $content);
        return $content;
    }
}
