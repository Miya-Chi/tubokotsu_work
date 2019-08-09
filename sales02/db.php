<?php

class DB
{
    private $USER = "root";
    private $PW = "admin";
    private $dns = "mysql:dbname=salesmanagement;host=mysql;charset=utf8";

    private function Connectdb()
    {
        try {
            $pdo = new PDO($this->dns, $this->USER, $this->PW);
            return $pdo;
        } catch (Exception $e) {
            return false;
        }
    }

    protected function executeSQL($sql, $array)
    {
        try {
            if (!$pdo = $this->Connectdb()) return false;
            $stmt = $pdo->prepare($sql);
            $stmt->execute($array);
            return $stmt;
        } catch (Exception $e) {
            return false;
        }
    }
}
//public $paging;
//public $sort;
//public $column;
////    public $limit;
////    public $offset;
//
//public function __construct($sort, $paging, $column)
//{
//    $this->sort = 'ASC';
//    $this->column = 'GoodsID';
//    $this->limit = '';
//    $this->column = 'GoodsID';
//}
//
////goodsテーブルのCRUD担当
//public function SelectGoodsAll()
//{
//    $this->Paging();
//    $this->sort();
//    // Execute SQL.
//    $sql = "SELECT * FROM goods ORDER BY {$this->column} {$this->sort} LIMIT {$this->limit} OFFSET {$this->offset}";
//    $res = parent::executeSQL($sql, null);
//    // Generate HTML.
//    $data = "<table class='recordlist' id='goodsTable'>";
//}