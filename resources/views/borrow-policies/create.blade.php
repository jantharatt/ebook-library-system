@extends('adminlte::page')

@section('title', 'เพิ่มนโยบายการยืม')

@section('content_header')
<h1>เพิ่มนโยบายการยืม</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('borrow-policies.store') }}"
              method="POST">

            @csrf

            <div class="form-group">
                <label>ประเภทผู้ใช้</label>

                <select name="role"
                        class="form-control"
                        required>

                    <option value="student">นักศึกษา</option>
                    <option value="teacher">อาจารย์</option>
                    <option value="staff">เจ้าหน้าที่</option>
                    <option value="alumni">ศิษย์เก่า</option>

                </select>
            </div>

            <div class="form-group">
                <label>จำนวนเล่มสูงสุด</label>

                <input type="number"
                       name="max_books"
                       class="form-control"
                       required>
            </div>

            <div class="form-group">
                <label>จำนวนวันยืม</label>

                <input type="number"
                       name="borrow_days"
                       class="form-control"
                       required>
            </div>

            <button class="btn btn-primary">
                บันทึก
            </button>

        </form>

    </div>
</div>

@stop
