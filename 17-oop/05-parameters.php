<?php
$title = '05-Parameters';
$description = 'Parameters: Values passed into a function to customize its operation.';

include 'template/header.php';

echo "<section>";

class Country {
    public $name;
    public function __construct($name){
        $this->name = $name;
    }
}
class FifaWorldCup {
    private $country;
    private $year;
    private $winner;
        #Country & year are mandatory 
        #winner is optional 
    public function __construct(Country $country, $year, $winner = 'Brazil'){
        $this->country = $country;
        $this->year    = $year;
        $this->winner  = $winner;
    }
    public function showEvent(){
        echo "<ul>
                <li style=\"display: flex; flex-direction: row; justify-content: space-between; align-items: center;border: 1px solid #ccc;padding: 8px;background: #fff;\">
                    <span><b>Country:</b> {$this->country->name}</span>
                    <span><b>Year:</b> {$this->year}</span>
                    <span><b>Winner</b> {$this->winner}</span>
                </li>
            </ul>";
    }
}

$country = new Country('Italy');
$worldcup = new FifaWorldCup($country, 1990, 'Germany');
$worldcup->showEvent();

$country = new Country('USA');
$worldcup = new FifaWorldCup($country, 1994, 'Brazil');
$worldcup->showEvent();

$country = new Country('France');
$worldcup = new FifaWorldCup($country, 1998, 'France');
$worldcup->showEvent();

$country = new Country('Korea/Japan');
$worldcup = new FifaWorldCup($country, 2002, 'Brazil');
$worldcup->showEvent();

$country = new Country('Germany');
$worldcup = new FifaWorldCup($country, 2006, 'Italy');
$worldcup->showEvent();

$country = new Country('South Africa');
$worldcup = new FifaWorldCup($country, 2010, 'Spain');
$worldcup->showEvent();

$country = new Country('Brazil');
$worldcup = new FifaWorldCup($country, 2014, 'Germany');
$worldcup->showEvent();

$country = new Country('Russia');
$worldcup = new FifaWorldCup($country, 2018, 'France');
$worldcup->showEvent();

$country = new Country('Qatar');
$worldcup = new FifaWorldCup($country, 2022, 'Argentina');
$worldcup->showEvent();


include 'template/footer.php';
?>