@extends('adminlte::page')

@section('title', 'ประวัติการยืม')

@section('content_header')

<div class="d-flex justify-content-between align-items-center">

    <h4 class="mb-0">
        📚 ประวัติการยืม Ebook
    </h4>

</div>

@stop

@section('content')

@if(session('success'))

<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))

<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="row mb-3">

    <div class="col-md-4 col-12">

        <div class="small-box bg-primary">

            <div class="inner">
                <h3>{{ $borrows->count() }}</h3>
                <p>รายการทั้งหมด</p>
            </div>

            <div class="icon">
                <i class="fas fa-book-reader"></i>
            </div>

        </div>

    </div>

    <div class="col-md-4 col-12">

        <div class="small-box bg-warning">

            <div class="inner">
                <h3>{{ $borrows->where('status','borrowed')->count() }}</h3>
                <p>กำลังยืม</p>
            </div>

            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>

        </div>

    </div>

    <div class="col-md-4 col-12">

        <div class="small-box bg-success">

            <div class="inner">
                <h3>{{ $borrows->where('status','returned')->count() }}</h3>
                <p>คืนแล้ว</p>
            </div>

            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>

        </div>

    </div>

</div>

<div class="card-body">
    <div class="card-header bg-white">

    <h5 class="mb-0">
        📋 รายการยืม Ebook
    </h5>

</div>

    <table class="table table-hover table-striped mb-0">
        <thead class="bg-light">
            <tr>
                <th>ID</th>
                <th>ผู้ใช้</th>
                <th>หนังสือ</th>
                <th>วันยืม</th>
                <th>กำหนดคืน</th>
                <th>สถานะ</th>
                <th>จัดการ</th>
            </tr>
        </thead>

        <tbody>

        @forelse($borrows as $borrow)

            <tr>

                <td>{{ $borrow->id }}</td>

                <td>{{ $borrow->user->name }}</td>

                <td>{{ $borrow->ebook->title }}</td>

                <td>
                    {{ \Carbon\Carbon::parse($borrow->borrow_date)->format('d/m/Y') }}
                </td>

                <td>
                    {{ \Carbon\Carbon::parse($borrow->due_date)->format('d/m/Y') }}
                </td>

                <td>

                    @if($borrow->status == 'borrowed')

                        <span class="badge badge-warning">
                            กำลังยืม
                        </span>

                    @elseif($borrow->status == 'returned')

                        <span class="badge badge-success">
                            คืนแล้ว
                        </span>

                    @else

                        <span class="badge badge-danger">
                            เกินกำหนด
                        </span>

                    @endif

                </td>

                <td>

                    @if($borrow->status == 'borrowed')

                    <form
                        action="{{ route('borrows.return',$borrow) }}"
                        method="POST">

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-outline-danger btn-sm">

                            คืน Ebook

                        </button>

                    </form>

                    @else



                    @endif

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="7" class="text-center">
                    ยังไม่มีรายการยืม
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@stop
