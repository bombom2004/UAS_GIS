@extends('layout.app')
@section('title') {{ "Data Pengguna" }} @endsection
@section('isi')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pengguna</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="/dataPengguna">Pengguna</a></div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Pengguna</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Email</th>
                                            <th>
                                                <a href="{{ route('daftar') }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-plus"></i> Tambah Data
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($pengguna as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>
                                                <a href="{{ route('auth.editUser', $row->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form action="{{ route('auth.deleteUser', $row->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
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
                                    </tbody>
                                </table>
                            </div>
                            @if ($pengguna instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                <div class="card-footer text-right">
                                    <nav class="d-inline-block">
                                        <ul class="pagination mb-0">
                                            {{ $pengguna->links() }}
                                        </ul>
                                    </nav>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    // Pesan dengan toastr jika ada session sukses atau error
    @if(session()->has('success'))
        toastr.success('{{ session('success') }}', 'BERHASIL!');
    @elseif(session()->has('error'))
        toastr.error('{{ session('error') }}', 'GAGAL!');
    @endif
</script>
@endsection