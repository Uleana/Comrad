<?php
include_once 'namespaceMySQL.php';
/**
 * Description of classDrawInterface
 * @author alexandr
 */
class DrawInterface
{
    private $Object;
    
    function __construct($Object)
    {
	$this->Object = $Object;
    }
    
    function DrawTable(MySQLTable $Table)
    {
	$cols = $Table->getColumns();
	foreach ($cols as $col)
	{
	    if (
		$col->getType()->getTypeName()=="bit"|
		$col->getType()->getTypeName()=="bool"|
		$col->getType()->getTypeName()=="tinyint"
	       )
	    {
		
	    }
	    else if (
		     $col->getType()->getTypeName()=="bit"|
		     $col->getType()->getTypeName()=="bit"|
		     $col->getType()->getTypeName()=="bit"|
		     $col->getType()->getTypeName()=="bit" 
		    )
	    {
		
	    }
	}
    }
    
}

?>
