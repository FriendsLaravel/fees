<?php

namespace Fol\Fees\Http\Controllers;

use Fol\Fees\DataTables\FeesDataTable;
use Fol\Fees\Models\Fees;
use Fol\Fees\Models\FeesRule;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FeesDataTable $dataTable)
    {
        return  $dataTable->render('fees::index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'code' => 'required',
            'amount' => 'required|integer',
            'position' => 'required|integer',
        ]);


        $fees =  Fees::create($data);

        foreach ($request->rules as $rule) {
            FeesRule::create([
                'fees_id' => $fees->id,
                'type'=>$rule['type'],
                'configuration'=> $rule['configuration']
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fees  $fees
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fees = Fees::with('rules')->findOrFail($id);
        unset($fees->status);
        return $fees;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Fol\Fees\Models\Fees  $fees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fees = Fees::findOrFail($id);
        if($request->status){
            $fees->status  = ! $fees->status;
            $fees->save();
            return $fees;
        }

        $data = $this->validate($request, [
            'code' => 'required',
            'amount' => 'required|integer',
            'position' => 'required|integer',
        ]);
        $fees->update($data);

        $fees_rules_ids = [];
        foreach ($request->rules as $rule) {
            $fees_rule = FeesRule::updateOrCreate(['id'=>isset($rule['id'])?$rule['id']:null],[
                'fees_id' => $fees->id,
                'type'=>$rule['type'],
                'configuration'=> $rule['configuration']
            ]);
            $fees_rules_ids[] = $fees_rule->id;
        }
        FeesRule::whereNotIn('id',$fees_rules_ids)->delete();
        return $fees;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Fol\Fees\Models\Fees  $fees
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fees = Fees::findOrFail($id);
        return $fees->delete();
    }
}
