@extends('layout.app')

@section('title') {{ "Form Pengguna" }} @endsection

@section('isi')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Form Pengguna</h1>
                <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                  <div class="breadcrumb-item"><a href="/daftar">Daftar</a></div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                  <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        <h4>{{ isset($user) ? 'Edit Pengguna' : 'Form Register Pengguna' }}</h4>
                      </div>
                      <div class="card-body">
                        <form action="{{ isset($user) ? route('updateUser', $user->id) : route('daftar') }}" method="post">
                            @csrf
                            @if(isset($user))  <!-- Jika ada data user, pakai metode PUT -->
                                @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                       name="name" placeholder="Nama Lengkap" value="{{ old('name', $user->name ?? '') }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                       name="email" placeholder="name@example.com" value="{{ old('email', $user->email ?? '') }}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation"
                                       placeholder="password">
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" value="{{ isset($user) ? 'Update' : 'Register' }}">
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