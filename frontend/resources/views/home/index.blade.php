@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title mb-3">Daftar Category</h1>

                @if (!empty($Category))
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Aksi</th> </tr>
                        </thead>
                        <tbody>
                            @foreach ($Category as $category)
                                <tr>
                                    <td>{{ $category['id'] ?? '' }}</td>
                                    <td>{{ $category['name'] ?? '' }}</td>
                                    <td>{{ $category['description'] ?? '' }}</td>
                                    <td>{{ $category['created_at'] ?? '' }}</td>
                                    <td>
                                        <form action="{{ route('Category.destroy', $category['id']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="card-text">Belum ada data Category.</p>
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('Category.create') }}" class="btn btn-primary">Create Category</a>
            </div>
        </div>
    </div>
</div>
@endsection