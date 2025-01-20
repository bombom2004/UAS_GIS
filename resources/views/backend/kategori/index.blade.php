@extends('layout.app')
@section('title') {{ "Data Kategori" }} @endsection
@section('isi')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kategori</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="/kategori">Kategori</a></div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Kategori</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori</th>
                                        <th>Icon</th>
                                        <th>
                                            <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                                                <i class="fa fa-plus"></i> Tambah Data
                                            </a>
                                        </th>
                                    </tr>
                                    @forelse ($kategoris as $row)
                                    <tr>
                                        <td>{{ $nomor++ }}</td>
                                        <td>{{ $row->kategori }}</td>
                                        <td><i class="{{ $row->icon }}"></i></td>
                                        <td>
                                            <form onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');" action="{{ route('kategori.destroy', $row->id) }}" method="POST">
                                                <a href="{{ route('kategori.edit', $row->id) }}" class="btn btn-info">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Data Belum Ada</td>
                                    </tr>
                                    @endforelse
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                <ul class="pagination mb-0">
                                    {{ $kategoris->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    //message with toastr
    @if(session()->has('success'))
        toastr.success('{{ session('success') }}', 'BERHASIL!');
    @elseif(session()->has('error'))
        toastr.error('{{ session('error') }}', 'GAGAL!');
    @endif
</script>
@endsection