<?php

/*

Author : Inazo
Website : https://www.kanjian.fr

Date : 31/01/217
Source : XSS Persistent on wordpress website since 07/2016

Deobfuscation of the first level
*/

$firstPart = '19 - 9, 126 - 8, 100 - 3, 122 - 8, 37 - 5,etc';

$firstPartArray = explode(',',$firstPart);
$outputFirst    = '';

foreach( $firstPartArray as $k => $v ){

	eval('$chrVal = '.$v.';');
	$outputFirst .= chr($chrVal);
}

file_put_contents('first-part.txt',$outputFirst);

$secondPart = '15 - 5, 122 - 4, 99 - 2, 119 - 5, 36 - 4, 113  9, etc';


$secondPartArray = explode(',',$secondPart);
$outputSecond    = '';

foreach( $secondPartArray as $k => $v ){

	eval('$chrVal = '.$v.';');
	$outputSecond .= chr($chrVal);
}

file_put_contents('second-part.txt',$outputSecond);


function xor_enc($payload_one, $key_one) {
	
  $res = '';
  
  for ( $i = 0; $i < strlen($payload_one); $i++) {
	 
	$ord1 = ord($payload_one[$i]);
	$ord2 = ord($key_one[ ( $i % strlen($key_one) ) ]);
	
	$ordTot = $ord1 ^ $ord2;
	  
    $res .= chr( $ordTot );
  }
  
  return $res;
}


file_put_contents('first-part-payload.txt',xor_enc(base64_decode('LE CODE BASE 64 TROUVE DANS LA PREMIER ETAPE'),'THE KEY'));

file_put_contents('second-part-payload.txt',xor_enc(base64_decode('LE CODE BASE 64 TROUVE DANS LA PREMIER ETAPE'),'THE KEY'));
