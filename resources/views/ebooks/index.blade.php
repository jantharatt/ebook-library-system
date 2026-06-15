@extends('adminlte::page')

@section('title', 'Ebooks')

@section('content_header')
    <h1>จัดการ Ebook</h1>
@stop

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">

    <div class="card-header">
        <a href="{{ route('ebooks.create') }}" class="btn btn-primary">
            เพิ่ม Ebook
        </a>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>ชื่อเรื่อง</th>
                    <th>ผู้แต่ง</th>
                    <th>หมวดหมู่</th>
                    <th>ISBN</th>
                    <th>สถานะ</th>
                </tr>
            </thead>

            <tbody>

                @forelse($ebooks as $ebook)

                <tr>
                    <td>{{ $ebook->id }}</td>

                    <td>{{ $ebook->title }}</td>

                    <td>{{ $ebook->author }}</td>

                    <td>{{ $ebook->category->name ?? '-' }}</td>

                    <td>{{ $ebook->isbn ?? '-' }}</td>

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

                @empty

                <tr>
                    <td colspan="6" class="text-center">
                        ยังไม่มีข้อมูล Ebook
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop