<?php
$title = '03-Private';
$description = 'Private: Access modifier that restricts property or method visibility to within the class';
include 'template/header.php';

echo "<section>";
class RenderTable {
    private $nr; #Number of rows
    private $nc; #Number of columns
    public function __construct($nr, $nc) {
        $this->nr = $nr;
        $this->nc = $nc;

        //Access to private methods 
        $this->startTable();
        $this->bodyTable();
        $this->endTable();
    }
    private function startTable(){
        echo "<table>";
    }
        private function bodyTable(){
            echo "<h3>Table ({$this->nr} x {$this->nc})</h3>";
        for($r = 1; $r <= $this->nr; $r++){
            echo "<tr>";
            for($c = 1; $c <= $this->nc; $c++){
                echo "<td> f{$r}c{$c}</td>";
            }
            echo "</tr>";

        }
    }
        private function endTable(){
        echo "</table>";
    }
}
$tbl =new RenderTable(5, 5);
$tbl =new RenderTable(3, 8);
$tbl =new RenderTable(2, 2);


include 'template/footer.php';
?>