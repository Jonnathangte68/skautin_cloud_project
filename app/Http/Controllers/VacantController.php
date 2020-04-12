<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Enterprise;
use App\Repositories\Vacant;
use App\Repositories\Data;
use App\Repositories\Data2;

class VacantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $ep = new Enterprise;
        $dt = new Data;
        $dt2 = new Data2;
        $empresa = $ep->getEnterprise();
        array_push($data, $empresa);
        array_push($data, $dt->getCategories());
        array_push($data, $dt->getSubCategories());
        array_push($data, $dt->getLevels());
        array_push($data, $dt2->getJobTypes());
        array_push($data, $dt->getCountries());
        array_push($data, $dt->getStates());
        array_push($data, $dt->getCities());
        return view('vacant.vacant_create')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = new Vacant();
        $request->validate([
            'name' => 'bail|required',
            'title' => 'bail|required',
            'description' => 'bail|required',
            'category' => 'bail|required',
            'subcategory' => 'bail|required',
            'country' => 'bail|required',
            'state' => 'bail|required',
            'city' => 'bail|required',
            'level' => 'bail|required'
        ]);
        $v->addNewVacant($request->name,$request->title,$request->description,$request->requirements,$request->imagen,$request->category,$request->subcategory,$request->job_type,$request->level, $request->city, $request->state, $request->country);
        if (!is_null($v)) {$request->session()->flash('suc', 'New Vacant added');}
        else {$request->session()->flash('status', 'Sorry, Job could not be added');}
        return redirect('/manage-vacants');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
