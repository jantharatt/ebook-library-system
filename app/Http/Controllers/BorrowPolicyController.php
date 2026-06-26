<?php

namespace App\Http\Controllers;

use App\Models\BorrowPolicy;
use Illuminate\Http\Request;

class BorrowPolicyController extends Controller
{
    public function index()
    {
        $policies = BorrowPolicy::all();

        return view('borrow-policies.index', compact('policies'));
    }

    public function create()
    {
        return view('borrow-policies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|unique:borrow_policies',
            'max_books' => 'required|integer|min:1',
            'borrow_days' => 'required|integer|min:1',
        ]);

        BorrowPolicy::create([
            'role' => $request->role,
            'max_books' => $request->max_books,
            'borrow_days' => $request->borrow_days,
            'active' => true,
        ]);

        return redirect()
            ->route('borrow-policies.index')
            ->with('success', 'บันทึกนโยบายสำเร็จ');
    }


    /**
     * Display the specified resource.
     */
    public function show(BorrowPolicy $borrowPolicy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BorrowPolicy $borrowPolicy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BorrowPolicy $borrowPolicy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BorrowPolicy $borrowPolicy)
    {
        //
    }
}
