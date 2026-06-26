@extends('adminlte::page')

@section('title', 'จัดการ Ebook')

@section('content_header')
<div class="d-flex justify-content-between align-items-center mb-2">
    <h4 class="mb-0">
        📚 ระบบจัดการ Ebook
    </h4>

    <a href="{{ route('ebooks.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> เพิ่ม Ebook
    </a>
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

{{-- 📊 STATS --}}
<div class="row">

    <div class="col-md-4 col-12">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $ebooks->count() }}</h3>
                <p>Ebook ทั้งหมด</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-12">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $ebooks->where('status',1)->count() }}</h3>
                <p>พร้อมใช้งาน</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-12">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $ebooks->where('status',0)->count() }}</h3>
                <p>ปิดใช้งาน</p>
            </div>
            <div class="icon">
                <i class="fas fa-times-circle"></i>
            </div>
        </div>
    </div>

</div>

{{-- 🔍 SEARCH --}}
<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('ebooks.index') }}" method="GET">
            <div class="input-group">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-control"
                       placeholder="ค้นหา: ชื่อหนังสือ, ผู้แต่ง, ISBN">

                <div class="input-group-append">
                    <button class="btn btn-success">
                        <i class="fas fa-search"></i>
                        ค้นหา
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>

{{-- 📋 TABLE --}}
<div class="card shadow-sm">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover table-striped mb-0">

                <thead class="bg-light">
                    <tr>
                        <th width="90">ปก</th>
                        <th>ID</th>
                        <th>ชื่อเรื่อง</th>
                        <th>ผู้แต่ง</th>
                        <th>หมวดหมู่</th>
                        <th>ISBN</th>
                        <th>สถานะ</th>
                        <th class="text-center" width="180">การดำเนินการ</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($ebooks as $ebook)

                    <tr>

                        <td>
                            @if($ebook->cover)
                                <img src="{{ asset('storage/'.$ebook->cover) }}"
                                     width="55"
                                     height="75"
                                     class="img-thumbnail"
                                     style="object-fit: cover;">
                            @else
                                <img src="https://via.placeholder.com/55x75?text=No+Cover"
                                     class="img-thumbnail">
                            @endif
                        </td>

                        <td class="align-middle">{{ $ebook->id }}</td>

                        <td class="align-middle">
                            <strong>{{ $ebook->title }}</strong>
                        </td>

                        <td class="align-middle">{{ $ebook->author }}</td>

                        <td class="align-middle">
                            <span class="badge badge-info">
                                {{ $ebook->category->name ?? '-' }}
                            </span>
                        </td>

                        <td class="align-middle">{{ $ebook->isbn ?? '-' }}</td>

                        <td class="align-middle">

                            @if($ebook->status)
                                <span class="badge badge-success">พร้อมใช้งาน</span>
                            @else
                                <span class="badge badge-danger">ปิดใช้งาน</span>
                            @endif

                        </td>

                        <td class="text-center align-middle">

                            <a href="{{ route('ebooks.show',$ebook) }}"
                            class="btn btn-info btn-sm">

                                <i class="fas fa-eye"></i>

                            </a>

                            @if(Auth::user()->role == 'admin')

                                <a href="{{ route('ebooks.edit',$ebook) }}"
                                class="btn btn-warning btn-sm">

                                    <i class="fas fa-edit"></i>

                                </a>

                            @else

                                @if($ebook->status)

                                    <form action="{{ route('ebooks.borrow',$ebook) }}"
                                        method="POST">

                                        @csrf

                                        <button class="btn btn-primary btn-sm">

                                            <i class="fas fa-book-reader"></i>

                                            ยืม

                                        </button>

                                    </form>

                                @else

                                    <button class="btn btn-secondary btn-sm" disabled>

                                        ปิดใช้งาน

                                    </button>

                                @endif

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            ยังไม่มีข้อมูล Ebook
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<div class="mt-3 d-flex justify-content-center">
    {{ $ebooks->links() }}
</div>

@stop
