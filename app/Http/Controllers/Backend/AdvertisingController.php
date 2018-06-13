<?php

namespace App\Http\Controllers\Backend;

use App\Models\Advertising;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdvertisingController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function index()
	{
		$ads = Advertising::select(['id', 'name', 'code', 'is_mobile', 'location'])->get();
		return view('backend.advertising.index', [
			'ads' => $ads
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('backend.advertising.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$rules = [
			'code' => 'required',
			'location' => 'required|unique:advertising,location',
		];

		$this->validate($request, $rules);

		$data = $request->all();

		if ($post = Advertising::create($data)) {
			return redirect()->route('advertising.index')->with(['success_message' => 'Your ads has been created!']);
		}

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$ads = Advertising::findOrFail($id);

		return view('backend.advertising.update', [
			'ads' => $ads,
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$rules = [
			'code' => 'required'
		];
		$this->validate($request, $rules);

		$data = $request->all();

		$ads = Advertising::findOrFail($id);

		if ($ads->update($data)) {
			return redirect()->route('advertising.index')->with(['success_message' => 'Your ads has been updated!']);
		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$ads = Advertising::findOrFail($id);

		if ($ads->delete()) {
			Session::flash('success_message', 'Your ads has been delete!');
		} else {
			Session::flash('error_message', 'Fail to delete ads');
		}
		return redirect()->route('advertising.index');
	}
}
