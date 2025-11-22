<?php
$title = '02-construct';
$description = 'Special method that initializes a new object upon creation.';

include 'template/header.php';

echo '<section>';

class PlayList {
    # Attrs
    public $name;
    public $artist = array();
    public $genre = array();
    public $image = array();
    public $year = array();

    # Construct Method
    public function __construct($name){
        $this->name = $name;
    }
    public function setPlayList($artist, $genre, $image, $year) {
        $this->artist[] = $artist;
        $this->genre[]  = $genre;
        $this->image[]   = $image;
        $this->year[]   = $year;
    }
    public function getPlayList(){
        echo "<h3>PlayList: $this->name</h3>
            <div style='display:flex; gap: 0.4rem; flex-direction: column'>";
                foreach($this->artist as $i => $artist){
                    echo "<div style='display: flex; gap: 0.4rem; border: 2px solid #0009; background:#0003'>
                    <img src='{$this->image[$i]}' width='160px'>
                    <div>
                        <h4>Artist: $artist</h4>
                        <h5>Genre: {$this->genre[$i]}</h5>
                        <h5>Year: {$this->year[$i]}</h5>
                    </div>
                    </div>";
                }
            echo "</div>";
    }
}
$pl = new PlayList('Trap Tiraderas');
$pl->setPlayList('Kris-r', 'Trap', 'https://i.ytimg.com/vi/i0CUfIGODio/sddefault.jpg', 2025);
$pl->setPlayList('Blessd', 'Trap', 'https://i.ytimg.com/vi/9Xo9XCaYVYw/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLDsWO8wJP1K5G4PMAC64OWNbLLO0w', 2025);
$pl->setPlayList('Pirlo', 'Trap', 'https://i.ytimg.com/vi/LuJpdvb5bDk/hqdefault.jpg', 2025);
$pl->getPlayList();

include 'template/footer.php';