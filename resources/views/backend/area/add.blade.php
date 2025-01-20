@extends('layout.app')

@section('title') 
    {{ isset($area) ? 'Edit Area' : 'Tambah Area' }}
@endsection

@section('isi')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($area) ? 'Edit Area' : 'Tambah Area' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="/area">Area</a></div>
                <div class="breadcrumb-item">{{ isset($area) ? 'Edit' : 'Tambah' }}</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ isset($area) ? 'Edit Data Area' : 'Tambah Data Area' }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ isset($area) ? route('area.update', $area->id) : route('area.store') }}" method="POST">
                                @csrf
                                @if(isset($area))
                                    @method('PUT')
                                @endif
                                
                                <div class="form-group">
                                    <label for="nama_area">Nama Area</label>
                                    <input type="text" class="form-control @error('nama_area') is-invalid @enderror" 
                                           name="nama_area" 
                                           value="{{ old('nama_area', $area->nama_area ?? '') }}" 
                                           placeholder="Masukkan Nama Area">
                                    @error('nama_area')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="data">Data</label>
                                    <textarea name="data" class="form-control @error('data') is-invalid @enderror" 
                                              cols="30" rows="10" placeholder="Data JSON Area">{{ old('data', $area->data ?? '') }}</textarea>
                                    @error('data')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="ket">Keterangan</label>
                                    <input type="text" class="form-control @error('ket') is-invalid @enderror" 
                                           name="ket" 
                                           value="{{ old('ket', $area->ket ?? '') }}" 
                                           placeholder="Keterangan Area">
                                    @error('ket')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="id_kategori">Parent Kategori</label>
                                    <select name="id_kategori" class="form-control">
                                        @foreach ($kategori as $row)
                                            <option value="{{ $row->id }}" 
                                                    {{ $row->id == old('id_kategori', $area->id_kategori ?? '') ? 'selected' : '' }}>
                                                {{ $row->kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_kategori')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-md btn-primary">
                                    {{ isset($area) ? 'UPDATE' : 'SIMPAN' }}
                                </button>
                                <a href="{{ route('area.index') }}" class="btn btn-md btn-secondary">CANCEL</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
