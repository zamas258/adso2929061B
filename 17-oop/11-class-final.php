<?php
$title = '11-Final Class';
$description = 'Final: A class that cannot be extended or inherited from';

include 'template/header.php';

echo "<section>";

final class Fruit
{
    private $name;
    private $color;

    public function __construct($name, $color)
    {
        $this->name = $name;
        $this->color = $color;
    }

    public function showInfoFruit()
    {
        return "<li style='padding: 10px; margin: 8px 0; background: #f0f0f0; border-left: 4px solid #667eea; border-radius: 4px;'> 
                    <b>Name:</b> {$this->name} | 
                    <b>Color:</b> {$this->color}
                </li>";
    }
}

echo "<h2>Lista de Frutas</h2>";

# Error: Class Orange cannot extend final class Fruit
# class Orange extends Fruit { }

echo "<ul style='list-style: none; padding: 0;'>";

$fr = new Fruit('Pinapple', 'Yellow');
echo $fr->showInfoFruit();

$fr = new Fruit('Apple', 'Green');
echo $fr->showInfoFruit();

$fr = new Fruit('Blueberry', 'Dark Purple');
echo $fr->showInfoFruit();

echo "</ul>";

echo "<p style='background: #fff3cd; padding: 10px; border-radius: 4px; margin-top: 15px;'>";
echo "<strong>Nota:</strong> Esta es una clase <code>final</code>, no puede ser heredada.";
echo "</p>";

echo "</section>";

include 'template/footer.php';
?>