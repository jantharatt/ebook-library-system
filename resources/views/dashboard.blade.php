@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>ระบบยืม Ebook</h1>
@stop

@section('content')
<div class="row">

    <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>0</h3>
                <p>หนังสือทั้งหมด</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>0</h3>
                <p>สมาชิกทั้งหมด</p>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>0</h3>
                <p>รายการยืม</p>
            </div>
        </div>
    </div>

</div>
@stop