<?
error_reporting(0);

$bg_color = "transparent";
$cur_color = 'white';

function encrypt($string, $key) 
{
	  $result = "";
	  for($i=0; $i<strlen($string); $i++) {
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)+ord($keychar));
		$result.=$char;
	  }

	  return base64_encode($result);
}

function decrypt($string, $key) 
{
	  $result = "";
	  $string = base64_decode($string);

	  for($i=0; $i<strlen($string); $i++) {
		$char = substr($string, $i, 1);
		$keychar = substr($key, ($i % strlen($key))-1, 1);
		$char = chr(ord($char)-ord($keychar));
		$result.=$char;
	  }

	  return $result;
}

	
function byte_convert($bytes)
 {
    $symbol = array('b', 'kb', 'mb', 'gb', 'tb', 'pb', 'eb', 'zb', 'yb');

    $exp = 0;
    $converted_value = 0;
    if( $bytes > 0 )
    {
      $exp = floor( log($bytes)/log(1024) );
      $converted_value = ( $bytes/pow(1024,floor($exp)) );
    }

    return sprintf( '%.2f '.$symbol[$exp], $converted_value );
  }

  
function spc_replace($str)
{
$str=str_replace(" ","%20",$str);
return $str;
}

function shorten_text($text, $nchars) {
    //$text = $text." ";
	if(strlen($text)<$nchars)
	$ok=1;
	else
	$ok=0;
    $text = substr($text,0,$nchars);
    //$text = substr($text,0,strrpos($text,' '));
    if($ok==0)
	$text = $text."...";
    return $text;
    }





?>