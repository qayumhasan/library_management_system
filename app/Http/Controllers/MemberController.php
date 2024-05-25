<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;
use App\Models\Member;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Member::select('id','first_name','last_name','phone_number','email','registration_date')->get();
        return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberRequest $request)
    {
        $member = new Member;
        $member->first_name = $request->input('first_name');
        $member->last_name = $request->input('last_name');
        $member->phone_number = $request->input('phone_number');
        $member->email = $request->input('email');
        $member->registration_date = $request->input('registration_date');
        if($member->save()){
            return response()->json(['message' => 'Member Created successfully'], 201);
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberRequest $request, string $id)
    {
        $member = Member::findOrFail($id);
        $member->first_name = $request->input('first_name');
        $member->last_name = $request->input('last_name');
        $member->phone_number = $request->input('phone_number');
        $member->email = $request->input('email');
        $member->registration_date = $request->input('registration_date');
        if($member->save()){
            return response()->json(['message' => 'Member Updated successfully'], 201);
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }
        $member->delete();
        return response()->json(['message' => 'Member Removed successfully'], 200);
    }
}
