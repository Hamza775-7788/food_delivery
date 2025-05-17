<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "folder" => 'required|string',
            "file" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',

        ]);

        if ($request->hasFile("file")) {
            $url = $request->file("file")->store($request->folder, "public");
            return json_encode(['status' => true, "data" => $url]);
        } else {
            return response()->json(['status' => false, "message" => "no image"]);
        }
    }
}
