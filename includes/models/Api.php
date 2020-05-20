<?php
class Api{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function findBySql($query){
        $this->db->query($query);

        $set = $this->db->resultSet();

        return $set;
    }

    public function addBook($book_name,$author_name){
        $this->db->query('INSERT INTO book(book_name) VALUES(:name)');
        $this->db->bind(':name', $book_name);
        $isBookSaved = $this->db->execute();
        $id_book = $this->db->dbh->lastInsertId();

        $this->db->query('INSERT INTO author(name) VALUES(:author_name)');
        $this->db->bind(':author_name', $author_name);
        $isAuthorSaved = $this->db->execute();
        $id_author = $this->db->dbh->lastInsertId();

        $this->db->query('INSERT INTO author_book(id_author, id_book) VALUES(:id_author, :id_book)');
        $this->db->bind(':id_author', number_format($id_author));
        $this->db->bind(':id_book', number_format($id_book));
        $isAuthorBookSaved = $this->db->execute();

        if($isBookSaved and $isAuthorSaved and $isAuthorBookSaved){
            return true;
        }else{
            return false;
        }
    }

    public function addAuthorBook($id_book,$author_name){

        $this->db->query('INSERT INTO author(name) VALUES(:author_name)');
        $this->db->bind(':author_name', $author_name);
        $isAuthorSaved = $this->db->execute();
        $id_author = $this->db->dbh->lastInsertId();

        $this->db->query('INSERT INTO author_book(id_author, id_book) VALUES(:id_author, :id_book)');
        $this->db->bind(':id_author', number_format($id_author));
        $this->db->bind(':id_book', $id_book);
        $isAuthorBookSaved = $this->db->execute();

        if($isAuthorSaved and $isAuthorBookSaved){
            return true;
        }else{
            return false;
        }
    }

    public function addBookAuthor($book_name,$id_author){

        $this->db->query('INSERT INTO book(book_name) VALUES(:book_name)');
        $this->db->bind(':book_name', $book_name);
        $isAuthorSaved = $this->db->execute();
        $id_book = $this->db->dbh->lastInsertId();

        $this->db->query('INSERT INTO author_book(id_author, id_book) VALUES(:id_author, :id_book)');
        $this->db->bind(':id_book', number_format($id_book));
        $this->db->bind(':id_author', $id_author);
        $isAuthorBookSaved = $this->db->execute();

        if($isAuthorSaved and $isAuthorBookSaved){
            return true;
        }else{
            return false;
        }
    }

    public function modifyBook($book_name, $author_name, $id_book, $id_author){

        $this->db->query('UPDATE book SET book_name = :book_name, updated_at = now() WHERE id = :id_book');
        $this->db->bind('book_name', $book_name);
        $this->db->bind(':id_book', $id_book);
        $isUpdate_book = $this->db->execute();

        $this->db->query('UPDATE author SET name = :author_name WHERE id = :id_author');
        $this->db->bind(':author_name', $author_name);
        $this->db->bind(':id_author', $id_author);
        $isUpdate_author = $this->db->execute();

        if($isUpdate_book and $isUpdate_author){
            return true;
        }else{
            return false;
        }
    }

    public function deleteBook($id_book, $id_author){

        $this->db->query("DELETE FROM author_book WHERE id_author = :id_author AND id_book = :id_book");
        $this->db->bind(':id_author', $id_author);
        $this->db->bind(':id_book', $id_book);
        $isDeleted_author_book = $this->db->execute();


        if( $isDeleted_author_book){
            return true;
        }else{
            return false;
        }
    }

    public function getBookById($id_book , $id_author){
        $this->db->query(' SELECT *
        FROM book INNER JOIN author_book 
        ON book.id = :id_book and book.id = author_book.id_book
        INNER JOIN author 
        ON author.id = :id_author and author.id = author_book.id_author
        ');
        $this->db->bind(':id_book', $id_book);
        $this->db->bind(':id_author', $id_author);
        $row = $this->db->single();
        return $row;

    }

    public function getAllBook(){
        $query = "
        SELECT *
        FROM book
        INNER JOIN author_book ON book.id = author_book.id_book
        INNER JOIN author ON author_book.id_author = author.id
    
        ";
        return $this->findBySql($query);

    }
    public function getSession(){


    }
}

$api = new Api();
?>
