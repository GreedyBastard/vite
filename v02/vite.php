<?php

include_once('./lib/Blake2b.php');


$addr="vite_24d6313a1ee1bcd8e979565a39a9c6f4decc8a1be01a5debee";
echo $addr."<br><br>";

function str_to_hash($string) {
$blake2b = new Blake2b();
$hash = $blake2b->hash( $string );
return $hash;
}

#tu wrzucamy address body:
#24d6313a1ee1bcd8e979565a39a9c6f4decc8a1b
function getAddrCheckSum($addr) {
	$ADDR_CHECK_SUM_SIZE = 5;
    $addrPre20 = substr($addr, 0, 20);
	$blake2b = new Blake2b();
    $_checkSum = $blake2b->hash($addrPre20, null, $ADDR_CHECK_SUM_SIZE);
    $checkSum = $_checkSum;


        return $checkSum;


    $newCheckSum=array_flip($checkSum);
    
	#checkSum.forEach(function (byte) {
    #    array_push($newCheckSum, (byte ^ 0xFF));
    #});

    return $newCheckSum;
}


function isValidHex($literal_addr) {
	$ADDR_PRE = 'vite_';
	$ADDR_SIZE = 20;
	$ADDR_CHECK_SUM_SIZE = 5;
	$ADDR_LEN = strlen($ADDR_PRE) + $ADDR_SIZE * 2 + $ADDR_CHECK_SUM_SIZE * 2; #55
	
    if (strlen($literal_addr) == $ADDR_LEN){
		if(strpos($literal_addr, $ADDR_PRE) == 0){
			
			$addressBody=substr($literal_addr,5,40);
			$bdyChecksum=substr($literal_addr,45,10);
			$addressBodyHex=str_to_hash($addressBody);
			$bdyChecksumHex=getAddrCheckSum($bdyChecksum);
			
			echo "DBG: Literal addr: $literal_addr<br><br>";	#55chars
			echo "DBG: Address body: $addressBody<br><br>";		#24d6313a1ee1bcd8e979565a39a9c6f4decc8a1b 	40chars
			echo "DBG: Body current chcksum: $bdyChecksum<br><br>";		#e01a5debee 								10chars
			
			echo "DBG: Address body hex: $addressBodyHex<br><br>";		#24d6313a1ee1bcd8e979565a39a9c6f4decc8a1b 	40chars
			echo "DBG: Body chcksum hex: $bdyChecksumHex<br><br>";		#e01a5debee 								10chars
			
			if(1==1){
				#test
			} else {
				echo "ERR: This is not a valid vite address <br><br>";
				return 0;
			} 
		} else {
			echo "ERR: Address does not start with vite_ prefix <br><br>";
			return 0;
		}
	} else {
		echo "ERR: Address is too short <br><br>";
		return 0;
	}
}

function isValidAddress($address) {
    if (!isValidHex($address)) {
        return 0;
    }
    return 1;
}

isValidAddress($addr);

?>