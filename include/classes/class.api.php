<?php


//class for login section


class api extends general
{
	
	function __construct($con)
	{
		parent::__construct($con);
	}

	//fund wallet
	public function fundWallet($newamount)
	{
		// $customer_email = "emereuwaonueze@gmail.com";//gets user email from db...but for the sake of this test....we are using my email
		// $amount = $newamount;  
		// $currency = "NGN";
		// $txref = "rave-".time(); // ensure you generate unique references per transaction.
		// $secretKey = $_ENV['SECRET_KEY'];
		// $env = $_ENV['ENV'];
		// $PBFPubKey = $_ENV['PUBLIC_KEY']; // we are suppose to pull from a table in our db name eg: "api-key". dont paste ur keys like this. but for the sake of this test, we will be doing the paste. 
		// $redirect_url = "http://localhost/demo/simplepayroll/dashboard/confirm-transaction.php";
		// $payment_plan = ""; // this is only required for recurring payments.

		// $array_options = array(
		// 	'amount'=>$amount,
		// 	'customer_email'=>$customer_email,
		// 	'currency'=>$currency,
		// 	'txref'=>$txref,
		// 	'PBFPubKey'=>$PBFPubKey,
		// 	'redirect_url'=>$redirect_url,
		// 	'payment_plan'=>$payment_plan
		// );

		// $pay = new Pay();
		// $result = $pay->pay($PBFPubKey, $secretKey,$env,$array_options);

		// $transaction = json_decode($result);

		// if(!$transaction->data && !$transaction->data->link){
		// 	// there was an error from the API
		// 	print_r('API returned error: ' . $transaction->message);
		// }
		
		// // uncomment out this line if you want to redirect the user to the payment page
		// //print_r($transaction->data->message);
		
		
		// // redirect to page so User can pay
		// // uncomment this line to allow the user redirect to the payment page
		// header('Location: ' . $transaction->data->link);
	}

	//get supported banks
	public function getBanks()
	{
		$curl = curl_init();
		$base_url = "https://ravesandboxapi.flutterwave.com/banks";
		$header = array(
		  	"Content-Type: application/json",
		);
		$query = "?country=NG";//pss NG, GH, KE

		curl_setopt_array($curl, array(
		  	CURLOPT_URL => $base_url . $query,
		  	CURLOPT_CUSTOMREQUEST => "GET",
		  	CURLOPT_RETURNTRANSFER => true,
		  	CURLOPT_MAXREDIRS => 10,
		  	CURLOPT_TIMEOUT => 180,
		  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  	CURLOPT_HTTPHEADER => $header,
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);

		if ($err) {
		  	echo "cURL Error #:" . $err;
		} else {
		  	$decodedResponse = json_decode($response, true);
		  	$banks = $decodedResponse['data'];
		}

		//print_r($banks);
		return $banks;
	}

	//get supported banks name
	public function getBankName($bankcode)
	{
		$curl = curl_init();
		$base_url = "https://ravesandboxapi.flutterwave.com/banks";
		$header = array(
		  	"Content-Type: application/json",
		);
		$query = "?country=NG";//pss NG, GH, KE

		curl_setopt_array($curl, array(
		  	CURLOPT_URL => $base_url . $query,
		  	CURLOPT_CUSTOMREQUEST => "GET",
		  	CURLOPT_RETURNTRANSFER => true,
		  	CURLOPT_MAXREDIRS => 10,
		  	CURLOPT_TIMEOUT => 180,
		  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  	CURLOPT_HTTPHEADER => $header,
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);

		if ($err) {
		  	echo "cURL Error #:" . $err;
		} else {
		  	$decodedResponse = json_decode($response, true);
		  	$banks = $decodedResponse['data'];
		}

		$bankname = "BANK NOT FOUND";

		foreach ($banks as $bank) {
			if ($bank['code'] == $bankcode) {
				$bankname = $bank['name'];
			}
		}

		//print_r($banks);
		// return $banks;
		return $bankname;
	}

	//single transfer
	public function singleTransfer($bankcode, $accountno, $amount, $narration)
	{
		
	}


}
?>