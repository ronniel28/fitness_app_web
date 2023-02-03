<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;

class Helper
{
    public function FitnessAppApiCall($method, $segment, $parameter= [], $headers = false)
	{
		$url =  env('API_URL_LOCAL');
		// var_dump(session()->get('userToken'));
		try {
			$client = new Client();
			if ($headers) {
				if($method == 'get') {
					$headers = [
						'headers' => [
							'Authorization' => 'Bearer ' .session()->get('userToken'),
							'Accept' => 'application/json'
						],
						'query' =>  $parameter
					];
				} else {
					$headers = [
						'headers' => [
							'Authorization' => 'Bearer ' .session()->get('userToken'),
							'Accept' => 'application/json',
						]
					];
					
					if($segment == 'uploadProfilePicture' || $segment == 'uploadValidation'){
						$i = 0;
						
						foreach($parameter as $key => $param){
							$headers['multipart'][$i]['name'] = $key;

							if(is_object($param)){
								$headers['multipart'][$i]['filename'] = $param->getClientOriginalName();
								$headers['multipart'][$i]['Mime-Type'] = $param->getmimeType();
								$headers['multipart'][$i]['contents'] = fopen( $param->getPathname(), 'r' );
							}else{
								$headers['multipart'][$i]['contents'] = $param;
							}
							
							$i++;
						}
						// $headers['multipart']['name'] = $parameter;
						// $headers['form_params'] = $parameter;
					}else{
						$headers['form_params'] = $parameter;
					}
					// dd($headers);
				}
			} else {
				if($method == 'get') {
					$headers = [
						'headers' => [
							'Accept' => 'application/json'
						],
						'query' =>  $parameter
					];
				} else {
					$headers = [
						'form_params' =>  $parameter
					];
				}
				
			}

			$res = $client->request($method, $url.$segment, $headers);
			// dd($res);
			// var_dump(json_decode($res->getBody()->getContents(), true));
			return json_decode($res->getBody()->getContents(), true);
		}catch (\GuzzleHttp\Exception\RequestException $e) {
			$response = $e->getResponse();
			$jsonBody = (string) $response->getBody();
			return $jsonBody;
		}
	}

	public function ordinal($number) {
		$ends = array('th','st','nd','rd','th','th','th','th','th','th');
		if ((($number % 100) >= 11) && (($number%100) <= 13))
			return $number. 'th';
		else
			return $number. $ends[$number % 10];
	}
}