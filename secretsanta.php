<?php 

$girls = array(
	array('Nat','test@test.com'),
	array('Gentry','test@test.com'),
	array('Donny','test@test.com'),
	array('Gee','test@test.com')
);
$dupe = $girls;
shuffle($dupe);

$matches = array();

while(count($dupe) > 0) {
	if( $dupe[0][0] != $girls[0][0] ) {
		$santa = array_shift($girls); // dupe
		$secret = array_shift($dupe); // girl
		$matches[] = array($santa, $secret);
	} else if( count($dupe) == 1 && $dupe[0][0] == $girls[0][0] ) {
		$santa = array_shift($girls); // steal 
		$secret = $matches[0][1]; // normal
		$matches[0][1] = array_shift($dupe); // last girl swapped		
		$matches[] = array($santa, $secret); // last match		
	}	else {
		shuffle($dupe);
	}
}

foreach($matches as $match) {
	echo $match[0][0] . ' at ' . $match[0][1] . ' buyz for ' . $match[1][0] . '<br/>';
	// send email 
	echo mail ( $match[0][1] , 'Secret Santa' , 'Hey ' . $match[0][0] . ', you buy for ' . $match[1][0] . '. Ignore previous emails. ' );
}
