@extends('adminlte::page')

@section('title', 'เพิ่ม Ebook')

@section('content_header')
<h1>เพิ่ม Ebook</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('ebooks.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label>ชื่อเรื่อง</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       required>
            </div>

            <div class="form-group">
                <label>ผู้แต่ง</label>
                <input type="text"
                       name="author"
                       class="form-control"
                       required>
            </div>

            <div class="form-group">
                <label>หมวดหมู่</label>

                <select name="category_id"
                        class="form-control"
                        required>

                    <option value="">
                        เลือกหมวดหมู่
                    </option>

                    @foreach($categories as $category)

                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>

                    @endforeach

                </select>

            </div>

            <div class="form-group">
                <label>ISBN</label>
                <input type="text"
                       name="isbn"
                       class="form-control">
            </div>

            <div class="form-group">
                <label>สำนักพิมพ์</label>
                <input type="text"
                       name="publisher"
                       class="form-control">
            </div>

            <div class="form-group">
                <label>ปีพิมพ์</label>

                <input type="number"
                    name="publish_year"
                    class="form-control"
                    placeholder="เช่น 2025">

                @error('publish_year')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

                <small class="text-muted">
                    สามารถกรอกได้ทั้ง ค.ศ. (2025) หรือ พ.ศ. (2568)
                </small>
            </div>

            <div class="form-group">
                <label>คำสำคัญ</label>
                <input type="text"
                    name="keywords"
                    class="form-control">
            </div>
                


            <div class="form-group">
                <label>รายละเอียด</label>
                <textarea name="description"
                          rows="4"
                          class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>จำนวนหน้า</label>
                <input type="number"
                       name="total_pages"
                       class="form-control">
            </div>

            <div class="form-group">
                <label>รูปปก</label>
                <input type="file"
                       name="cover"
                       class="form-control">
            </div>

            <div class="form-group">
                <label>ไฟล์ PDF</label>
                <input type="file"
                       name="pdf_file"
                       class="form-control"
                       required>
            </div>

            <button type="submit"
                    class="btn btn-primary">
                บันทึก
            </button>

        </form>

    </div>
</div>

@stop