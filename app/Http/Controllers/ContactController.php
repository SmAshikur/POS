<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
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
        return view('barcode');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request,[
            'name'=>'required|unique:contacts,name',
            'mobile'=>'required',
            'image'=>'image',
        ]);

        $contact = new Contact();
        $contact->real_name=$request->name;
        $contact->type=$request->type;
        $contact->mobile=$request->mobile;
        $contact->name=$request->name . ' ( ' . $request->mobile . ' )' ;
        $contact->address=$request->address;

        $contact->save();
       // dd($contact);
        return redirect()->back()->with('message','New Contact Added Successfully');
        return response()->json($contact);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dew = Contact::with('dewPurchase','dewSell','dewReturn','dewBack')->findOrFail($id);
        return response()->json($dew);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $dew = Contact::find($id);
        // if($request->newDew>0){
        //     $dew->amount=$request->newDew;
        //     $dew->save();
        //     return redirect()->back()->with('message','Dew Update Successfully');
        // }else{
        //     $dew->amount=$request->newDew;
        //     $dew->status=1;
        //     $dew->save();
        //     return redirect()->back()->with('message','Dew Update Successfully');
        // }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
