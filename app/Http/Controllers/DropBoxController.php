<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use GrahamCampbell\Flysystem\Facades\Flysystem;

class DropBoxController extends Controller
{

	public function testFile(Request $request) {
	
		return response()->json("haloo");
	}

	public function upload(Request $request) {
	
		$src = $request->file('file');
		$fileName = $src->getClientOriginalName();

		$upload = Flysystem::connection('dropbox')->put($fileName, file_get_contents($src));

		if($upload){
			return response()->json("crot");
		} else {
			return response()->json("zonk");
		}

	}
}

