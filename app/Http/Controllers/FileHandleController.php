<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class FileHandleController extends Controller {

	/**
	 * File dashboard
	 * @param request
	 * @return page titles
	 */
	public function index() {
		//
		$data['page_tite'] = 'File handling';
		return view('file_handle_form')->with($data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		try {
			if (!Storage::exists("uploads/file")) {
				Storage::disk("public")->makeDirectory('uplaods/file');
			}
			$file_content = [];
			$fileName     = 'uploads/file/' . 'file.json';
			if (Storage::disk('public')->exists($fileName)) {
				$file_exist     = \Storage::disk('public')->get($fileName);
				$file_content[] = json_decode($file_exist, true);
			}

			$random_id               = 'UN' . rand(11111, 99999);
			$file_data               = $request->all();
			$file_data['unique_id']  = $random_id;
			$file_data['created_at'] = date('d-m-Y');
			$file_content[]          = $file_data;

			$fileName = "uploads/file/" . "file.json";
			$put      = Storage::disk('public')->put($fileName, json_encode($file_content, null, 4), 0777);
			$get      = json_decode(\Storage::disk('public')->get($fileName));

			$data['message'] = 'Data added successfully.';
			return response($data, 200);
		} catch (\Exception$e) {
			$data['data']    = [];
			$data['message'] = $e->getMessage();
			return response($data, 500);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param
	 * @return \Illuminate\Http\Response
	 */
	public function list() {
		try {
			$get      = [];
			$fileName = 'uploads/file/' . 'file.json';
			if (Storage::disk('public')->exists($fileName)) {
				$s   = \Storage::disk('public')->get($fileName);
				$get = json_decode($s);
			}

			$data['files']   = $get;
			$data['message'] = 'Data listed successfully.';
			return response($data, 200);
		} catch (\Exception$e) {
			$data['data']    = [];
			$data['message'] = $e->getMessage();
			return response($data, 500);
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Request $request) {
		try {
			$id       = $request->edit_id;
			$fileName = 'uploads/file/' . 'file.json';
			if (Storage::disk('public')->exists($fileName)) {
				$s        = \Storage::disk('public')->get($fileName);
				$get      = json_decode($s);
				$finalArr = [];
				foreach ($get as $eachTags) {
					if ($eachTags->unique_id == $id) {
						$finalArr = $eachTags;
					}
				}
				$data['files']   = $finalArr;
				$data['message'] = 'success';
				return response($data, 200);
			}
		} catch (\Exception$e) {
			$data['data']    = [];
			$data['message'] = $e->getMessage();
			return response($data, 500);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request) {
		$id                       = $request->hiddenIds;
		$attributes               = $request->all();
		$attributes['unique_id']  = $id;
		$attributes['created_at'] = NOW();
		unset($attributes['hiddenIds']);

		$fileName = 'uploads/file/' . 'file.json';
		if (Storage::disk('public')->exists($fileName)) {
			$s        = \Storage::disk('public')->get($fileName);
			$get      = json_decode($s);
			$finalArr = [];
			foreach ($get as $eachTags) {
				if ($eachTags->unique_id == $id) {
					$finalArr[] = $attributes;
				} else {
					$finalArr[] = $eachTags;
				}
			}
		}
		$put = Storage::disk('public')->put($fileName, json_encode($finalArr, null, 4), 0777);
		$get = json_decode(\Storage::disk('public')->get($fileName));

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function remove(Request $request) {
		$delete_id = $request->delete_id;
		$fileName  = 'uploads/file/' . 'file.json';
		if (Storage::disk('public')->exists($fileName)) {
			$s        = \Storage::disk('public')->get($fileName);
			$get      = json_decode($s);
			$finalArr = [];
			foreach ($get as $eachTags) {
				if ($eachTags->unique_id != $delete_id) {
					$finalArr[] = $eachTags;
				}
			}
		}
		$put = Storage::disk('public')->put($fileName, json_encode($finalArr, null, 4), 0777);
		$get = json_decode(\Storage::disk('public')->get($fileName));

	}
}
