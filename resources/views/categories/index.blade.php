@extends('adminlte::page')

@section('title', 'Categories')

@section('content_header')
<h1>จัดการหมวดหมู่หนังสือ</h1>
@stop

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">

    <div class="card-header">

        <form action="{{ route('categories.store') }}" method="POST">

            @csrf

            <div class="row">
                <div class="col-md-2">
    <input type="text"
           name="code"
           class="form-control"
           placeholder="000"
           maxlength="3"
           required>
</div>

<div class="col-md-4">
    <input type="text"
           name="name"
           class="form-control"
           placeholder="ชื่อหมวดหมู่"
           required>
</div>

<div class="col-md-4">
    <input type="text"
           name="description"
           class="form-control"
           placeholder="รายละเอียด">
</div>

                <div class="col-md-2">
                    <input type="text"
                        name="code"
                        class="form-control"
                        placeholder="000"
                        maxlength="3"
                        required>
                </div>

                <div class="col-md-4">
                    <input type="text"
                        name="name"
                        class="form-control"
                        placeholder="ชื่อหมวดหมู่"
                        required>
                </div>

                <div class="col-md-4">
                    <input type="text"
                        name="description"
                        class="form-control"
                        placeholder="รายละเอียด">
                </div>

                <div class="col-md-2">
                    <button type="submit"
                            class="btn btn-primary w-100">
                        เพิ่มหมวดหมู่
                    </button>
                </div>
            </div>

        </form>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>รหัส</th>
                    <th>ชื่อหมวดหมู่</th>
                    <th>รายละเอียด</th>
                    <th>สถานะ</th>
                </tr>
            </thead>

            <tbody>

            @forelse($categories as $category)

                <tr>
                    <td>{{ $category->id }}</td>

                    <td>{{ $category->code }}</td>

                    <td>{{ $category->name }}</td>

                    <td>{{ $category->description }}</td>

                    <td>
                        {{ $category->status ? 'ใช้งาน' : 'ปิดใช้งาน' }}
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="4" class="text-center">
                        ยังไม่มีข้อมูล
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop
