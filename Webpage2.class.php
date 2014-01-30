<?php
	class Webpage2{
		private $address;
		private $contents;
		private $weight;
		private $keyword;
		private $linkslist;

		public function __construct ( $adr ) {
			$this->address = $adr;
			if ( $this->setContents ($adr) ) {
				preg_match("/<title>(.*)<\/title>/i",$this->contents,$this->keyword);
				$this->keyword = substr ($this->keyword[1] , 0 , -12);
				$this->weight = 0;	
				$this->searchLinks();	
			}	
		}

		public function getAddress () {return $this->address;}
		public function getContents () {return $this->contents;}
		public function getWeight () {return $this->weight;}
		public function getKeyword () {return $this->keyword;}
		public function getLinks () {return $this->linkslist;}
		public function getLink ( $i ) {return $this->linkslist[$i];}
		
		public function decrWeight () {if ( 0 < $this->weight ) {$this->weight--;}}
		public function incrWeight () {$this->weight++;}

		public function setAddress ( $adr ) {$this->address = $adr;}	
		public function setContents ( $adr ) {
			$contents = file_get_contents($adr);
						
			if ( false === $contents ) { $this->contents = ""; return false;}
			else { $this->contents = $contents; return true;}
		}
		public function setKeyword ( $word ) {$this->keyword = $word;}
		public function setWeight ( $w ) {$this->weight = $w;}
		public function searchLinks () {
			preg_match_all('/<a.*href="?([^" ]*)" /iU', $this->contents, $linkslist);
			$size = sizeof ($linkslist[1]);
			for( $i = 0 ; $i < $size ; $i++ ) {
				if ( 1 == preg_match( "/^(.*)\.[jpg|png|jpeg|gif]$/i", $linkslist[1][$i] ) ) {
					$linkslist[1][$i] = "";
				}
			}
			
			$j=0;
			for( $i = 0 ; $i < $size ; $i++ ) {
    			if ( 0 != strcmp( $linkslist[1][$i] , "" ) ) { 
					$this->linkslist[$j] = $linkslist[1][$i];
					$j++;
				}
			}
		}	
	}
?>
