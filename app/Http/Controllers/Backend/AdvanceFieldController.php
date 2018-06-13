<?php

namespace App\Http\Controllers\Backend;

use App\Models\AdvanceField;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Session;
use App\Models\SystemLinkType;

class AdvanceFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AdvanceField::all();

        return view('backend.advanceField.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $systemLinkType = SystemLinkType::where('type', 2)->get();
        return view('backend.advanceField.create', [
        	'post_type' => $systemLinkType
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'label' => 'required',
            'key' => 'required|unique:advance_field,key',
        ])->validate();

        $key = new AdvanceField;
        $key->key = str_slug($request['key']);
        $key->label = $request['label'];
        $type = $request['type'];
        $option = $request['rule_type'];
        $operator = $request['rule_equal'];
        $condition = $request['rule_condition'];
        $key->option = '{"input_type" : "'.$type.'", "apply_for" : "'.$option.'", "apply_operator" : "'.$operator.'", "apply_condition" : "'.$condition.'"}';

        if ($key->save())
            return redirect()->route('advanceField.index')->with(['success_message' => 'Your key has been created!']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $key = AdvanceField::findOrFail($id);
        $option = json_decode($key['option']);

        return view('backend.advanceField.update', [
            'data' => $key,
            'option' => $option
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
        $key = AdvanceField::findOrFail($id);

        Validator::make($request->all(), [
            'key' => 'required|unique:advance_field,key,' . $request->segment(3),
            'label' => 'required',
        ])->validate();

        $key->key = str_slug($request['key']);
        $key->label = $request['label'];
        $type = $request['type'];
        $option = $request['rule_type'];
        $operator = $request['rule_equal'];
        $condition = $request['rule_condition'];
        $key->option = '{"input_type" : "'.$type.'", "apply_for" : "'.$option.'", "apply_operator" : "'.$operator.'", "apply_condition" : "'.$condition.'"}';

        if ($key->save())
            return redirect()->route('advanceField.index')->with(['success_message' => 'Your key has been updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $key = AdvanceField::findOrFail($id);

        if ($key->delete()) {
            Session::flash('success_message', 'Your key has been delete!');
        } else {
            Session::flash('error_message', 'Fail to delete key');
        }
        return redirect()->route('advanceField.index');
    }
}
