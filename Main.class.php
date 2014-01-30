<?php
    include('Webpage.class.php');
    
	class Main{
		private $mother;
		private $linkedwords;
		private $size;

		public function __construct ($word) {
			$this->mother = new Webpage("http://fr.wikipedia.org/wiki/".$word);
			$this->size = 0;
			
			$size = sizeof($this->mother->getLinks());
			for ( $i = 0 ; $i < $size ; $i++ ) {
				$child = new Webpage($this->mother->getLink($i));
				if ( true == $this->mother->isLinked($child)) {
					$this->linkedwords[$this->size] = $child->getKeyword();
					$this->size++;
				}
				unset($child);
			} 
		}
		public function getLinkedWords() {
			return $this->linkedwords;
		}
		public function printLinkedWords() {
			echo ("------------- V1 --------------<br/>");
			foreach ( $this->linkedwords as $words ) { 
				echo ($words."<br/>");
			}
			echo ("-------------------------------<br/>");
		}
	}
?>
