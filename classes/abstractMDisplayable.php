<?php
abstract class Displayable
{
	abstract function getDisplayedCode();
	
	function Display()
	{
	    echo $this->getDisplayedCode();
	}
}
?>