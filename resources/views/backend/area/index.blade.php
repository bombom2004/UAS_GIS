@extends('layout.app')
@section('title') 
    {{ "Data Area" }} 
@endsection

@section('isi')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Area</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="/area">Area</a></div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Data Area</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-md">
                        <tr>
                            <th>No</th>
                            <th>Nama Area</th>
                            <th>Data</th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                            <th><a href="{{route('area.create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data</a> </th>
                        </tr>
                        @forelse ($areas as $row )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$row->nama_area}}</td>
                            <td>{{$row->data}}</td>
                            <td>{{$row->Kategori->kategori}}</td>
                            <td>{{$row->ket}}</td>
                            <td>
                                <a href="{{ route('area.edit', $row->id) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                
                                <!-- Form untuk menghapus data dengan konfirmasi -->
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('area.destroy', $row->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Data Belum Ada</td>
                        </tr>
                        @endforelse
                      </table>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <nav class="d-inline-block">
                      <ul class="pagination mb-0">
                        {{ $areas->links() }}
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
    // Pesan dengan toastr jika ada session sukses atau error
    @if(session()->has('success'))
        toastr.success('{{ session('success') }}', 'BERHASIL!');
    @elseif(session()->has('error'))
        toastr.error('{{ session('error') }}', 'GAGAL!');
    @endif
</script>
@endsection