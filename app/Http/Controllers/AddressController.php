<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
            "address" => 'required|string'
        ]);

        $address =  Address::create([
            "address" => $request->address,
            "user_id" => Auth::user()->id,
        ]);

        return  response()->json(['status' => true, "address" => $address]);
    }

    public function show(Request $request)
    {

        $address = Address::where("user_id", Auth::user()->id)->get();

        return   response()->json(['status' => true, "data" => $address]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "address" => 'required|string'
        ]);

        $address = Address::where("id", $id)->first();
        $address->update([
            'address' => $request->address,
        ]);

        return response()->json(['status', true, "data" => $address]);
    }
    public function destroy(Request $request, $id)
    {

        $address = Address::where("id", $id)->first();
        $address->delete();

        return response()->json(['status', true]);
    }
}
