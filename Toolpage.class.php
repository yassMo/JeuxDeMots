<?php
	class Toolpage{
		private $address;
		private $contents;
		private $dictionnary;
		private $size;

		public function __construct ( $adr ) {
			$this->address = $adr;
			if ( $this->setContents ($adr)) {
				$this->fillDictionnary();	
			}	
		}

		public function getAddress () {return $this->address;}
		public function getContents () {return $this->contents;}
		public function getKeyword ( $i ) {return $this->dictionnary[$i][0];}
		public function getLink ( $i ) {return $this->dictionnary[$i][1];}
		public function getSize ( $i ) {return $this->size;}
		
		public function setAddress ( $adr ) {$this->address = $adr;}	
		public function setContents ( $adr ) {
			$contents = file_get_contents($adr);
						
			if ( false === $contents ) { $this->contents = ""; return false;}
			else { $this->contents = $contents; return true;}
		}
		public function fillDictionnary () {
			preg_match_all('/<li><a (.*)>/iU', $this->contents, $contents);
			
			$this->size = sizeof ($contents[1]);
			for( $i = 0 ; $i < $this->size ; $i++ ) {
				preg_match('/^href="?([^" ]*)" /iU', $contents[1][$i], $link);
				preg_match('/.*title="?([^"]*)"$/iU', $contents[1][$i], $key);
				
				$this->dictionnary[$i][0]=$key[1];
				$this->dictionnary[$i][1]=$link[1];
			}
		}		
	}
?>
