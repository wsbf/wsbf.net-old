<?php
class Album {
	var $albumID, $album, $artist, $label, $count, $rank, $change;

	function Album($id, $al, $ar, $la) {
		$this->albumID = $id;
		$this->album = $al;
		$this->artist = $ar;
		$this->label = $la;
		$this->count = 1;
		$this->change = NULL;
		$this->rank = NULL;
	}
	function again() {
		$this->count++;
	}
	function getCount() {
		return $this->count;
	}
	function getArtist() {
		return $this->artist;
	}
	function setRank($rank) {
		$this->rank = $rank;
	}
	function getRank() {
		return $this->rank;
	}
	function getAlbumID() {
		return $this->albumID;
	}
	
	function setChange($change) {
		$this->change = $change;
	}
	
	function getAlbum() {
		return $this->album;
	}
	
	function getLabel() {
		return $this->label;
	}
	
	function getChange() {
		return $this->change;
	}
}
function validAlbumNo($ano) {
$pattern = '/^[A-Z]{1}[0-9]{3}/';
		return (preg_match($pattern, $ano));

}
