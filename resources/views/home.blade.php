@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>File</th>
                                <th>Logo Perusahaan</th>
                                <th>Logo Promo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($slide as $value)
                            <tr>
                                <td>{{ $value->file }}</td>
                                <td>{{ $value->company_logo_file }}</td>
                                <td>{{ $value->promo_logo_file }}</td>
                                <td>
                                    <a href="{{ route('delete.slide',$value->id) }}">Delete</a> |
                                    <a href="{{ route('edit.slide',$value->id) }}">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
