<?php
class System_Administration extends Database {

    public function execute() {
        if ($_POST['action'] == "add_book_type") {
            return $this->addBookType();
        } else if ($_POST['action'] == "edit_book_type") {
            return $this->editBookType();
        }
    }

    public function fetchBookTypeDetails($code) {
        $sql = "SELECT * FROM book_types WHERE id=:code";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindParam("code", $code);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $info[0];
    }

    private function addBookType() {
        $sql = "INSERT INTO book_types (name)"
                . " VALUES (:name)";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("name", strtoupper($_POST['name']));
        if ($stmt->execute()) {
            return true;
        } else
            return false;
    }

    private function editBookType() {
        $sql = "UPDATE book_types SET name=:new_name WHERE id=:code";
        $stmt = $this->prepareQuery($sql);
        $stmt->bindValue("code", $_SESSION['book_type']);
        $stmt->bindValue("new_name", strtoupper($_POST['name']));
        if ($stmt->execute()) {
            return true;
        } else
            return false;
    }

    public function getAllBookTypes() {
        $sql = "SELECT * FROM book_types ORDER BY createdat ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($info) == 0) {
            $_SESSION['no_records'] = true;
        } else {
            $_SESSION['yes_records'] = true;
            $values2 = array();
            foreach ($info as $data) {
                $values = array("id" => $data['id'], "name" => $data['name'], "createdat" => $data['createdat']);
                array_push($values2, $values);
            }
            return json_encode($values2);
        }
    }

    public function getBookTypes() {
        $sql = "SELECT id, name FROM book_types ORDER BY name ASC";
        $stmt = $this->prepareQuery($sql);
        $stmt->execute();
        $currentGroup = null;
        $html = "";
        while ($row = $stmt->fetch()) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                $html .= "<option value=\"{$row['id']}\" selected>{$row['name']}</option>";
            } else {
                $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
            }
        }
        if ($html == "")
            $html = "<option value=\"\">No book type entered into the database!</option>";
        echo $html;
        return $currentGroup;
    }

}
