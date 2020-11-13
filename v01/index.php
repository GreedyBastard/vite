<?php

#VARS:
$addressVerified=0;
$vite_block_explorar_addr="https://explorer.vite.net/account/"; #eg. vite_f3593e633218ba13b2a6a6379d87e588285a5fba778dd3c20a
$fullRealUrl = 'https://rewardapi.vite.net/reward/full/real?cycle='; 

$err_div="<div style='background-color:#FFbaba;-webkit-border-radius: 5px;border:1px solid red;border-radius:5px;-moz-border-radius:5px;padding-left:10px;padding-top:10px;'>";
$inf_div="<div style='background-color:#0fca00;-webkit-border-radius: 5px;border:1px solid green;border-radius:5px;-moz-border-radius:5px;padding-left:10px;padding-top:10px;'>";

#FUNC:
function checkHTTPresponse($url,$param){
	// echo date('h:i:s:u', time()) . ": Checking HTTP availability for : ". $url . $param .". <br>"; 
	$headers = get_headers($url.$param);
	$http_rc = substr($headers[0], 9, 3);
	// echo date('h:i:s:u', time()) . ": Checking HTTP availability finished. <br>"; 
	return $http_rc;
	
}


function getJsonCycle($cycle_number){
	$file_name = "cycle".$cycle_number.".json"; 
	
	// check if such cycle was already downloaded before, +90% faster
	if (!file_exists('cycles/'.$file_name)) {   
		// echo date('h:i:s:u', time()) . ": File not found. Downloading..<br>"; 
		

		#if(checkHTTPresponse($fullRealUrl,$cycle_number)=="200"){ 	// #50% slower if implemented
		
			// Use file_get_contents() function to get the file 
			// from url and use file_put_contents() function to 
			//save the file on webserver
			
			if(file_put_contents( 'cycles/'.$file_name,file_get_contents($fullRealUrl.$cycle_number))) { 
				// echo date('h:i:s:u', time()) . ": File downloaded successfully<br>"; 
				$json = file_get_contents('cycles/'.$file_name);
				$json_output = (json_decode($json));
				return $json_output;
			} else { 
				// echo date('h:i:s:u', time()) . ": File downloading failed. Retrying with standard API<br>"; 
				$json = file_get_contents($fullRealUrl.$cycle);
				$json_output = (json_decode($json));
				return $json_output;
			} 
		#}
	} else {
				// echo date('h:i:s:u', time()) . ": File already exists. <br>"; 
				$json = file_get_contents('cycles/'.$file_name);
				$json_output = (json_decode($json));
				return $json_output;
	}
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ViteX FullNode online check</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  
  <body>

    <div class="container-fluid">
	<div class="row"><div class="col-md-12"><h3 class="text-center"><br></h3></div></div>
	<div class="row">
		<div class="col-md-2">
		<center>
		<svg class="logo" data-v-c405d972="" height="60px" version="1.1" viewBox="0 0 116 60" width="116px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
		<title data-v-c405d972="">logo</title>
		<desc data-v-c405d972="">Created with Sketch.</desc>
		<defs data-v-c405d972="">
		<linearGradient data-v-c405d972="" id="linearGradient-1" x1="0%" x2="136.342633%" y1="0%" y2="155.448607%">
		<stop data-v-c405d972="" offset="0%" stop-color="#052EF5"></stop>
		<stop data-v-c405d972="" offset="31.4739301%" stop-color="#0D6DF0"></stop>
		<stop data-v-c405d972="" offset="49.1836977%" stop-color="#0B92E7"></stop>
		<stop data-v-c405d972="" offset="71.3239784%" stop-color="#0BB6EB"></stop>
		<stop data-v-c405d972="" offset="100%" stop-color="#00E0F2"></stop>
		</linearGradient>
		</defs>
		<g data-v-c405d972="" id="Page-1" fill="none" fill-rule="evenodd" stroke="none" stroke-width="1">
		<g data-v-c405d972="" id="net1" transform="translate(-240.000000, -28.000000)"><g data-v-c405d972="" id="Group-6" transform="translate(240.000000, 28.000000)">
		<path d="M58.032,43.6297431 L64.7718165,26.8473578 L65.972367,26.8473578 L58.6870459,44.5726789 L57.2954862,44.5726789 L50.0371376,26.8473578 L51.2921835,26.8473578 L57.9775046,43.6297431 L58.032,43.6297431 Z M72.766789,44.572844 L72.766789,26.8469725 L73.9673394,26.8469725 L73.9673394,44.572844 L72.766789,44.572844 Z M80.7618165,27.7908991 L80.7618165,26.8474128 L95.6875046,26.8474128 L95.6875046,27.7908991 L88.8111743,27.7908991 L88.8111743,44.5727339 L87.6106239,44.5727339 L87.6106239,27.7908991 L80.7618165,27.7908991 Z M102.481596,26.8473578 L115.579211,26.8473578 L115.579211,27.7913945 L103.682147,27.7913945 L103.682147,34.8906606 L114.86967,34.8906606 L114.86967,35.8341468 L103.682147,35.8341468 L103.682147,43.6297431 L115.715725,43.6297431 L115.715725,44.5726789 L102.481596,44.5726789 L102.481596,26.8473578 Z" data-v-c405d972="" fill="#272727" id="Combined-Shape"></path><path d="M0,14.5913394 L19.7020183,10.164 L17.7385321,59.8340917 L0,14.5913394 Z M24.2043853,9.31150459 L63.6689725,-5.50458712e-05 L18.3612661,59.8997615 L24.2043853,9.31150459 Z" data-v-c405d972="" fill="url(#linearGradient-1)" id="Combined-Shape">
		</path>
		</g>
		</g>
		</g>
		</svg>
		<img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+Cjxzdmcgd2lkdGg9IjE2cHgiIGhlaWdodD0iMTZweCIgdmlld0JveD0iMCAwIDE2IDE2IiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgogICAgPCEtLSBHZW5lcmF0b3I6IFNrZXRjaCA0OS4zICg1MTE2NykgLSBodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2ggLS0+CiAgICA8dGl0bGU+bWVudTwvdGl0bGU+CiAgICA8ZGVzYz5DcmVhdGVkIHdpdGggU2tldGNoLjwvZGVzYz4KICAgIDxkZWZzPjwvZGVmcz4KICAgIDxnIGlkPSJTeW1ib2xzIiBzdHJva2U9Im5vbmUiIHN0cm9rZS13aWR0aD0iMSIgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj4KICAgICAgICA8ZyBpZD0iaGVhZGVyLXBhZCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTczMi4wMDAwMDAsIC0yNS4wMDAwMDApIiBmaWxsPSIjRkZGRkZGIj4KICAgICAgICAgICAgPGcgaWQ9Ikdyb3VwIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg3MzIuMDAwMDAwLCAyNS4wMDAwMDApIj4KICAgICAgICAgICAgICAgIDxwYXRoIGQ9Ik0xNiwxNSBMMCwxNSBMMCwxMyBMMTYsMTMgTDE2LDE1IFogTTAsOSBMMCw3IEwxNiw3IEwxNiw5IEwwLDkgWiBNMCwxIEwxNiwxIEwxNiwzIEwwLDMgTDAsMSBaIiBpZD0iQ29tYmluZWQtU2hhcGUiPjwvcGF0aD4KICAgICAgICAgICAgPC9nPgogICAgICAgIDwvZz4KICAgIDwvZz4KPC9zdmc+">
		</center>
		</div>
		<div class="col-md-8">
			<h3 class="text-center">
				FullNode online check
			</h3>
		</div>
		<div class="col-md-2"></div>
	</div>
	
	<div class="row"><div class="col-md-12"><h3 class="text-center"><br></h3></div></div>
	
	<div id="loading">
		<img id="loading-image" src="images/ajax-loader.gif" alt="Loading..." />
	</div>  
	<div class="row">
		<div class="col-md-2">
		</div>
		<div class="col-md-5">
			<form role="form" action="index.php" method="POST">
				<div class="form-group">
					 
					<!--<label for="exampleInputEmail1">
						Please enter FullNode Vite address
					</label>-->
					<input type="text" class="form-control" id="vite_addr" name="vite_addr" placeholder="Please enter FullNode Vite address" 
					<?php if(isset($_POST['vite_addr'])){echo 'value="'.$_POST['vite_addr'].'"';}?> >
				</div>
		</div>
		<div class="col-md-1">
				<div class="form-group">
					<input type="text" class="form-control" id="cycle" name="cycle" placeholder="Input cycle">
				</div>
		</div>
		<div class="col-md-1">
				<button type="submit" class="btn btn-primary" value="submit" name="submit" onclick="showDiv()">
					Search
				</button>
			</form>
		</div>
		<div class="col-md-2"></div>
	</div>
	<div class="row"><div class="col-md-12"><h3 class="text-center"><br></h3></div></div>
	
<?php
	if(isset($_POST['submit'])){
		
		$cycle_incomplete=ceil((time() - 1558411200) / 24 / 3600);
		$cycle_complete=$cycle_incomplete - 1;
			/*
			#Incomplete cycle algorithm verification:
			echo "Current time in seconds:    ". time()."<br/>";
			echo "Time minus 1558411200:    ". (time() - 1558411200) ."<br/>";
			echo "Divided by 24:    ". (time() - 1558411200) / 24 ."<br/>";
			echo "Divided by 3600:    ". (time() - 1558411200) / 24 / 3600 ."<br/>";
			echo  "Floor:    ". floor((time() - 1558411200) / 24 / 3600) ."<br/>";
			*/
		
		if(isset($_POST['vite_addr'])){
			if (strpos($_POST['vite_addr'], "vite_") === 0) {
				$vite_addr=$_POST['vite_addr'];
				$msg01=$vite_addr;
				$addr_trunc=substr($vite_addr,0,10)."....".substr($vite_addr,-7);
				
				
				#if(checkHTTPresponse($vite_block_explorar_addr.$vite_addr)=="200"){     // #50% slower if implemented
				if(true==($page = file_get_contents($vite_block_explorar_addr.$vite_addr))){

					$doc = new DOMDocument;
					libxml_use_internal_errors(true);
					$doc->loadHTML($page);

					$finder = new DomXPath($doc);

					// find class="address"
					$nodes = $finder->query("//*[contains(@class, 'address')]");

					// get the children of the first match  (class="address")
					$raised_children = $nodes->item(0)->childNodes;

					// get the verified address value
					$address = $raised_children->item(0)->nodeValue;

					$msg01=$inf_div . "Provided FullNode Vite address:     ".$vite_addr."</br>Verified block explorer address:      ".$address."</div>";
					
					$addressVerified=1;
				} else {
					$addressVerified=0;
					$msg01=$err_div . "You haven't provided <b>correct</b> FullNode vite address."."</div>";
				}
			} else {
				$addressVerified=0;
				$msg01=$err_div . "You haven't provided <b>correct</b> FullNode vite address."."</div>";
			}
			
		} else {
			$addressVerified=0;
			$msg01=$err_div . "You haven't provided FullNode vite address."."</div>";
		}
		
		if(isset($_POST['cycle'])){
			if( is_numeric($_POST['cycle'])){
				if( $_POST['cycle'] < $cycle_incomplete ){
					$cycle=$_POST['cycle'];
					$msg02=$cycle;
				} else {
				$cycle=$cycle_incomplete-1;
				$msg02=$err_div . "You haven't provided any <b>correct</b> cycle number.<br/> Using current incomplete cycle instead: ".$cycle."</div>";
				}
			} else {
				$cycle=$cycle_incomplete-1;
				$msg02=$err_div . "You haven't provided any <b>correct</b> cycle number.<br/> Using current incomplete cycle instead: ".$cycle."</div>";
				$cycle=$cycle_incomplete-1;
			}
		} else {
			$cycle=$cycle_incomplete-1;
			$msg02=$err_div . "You haven't provided any cycle number.<br/> Using current incomplete cycle instead: ".$cycle."</div>";
		}
		
		echo "<div class='row'>";
		echo "		<div class='col-md-2'></div>";
		echo "		<div class='col-md-7'>";
		echo "			<p> "; #FullNode Vite address : ";
		echo $msg01;
		echo "			</p>";
		echo "			<p> FullNode cycle : ";
		echo $msg02;
		echo "			</p>";
		echo "		</div>";
		echo "		<div class='col-md-2'></div>";
		echo "	</div>";
		echo "	<div class='row'><div class='col-md-12'><h3 class='text-center'><br></h3></div></div>";
	} //	else{		echo "POST not sent";	}
?>

	<div class="row" <?php if($addressVerified==0){echo "style='display:none;'";} ?> >
		<div class="col-md-2">
		</div>
		<div class="col-md-7">
			
		
		<table class="table table-hover table-sm">
				<thead>
					<tr>
						<th>
							#
						</th>
						<th>
							NodeName
						</th>
						<th>
							IsAlive
						</th>
						<th>
							OnlineRatio
						</th>						
						<th>
							Version
						</th>
						<th>
							NodeIP
						</th>
						<th>
							Address
						</th>
					</tr>
				</thead>
				<tbody>

<?php

if($addressVerified==1)
{
	#if(checkHTTPresponse("https://rewardapi.vite.net/reward/full/real?cycle=",$cycle)=="200"){     // #50% slower if implemented
			$json_output=getJsonCycle($cycle);
		
		#if(checkHTTPresponse("https://stats.vite.net/api/getAlivePeers?address=",$vite_addr)=="200"){     // #50% slower if implemented
			// echo date('h:i:s:u', time()) . ": Fetching getAlivePeers api content. <br>";
			
		if(true==($json2 = file_get_contents("https://stats.vite.net/api/getAlivePeers?address=".$vite_addr))){
			// echo date('h:i:s:u', time()) . ": Fetching getAlivePeers api content complete. <br>"; 
			$json_output2 = (json_decode($json2));
			#var_dump($json_output);
			echo "<br><b>Total Nodes: ";
			echo $json_output2->size;
			echo "</b><br><br>";

			$lp = 1;
			// echo date('h:i:s:u', time()) . ": Filtering data start. <br>"; 
			foreach ( $json_output->data as $obj ) {   
				$found=0;
				
				$ip="0.0.0.0";
				$onlRatio=0;
				$onlRatioPct="NotFound";
				$isAlive="NotFound";
				$nodeName="NotFound";
				$version="NotFound";
				
				foreach ( $json_output2->list as $obj2 ) {
					if($obj->ip == $obj2->ip){
						$found=1;
						
						$ip=$obj->ip;
						$onlRatio=number_format((float)$obj->onlineRatio*100, 2, '.', '') ;
						$onlRatioPct=$onlRatio ."%";
						if($obj2->isAlive == 1) { $isAlive="true" ; } else { $isAlive="false" ;	 }
						$nodeName=$obj2->nodeName;
						$version=$obj2->version;
						break;
					}
				}
				if ($found==0) {
					$onlRatioPct="NotFound";
				}
				
				
				if(      $onlRatio <  90.00 )	{ $tr="<tr class='table-danger'>"; }
				else if( $onlRatio <  98.00 )	{ $tr="<tr class='table-warning'>"; }
				else if( $onlRatio >= 98.00 )	{ $tr="<tr class='table-success'>"; }
				

				if($found==1){
					echo $tr;
					echo "		<td>$lp</td>";
					echo "		<td>$nodeName</td>";
					echo "		<td>$isAlive</td>";
					echo "		<td>$onlRatioPct</td>";
					echo "		<td>$version</td>";
					echo "		<td>$ip</td>";
					echo "		<td>$addr_trunc</td>";
					echo "	</tr>";
					$lp++;
				}
			}
		} else {
			echo $err_div . "ViteX API unavailable. Sorry!" ."</div><br>";
		}
		#echo "<br><br>";
	#} else {
	#	echo $err_div . "ViteX API unavailable. Sorry!" ."</div><br>";
	#}
	// echo date('h:i:s:u', time()) . ": Filtering data end. <br><br><br>"; 
}

?>

					
				</tbody>
			</table>
		</div>
		<div class="col-md-1">
		</div>
		<div class="col-md-2"></div>
	</div>
	<div class="row" <?php if($addressVerified==0){echo "style='display:none;'";} ?> >
		<div class="col-md-2"></div>
		<div class="col-md-7">
			<br>
			<p style="text-align:center;">
				<strong>Contributions from the community are welcome:</strong><br><br>
VITE:
<a href="https://explorer.vite.net/account/vite_069975f6ec5c08022d406a75f99dbdd849faa66a4ae9d09324" target="_blank">vite_069975f6ec5c08022d406a75f99dbdd849faa66a4ae9d09324</a>
<br>
BTC: 
<a href="https://live.blockcypher.com/btc/address/193rGcGwCXpvGyugpGtHZq6Wehd96Nau7z/" target="_blank">193rGcGwCXpvGyugpGtHZq6Wehd96Nau7z</a>
<br>
LTC: 
<a href="https://live.blockcypher.com/ltc/address/LUxvnS4M7sQ47y2mJtfUu2BAcRGSrmV8sh/" target="_blank">LUxvnS4M7sQ47y2mJtfUu2BAcRGSrmV8sh</a>
<br>
ETH: 
<a href="https://etherscan.io/address/0xbb244f2c9f5F451a0217a31656A8d3c6B58724F7" target="_blank">0xbb244f2c9f5F451a0217a31656A8d3c6B58724F7</a>
<br>
XMR: 
<a href="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=4AcTEs2GK34ZtNu5Ubyp9C3Pf6HujdqFQJA9L5QUfaLzg4p33KBJxHXHDXcZAjXMtY5LjtFNGBmQHjdZ85Yfk7heEJz2LDS" target="_blank">4AcTEs2GK34ZtNu5Ubyp9C3Pf6HujdqFQJA9L5QUfaLzg4p33KBJxHXHDXcZAjXMtY5LjtFNGBmQHjdZ85Yfk7heEJz2LDS</a>
<br>
<br>
			</p>
		</div>
	</div>
	<div class="row"><div class="col-md-12"><h3 class="text-center"><br></h3></div></div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>