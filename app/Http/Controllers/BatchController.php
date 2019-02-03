<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Batch;
use App\AddressVerification;
use Auth;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $batches = Batch::all();
        $isOrderPLaced = false;
        $current_user = Auth::user()->id;
        return view('batches/batches')->with('batches', $batches)->with('current_user', $current_user)->with('isOrderPlaced',$isOrderPLaced );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('batches/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        


        $current_user = Auth::user()->id;
        //
        $batch = new Batch;
        $batch -> status = "Order placed";
        $batch ->price = 200;
        $batch -> c_id = $current_user;
        $batch -> comments = "Order recieved: Team Electrum";
        $batch->save();

 
        for($i = 0; $i < sizeof($_POST["age"]);$i++)
        {
            
                $av = new AddressVerification;
                $av->first_name = $_POST["first_name"][$i];
                $av->last_name = $_POST["last_name"][$i];
                $av->age = $_POST["age"][$i];
                $av->status = "Processing";
                $av->comments = "Order Placed";
                $av->b_id = $batch->id;
                $av->image = $_POST["image"][$i];
                $av->save();


        }

        
        

        $orderNo = $batch->id;
        return redirect('/success')->with('orderNo', $orderNo);

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
