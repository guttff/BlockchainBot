<?php
namespace Factory;

use ModelContainer\OrderBooks;

// require_once 'ModelContainer/OrderBooks.php';

class OrderBooksFactory
{
    public static function create() {
        return new OrderBooks();
    }
}

