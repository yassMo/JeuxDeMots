<?php
    include('Webpage2.class.php');
    
	class Main2 {
		private $mother;
		private $toolpage;
		private $linkedwords;
		private $size;

		public function __construct ($word) {
			$this->mother = new Webpage2("http://fr.wikipedia.org/wiki/".$word);
			$this->toolpage = new Toolpage("http://fr.wikipedia.org/w/index.php?title=Spécial%3APages+liées&limit=1000&target=".$word."&namespace=");
			$this->size = 0;
			
			$size = sizeof($this->mother->getLinks());
			$size2 = $this->toolpage->getSize();
			for ( $i = 0 ; $i < $size ; $i++ ) {
				for ($j = 0; $j < $size2 ; $j++) {
					if ( strcmp ( $this->mother->getLink($i) , $this->toolpage->getLink($j) ) == 0 ) {
						$this->linkedwords[$this->size] = $this->toolpage->getKeyword($j);
						$this->size++;
					}
				}
			} 
		}
		
		public function getLinkedWords() {
			return $this->linkedwords;
		}	
			
		public function printLinkedWords() {
			echo ("------------- V2 --------------<br/>");
			foreach ( $this->linkedwords as $words ) { 
				echo ($words."<br/>");
			}
			echo ("-------------------------------<br/>");
		}
	}
?>
