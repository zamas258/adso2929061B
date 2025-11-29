<?php
$title = '19-Trait';
$description = 'Trait: Mechanism for code reuse in single inheritance languages, allowing inclusion of methods from multiple sources into a class';
include 'template/header.php';

echo "<section>";

trait Hello {
    public function sayHello($name) {
        echo "<li> <b>Welcome </b>".$name."</li>";
    }
}

trait Adso {
    public function sayAdso($code) {
        echo "<li> <b>Progam: </b>".$code."</li>";
    }
}

class Departament {
    use Hello , Adso;
    public function sayDepartment($dep) {
        echo "<li> <b> Department: </b>".$dep."</li>";
    }
}
$h1 = new Departament;
$h1->sayHello('Tomas');
$h1->sayAdso('2929061B');
$h1->sayDepartment('Caldas');

include 'template/footer.php';
?>