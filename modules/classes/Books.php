<?php
class Books extends Database {

    public function execute() {
        if ($_POST['action'] == "add_book") {
            return $this->addBook();
        } else if ($_POST['action'] == "edit_book") {
            return $this->editBook();
        }
    }

    private function addBook() {
        $sql = "INSERT INTO books (title, description, author, type_id)"
                . " VALUES (:title, :description, :author, :type_id)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("title", strtoupper($_POST['title']));
        $stmt->bindValue("description", strtoupper($_POST['description']));
        $stmt->bindValue("author", strtoupper($_POST['author']));
        $stmt->bindValue("type_id", $_POST['book_type']);
        $stmt->execute();
        return true;
    }

    private function editBook() {
        $sql = "UPDATE books SET title=:new_title, description=:new_description, author=:new_author, type_id=:new_type_id WHERE id=:code";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("code", $_SESSION['book']);
        $stmt->bindValue("new_title", strtoupper($_POST['title']));
        $stmt->bindValue("new_description", strtoupper($_POST['description']));
        $stmt->bindValue("new_author", strtoupper($_POST['author']));
        $stmt->bindValue("new_type_id", $_POST['book_type']);
        if ($stmt->execute()) {
            return true;
        } else
            return false;
    }

    public function getAllBooks() {
        $sql = "SELECT * FROM books ORDER BY id ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            $_SESSION['no_records'] = true;
        } else {
            $_SESSION['yes_records'] = true;
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "title" => $data['title'], "description" => $data['description'], "author" => $data['author'], "type_id" => $data['type_id'], "createdat" => $data['createdat']);
                array_push($values2, $values);
            }
            return json_encode($values2);
        }
    }

    public function fetchBookDetails($code) {
        $sql = "SELECT * FROM books WHERE id=:code";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindParam("code", $code);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info[0];
    }

}
