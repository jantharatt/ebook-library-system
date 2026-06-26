<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Ebook;
use App\Models\BorrowPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
public function index()
{
    if(Auth::user()->role == 'admin')
    {
        $borrows = Borrow::with([
            'user',
            'ebook'
        ])->latest()->get();
    }
    else
    {
        $borrows = Borrow::with([
            'user',
            'ebook'
        ])
        ->where(
            'user_id',
            Auth::id()
        )
        ->latest()
        ->get();
    }

    return view(
        'borrows.index',
        compact('borrows')
    );
}

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Borrow $borrow)
    {
        //
    }

    public function edit(Borrow $borrow)
    {
        //
    }

    public function update(Request $request, Borrow $borrow)
    {
        //
    }

    public function destroy(Borrow $borrow)
    {
        //
    }

    public function borrow(Ebook $ebook)
    {
        $user = Auth::user();

        $policy = BorrowPolicy::where(
            'role',
            $user->role
        )->first();

        if (!$policy) {

            return back()->with(
                'error',
                'ไม่พบนโยบายการยืม'
            );
        }

        // ตรวจสอบว่ายืมเล่มนี้อยู่แล้วหรือไม่
        $alreadyBorrowed = Borrow::where(
            'user_id',
            $user->id
        )
        ->where(
            'ebook_id',
            $ebook->id
        )
        ->where(
            'status',
            'borrowed'
        )
        ->exists();

        if ($alreadyBorrowed) {

            return back()->with(
                'error',
                'คุณยืม Ebook เล่มนี้อยู่แล้ว'
            );
        }

        // ตรวจสอบจำนวนหนังสือที่ยืมอยู่
        $currentBorrows = Borrow::where(
            'user_id',
            $user->id
        )
        ->where(
            'status',
            'borrowed'
        )
        ->count();

        if ($currentBorrows >= $policy->max_books) {

            return back()->with(
                'error',
                'คุณยืมครบจำนวนที่กำหนดแล้ว'
            );
        }

        Borrow::create([

            'user_id' => $user->id,

            'ebook_id' => $ebook->id,

            'borrow_date' => now(),

            'due_date' => now()->addDays(
                $policy->borrow_days
            ),

            'status' => 'borrowed',
        ]);

        return back()->with(
            'success',
            'ยืม Ebook สำเร็จ'
        );
    }

    public function returnBook(Borrow $borrow)
{
    $borrow->update([

        'status' => 'returned'

    ]);

    return back()->with(
        'success',
        'คืน Ebook สำเร็จ'
    );
}
}
