<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Borrow;
use Illuminate\Support\Facades\Auth;

class EbookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $ebooks = Ebook::with('category')
            ->when($search, function ($query) use ($search) {

                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('isbn', 'like', "%{$search}%")
                    ->orWhere('keywords', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view(
            'ebooks.index',
            compact(
                'ebooks',
                'search'
            )
        );
    }

    public function create()
    {
        $categories = Category::where(
            'status',
            true
        )->get();

        return view(
            'ebooks.create',
            compact('categories')
        );
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
        ], [
            'publish_year.between' =>
                'กรุณาระบุปีพิมพ์เป็น ค.ศ. เช่น 2025 ไม่ใช่ พ.ศ. 2568'
        ]);

        $pdfPath = $request->file('pdf_file')
            ->store(
                'ebooks',
                'public'
            );

        $previewPath = null;

        $coverPath = null;

        if ($request->hasFile('cover')) {

            $coverPath = $request->file('cover')
                ->store(
                    'covers',
                    'public'
                );
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
            'preview_file' => $previewPath,
            'total_pages' => $request->total_pages ?? 0,
            'status' => $request->status ?? true,
        ]);

        return redirect()
            ->route('ebooks.index')
            ->with(
                'success',
                'เพิ่ม Ebook สำเร็จ'
            );
    }

    public function show(Ebook $ebook)
    {
        return view(
            'ebooks.show',
            compact('ebook')
        );
    }

    public function edit(Ebook $ebook)
    {
        //
    }

    public function update(
        Request $request,
        Ebook $ebook
    ) {
        //
    }

    public function destroy(Ebook $ebook)
    {
        //
    }

    public function preview(Ebook $ebook)
    {
        if (!$ebook->preview_file) {

            return back()->with(
                'error',
                'ยังไม่มีไฟล์ตัวอย่าง'
            );
        }

        return response()->file(
            storage_path(
                'app/public/' .
                $ebook->preview_file
            ),
            [
                'Content-Disposition' => 'inline'
            ]
        );
    }

    public function read(Ebook $ebook)
    {
        $borrowed = Borrow::where(
            'user_id',
            Auth::id()
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

        if (
            !$borrowed &&
            Auth::user()->role != 'admin'
        ) {

            return redirect()
                ->route(
                    'ebooks.show',
                    $ebook
                )
                ->with(
                    'error',
                    'กรุณายืม Ebook ก่อนอ่านฉบับเต็ม'
                );
        }

        return response()->file(
            storage_path(
                'app/public/' .
                $ebook->file_path
            ),
            [
                'Content-Disposition' => 'inline'
            ]
        );
    }
}

