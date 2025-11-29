<?php
$title = '12-Method Final';
$description = 'Final Method: A method that cannot be overridden in child classes';

include 'template/header.php';

echo "<section>";

class Fruit {
    private $name;
    private $color;

    public function __construct($name, $color) {
        $this->name = $name;
        $this->color = $color;
    }

    public final function showInfoFruit() {
        return "<li style='padding: 10px; margin: 8px 0; background: #f0f0f0; border-left: 4px solid #667eea; border-radius: 4px;'> 
                    <b>Name:</b> {$this->name} | 
                    <b>Color:</b> {$this->color}
                </li>";
    }
}

class Orange extends Fruit {
    # Error: Cannot override final method
    # public function showInfoFruit() {}
}

echo "<h2>Lista de Frutas</h2>";

echo "<ul style='list-style: none; padding: 0;'>";

$fr = new Fruit('Pinapple', 'Yellow');
echo $fr->showInfoFruit();

$fr = new Fruit('Apple', 'Green');
echo $fr->showInfoFruit();

$fr = new Fruit('Blueberry', 'Dark Purple');
echo $fr->showInfoFruit();

echo "</ul>";

echo "<p style='background: #fff3cd; padding: 10px; border-radius: 4px; margin-top: 15px;'>";
echo "<strong>Nota:</strong> El método <code>showInfoFruit()</code> es <code>final</code>, no puede ser sobrescrito en clases hijas.";
echo "</p>";

echo "</section>";

include 'template/footer.php';
?>