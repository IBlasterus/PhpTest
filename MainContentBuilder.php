<?php

require_once 'BooksContentBuilder.php';
require_once 'AuthorsContentBuilder.php';

/**
 * Построитель контента основной формы
 *
 * @author Александр Чёрный
 */
class MainContentBuilder {
    /**
     * Шаблон основной формы
     * 
     * @var type String
     */
    private $mainTemplate;
    
    public function __construct() {
        $this->mainTemplate = file_get_contents('forms/main.html');
    }
    
    /**
     * Построить контент основной формы
     */
    public function build() {
        // Инициализация
        $mainContent = $this->mainTemplate;
        $booksContentBuilder = new BooksContentBuilder();
        $authorsContentBuilder = new AuthorsContentBuilder();
        
        // Построение
        $booksContent = $booksContentBuilder->getContent();
        $mainContent = str_replace('{books}', $booksContent, $mainContent);
        
        $authorsContent = $authorsContentBuilder->getContent();
        $mainContent = str_replace('{authors}', $authorsContent, $mainContent);
        
        // Вывод контента
        echo $mainContent;
    }
}
