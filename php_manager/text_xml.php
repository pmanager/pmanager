<?
error_reporting(E_ALL);


$xmlDoc = new DOMDocument();
$xmlDoc->load("users.xml");

$nume = $xmlDoc->get_elements_by_tag_name("nume");


foreach ($nume AS $item)
  {
  print $item->value . " = " . $item->nodeValue . "<br />";
  }

//print $xmlDoc->saveXML();



/*
$xml = simplexml_load_file('users.xml');
	
	$user = $xml->addChild("user");
	$user->addChild("name","cucu");
	$user->addChild("password","parola");
    
	
	echo $xml->asXML();
	
	$fp = fopen('users.xml', 'w');
	fwrite($fp, $xml->asXML());
	
	fclose($fp);
*/	
	?>