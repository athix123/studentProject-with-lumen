<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use GrahamCampbell\Flysystem\Facades\Flysystem;

class DoesBoxController extends Controller
{

	public function upload(Request $request) {
	
		$box = 'https://doesbox.herokuapp.com/v1/upload';

		$name = $request->input('name');

		if($request->hasFile('images')) {

			$images = $request->file('images');

			$client = new \GuzzleHttp\Client([
				'Content-Type' => 'application/json'
			]);


			$response = $client->request('POST', $box, [
				'headers' => [
				],
					'multipart' => [
				[
					'name'     => 'images',
					'contents' => file_get_contents($request->file('images')),
					'filename' => 'name.png'
				],
				[
					'name'     => 'name',
					'contents' => $name
				]
					],
			]);

			return response()->json(json_decode(($response->getBody()->getContents())));
		}
	}
}

