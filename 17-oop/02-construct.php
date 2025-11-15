<?php
$title = '02-Construct';
$description = 'Lorem Input dolor sit amet.';
include 'template/header.php';
echo '<section>';

class Playlist{
    # Attributes
    public $artist;
    public $album;
    public $year;
    public $song;
    
    # Constructor Method
    public function __construct($artist, $album, $year, $song = 'Happy Birthday'){
        $this->artist = $artist;
        $this->album = $album;
        $this->year = $year;
        $this->song = $song;

    }
}
    $pl = new Playlist('Juanes', 'La camisa negra', 1994, 'La tierra');
echo $pl->song;

include 'template/footer.php';