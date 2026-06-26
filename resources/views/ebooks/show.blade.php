@extends('adminlte::page')

@section('title','รายละเอียด Ebook')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h4 class="mb-0">
        📚 รายละเอียด Ebook
    </h4>

    <a href="{{ route('ebooks.index') }}"
       class="btn btn-secondary btn-sm">

        <i class="fas fa-arrow-left"></i>

        กลับ

    </a>

</div>

@stop

@section('content')

<div class="card shadow-sm">

    <div class="card-body">

        <div class="row">

            <div class="col-md-3 text-center">

                @if($ebook->cover)

                    <img src="{{ asset('storage/'.$ebook->cover) }}"
                         class="img-fluid rounded shadow">

                @else

                    <img src="https://via.placeholder.com/250x350"
                         class="img-fluid rounded shadow">

                @endif

            </div>

            <div class="col-md-9">

                <table class="table table-bordered">

                    <tr>
                        <th width="200">ชื่อหนังสือ</th>
                        <td>{{ $ebook->title }}</td>
                    </tr>

                    <tr>
                        <th>ผู้แต่ง</th>
                        <td>{{ $ebook->author }}</td>
                    </tr>

                    <tr>
                        <th>ISBN</th>
                        <td>{{ $ebook->isbn ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>หมวดหมู่</th>
                        <td>{{ $ebook->category->name ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>สำนักพิมพ์</th>
                        <td>{{ $ebook->publisher ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>ปีพิมพ์</th>
                        <td>{{ $ebook->publish_year ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>จำนวนหน้า</th>
                        <td>{{ $ebook->total_pages ?? 0 }}</td>
                    </tr>

                    <tr>
                        <th>คำสำคัญ</th>
                        <td>{{ $ebook->keywords ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>รายละเอียด</th>
                        <td>{{ $ebook->description ?? '-' }}</td>
                    </tr>

                    <tr>
                        <th>สถานะ</th>

                        <td>

                            @if($ebook->status)

                                <span class="badge badge-success">
                                    พร้อมใช้งาน
                                </span>

                            @else

                                <span class="badge badge-danger">
                                    ปิดใช้งาน
                                </span>

                            @endif

                        </td>

                    </tr>

                </table>

        @if(Auth::user()->role != 'admin')


            @if($ebook->status)

                <a href="{{ route('ebooks.preview',$ebook) }}"
                target="_blank"
                class="btn btn-info">

                    <i class="fas fa-eye"></i>
                    อ่านตัวอย่าง 5 หน้า

                </a>

                <form action="{{ route('ebooks.borrow',$ebook) }}"
                    method="POST"
                    class="d-inline">

                    @csrf

                    <button class="btn btn-primary">

                        <i class="fas fa-book-reader"></i>
                        ยืม Ebook

                    </button>

                </form>

                @php
                    $borrowed = \App\Models\Borrow::where('user_id',Auth::id())
                        ->where('ebook_id',$ebook->id)
                        ->where('status','borrowed')
                        ->exists();
                @endphp

                @if($borrowed)

                    <a href="{{ route('ebooks.read',$ebook) }}"
                    target="_blank"
                    class="btn btn-success">

                        <i class="fas fa-book-open"></i>
                        อ่านฉบับเต็ม

                    </a>

                @endif

            @endif


        @endif



            </div>

        </div>

    </div>

</div>

@stop
