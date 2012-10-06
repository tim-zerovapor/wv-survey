<?php

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 * 
 * @package  app
 * @extends  Controller
 */
class Controller_Welcome extends Controller
{

	/**
	 * The basic welcome message
	 * 
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{

		$curl = curl_init('https://zerovapor.wufoo.com/api/v3/forms/m7p6r7/entries.json');       //1
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);                          //2
		curl_setopt($curl, CURLOPT_USERPWD, '8QKN-E20E-6769-MKOI:footastic');   //3
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_ANY);                     //4
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);                          
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);                           
		curl_setopt($curl, CURLOPT_USERAGENT, 'Getting Entries');             //5

		$response = curl_exec($curl);                                           //6
		$resultStatus = curl_getinfo($curl);                                    //7

		if($resultStatus['http_code'] == 200) {                     //8
		    $data['entry'] =  $response;
		} else {
		    echo 'Call Failed '.print_r($resultStatus);                         //9
		}



		$this->see($response);

		return Response::forge(View::forge('welcome/index',$data));
	}

	/**
	 * A typical "Hello, Bob!" type example.  This uses a ViewModel to
	 * show how to use them.
	 * 
	 * @access  public
	 * @return  Response
	 */
	public function action_hello()
	{
		return Response::forge(ViewModel::forge('welcome/hello'));
	}

	/**
	 * The 404 action for the application.
	 * 
	 * @access  public
	 * @return  Response
	 */
	public function action_404()
	{
		return Response::forge(ViewModel::forge('welcome/404'), 404);
	}


	private function see($e){

		echo "<pre>";
		print_r($e);
		echo "</pre>";
	}

}
