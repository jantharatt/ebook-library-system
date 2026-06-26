@extends('adminlte::page')

@section('title', 'นโยบายการยืม')

@section('content_header')
<h1>นโยบายการยืม</h1>
@stop

@section('content')

<div class="card">

    <div class="card-header">

        <a href="{{ route('borrow-policies.create') }}"
           class="btn btn-primary">

            เพิ่มนโยบาย
        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Role</th>
                    <th>จำนวนเล่ม</th>
                    <th>จำนวนวัน</th>
                </tr>
            </thead>

            <tbody>

            @forelse($policies as $policy)

                <tr>

                    <td>{{ $policy->role }}</td>

                    <td>{{ $policy->max_books }}</td>

                    <td>{{ $policy->borrow_days }}</td>

                </tr>

            @empty

                <tr>
                    <td colspan="3" class="text-center">
                        ยังไม่มีข้อมูล
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@stop
