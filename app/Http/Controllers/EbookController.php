<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class EbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index()
    {
        $ebooks = Ebook::with('category')
            ->latest()
            ->get();

        return view('ebooks.index', compact('ebooks'));
    }

    public function create()
    {
        $categories = Category::where('status', true)->get();

        return view('ebooks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'category_id' => 'required',
            'pdf_file' => 'required|mimes:pdf|max:51200',
            'cover' => 'nullable|image|max:2048',

            'publish_year' => [
            'nullable',
            'integer',
            'between:1901,2155'
        ],
    ],[
        'publish_year.between' =>
            'กรุณาระบุปีพิมพ์เป็น ค.ศ. เช่น 2025 ไม่ใช่ พ.ศ. 2568'

        ]);

        $pdfPath = $request->file('pdf_file')
            ->store('ebooks', 'public');

        $coverPath = null;

        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')
                ->store('covers', 'public');
        }
        

        $publishYear = $request->publish_year;

        if ($publishYear && $publishYear > 2400) {
            $publishYear = $publishYear - 543;
}
        Ebook::create([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'publisher' => $request->publisher,
            'publish_year' => $publishYear,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'keywords' => $request->keywords,
            'cover' => $coverPath,
            'file_path' => $pdfPath,
            'total_pages' => $request->total_pages ?? 0,
            'status' => $request->status ?? true,
        ]);

        return redirect()
            ->route('ebooks.index')
            ->with('success', 'เพิ่ม Ebook สำเร็จ');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ebook $ebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ebook $ebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ebook $ebook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ebook $ebook)
    {
        //
    }
}
