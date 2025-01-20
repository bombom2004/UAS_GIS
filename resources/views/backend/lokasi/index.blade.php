@extends('layout.app')
@section('title') {{  "Data Lokasi" }} @endsection
@section('isi')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Lokasi</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="/lokasi">Kategori</a></div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Data Lokasi</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-md">
                        <tr>
                            <th>No</th>
                            <th>Nama Lokasi</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Gambar</th>
                            <th>Diskripsi</th>
                            <th>Kategori</th>
                            <th>Icon</th>
                            <th><a href="{{route('lokasi.create')}}" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah Data</a> </th>
                        </tr>
                        @forelse ($lokasi as $row )
                        <tr>
                            <td>{{$nomor++}}</td>
                            <td>{{$row->nama_lokasi}}</td>
                            <td>{{$row->latitude}}</td>
                            <td>{{$row->longitude}}</td>
                            <td><img src="{{ asset('storage/lokasi/' . $row->gambar) }}" width="100px"/></td>
                            <td>{{substr($row->diskripsi, 0, 50)}}</td>
                            <td>{{$row->kategori}}</td>
                            <td>{{$row->icon}}</td>
                            <td>
                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('lokasi.destroy', $row->id) }}" method="POST">
                                <a href="{{ route('lokasi.show', $row->id) }}" class="btn btn-dark"><i class="fa fa-f3 fa-eye"></i></a>
                                <a href="{{ route('lokasi.edit', $row->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fa fa-f3 fa-trash"></i></button>
                            </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Data Belum Ada</td>
                        </tr>
                    @endforelse
                      </table>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <nav class="d-inline-block">
                      <ul class="pagination mb-0">
                        {{ $lokasi->links() }}
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