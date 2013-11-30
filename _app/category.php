<?php
    require_once("database.php");

    // Class for categories

    class Category {
        private $database = null;

        function __construct() {
            try { 
                $this->database = new Database();			
            }
            catch(Exception $e) {
                die($e);
            }
        }

        function getAllCategories() {
            $table = $this->database->categoriesTable;
            return $this->database->selectAllFromTable($table, $limit, $offset);
        }

        function createCategory($name, $parent) {
            return $this->database->createCategory($name, $parent);
        }
    }
?>