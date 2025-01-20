@extends('layout.app')
@section('title') {{ isset($kategori) ? "Edit Kategori" : "Tambah Kategori" }} @endsection
@section('isi')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($kategori) ? "Edit Kategori" : "Tambah Kategori" }}</h1>
        </div>
        <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>{{ isset($kategori) ? "Edit Kategori" : "Form Tambah Kategori" }}</h4>
                  </div>
                  <div class="card-body">
                    <form 
                        action="{{ isset($kategori) ? route('kategori.update', $kategori->id) : route('kategori.store') }}" 
                        method="POST">
                        @csrf
                        @if(isset($kategori))
                            @method('PUT') <!-- Untuk edit, metode PUT -->
                        @endif

                        <!-- Input Kategori -->
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="text" 
                                   class="form-control @error('kategori') is-invalid @enderror" 
                                   id="kategori"
                                   name="kategori" 
                                   value="{{ $kategori->kategori ?? old('kategori') }}" 
                                   placeholder="Masukkan Kategori" required>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Input Icon -->
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input type="text" 
                                   class="form-control @error('icon') is-invalid @enderror" 
                                   id="icon"
                                   name="icon" 
                                   value="{{ $kategori->icon ?? old('icon') }}" 
                                   placeholder="Icon Kategori" required>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Select Parent Kategori -->
                        <div class="form-group">
                            <label for="parent_id">Parent Kategori</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="0">Umum</option>
                                @foreach ($paren as $row)
                                    <option value="{{ $row->id }}" 
                                            {{ isset($kategori) && $kategori->parent_id == $row->id ? 'selected' : '' }}>{{ $row->kategori }}</option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit and Reset Buttons -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-md btn-primary">
                                {{ isset($kategori) ? "UPDATE" : "SIMPAN" }}
                            </button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </section>
</div>
@endsection