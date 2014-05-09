<?php
    require_once("database.php");

    // Class for categories

    class Category {
        private $database = null;
        private $id = null;

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
        
        function saveCategory($name, $parent) {
            return $this->database->updateCategory($this->getId(), $name, $parent);
        }
        
		function getId() {
			return $this->id;
		}
		
		function setId($id) {
			$this->id = $id;
		}
    }
?>