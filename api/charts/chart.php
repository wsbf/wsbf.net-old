<?php
class Chart {
	var $start, $end;
	
	var $albumArray;
	
	
	function Chart($start, $end) {
		$this->start = $start;
		$this->end = $end;	
		$this->albumArray = Array();
	}
	function getStartTime() {
		return $start;
	}
	
	function getEndTime() {
		return $end;
	}
	
	function hasAlbumID($albumID) {
		return isset($this->albumArray[$albumID]);
	}
	
	function addAlbum($album) {
		if(!isset($this->albumArray[$album->getAlbumID()])) {
			$this->albumArray[$album->getAlbumID()] = $album;
		}
	}

	function sort() {
		uasort($this->albumArray, 'compare');
	}
	
	function determineRank() {
		$i = 0;
		foreach($this->albumArray as $key => $album) {
			$this->albumArray[$key]->setRank(++$i); 
		}
	}
	
	function determineChange($albumArray) {
		foreach($this->albumArray as $key => $album) {
			if(!isset($albumArray[$key]))
				$album->setChange("NEW!");
			else {
				if($album->getRank() == $albumArray[$key]->getRank()) {
					$this->albumArray[$key]->setChange(0);
				}
				else {
					$this->albumArray[$key]->setChange((int)($albumArray[$key]->getRank() - $this->albumArray[$key]->getRank()));
				}
			}
		}
	}
	
	function getAlbum($albumID) {
		return $this->albumArray[$albumID];
	}
	
	function getAlbumArray() {
		return $this->albumArray;
	}
	function sorter($compare_function) {
		uasort($this->albumArray, $compare_function);
	}
	
}

function compare($a, $b) {
	if($a->getCount() == $b->getCount())
		return ($a->getArtist() < $b->getArtist()) ? -1 : 1;
	return ($a->getCount() < $b->getCount()) ? 1 : -1;
}