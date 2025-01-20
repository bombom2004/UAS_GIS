@extends('layout.app')
@section('title') {{  "Form Lokasi" }} @endsection
@section('isi')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Lokasi</h1>
        </div>
        <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Form Lokasi</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{ isset($lokasi) ? route('lokasi.update', $lokasi->id) : route('lokasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($lokasi))
                            @method('PUT') <!-- Menggunakan PUT untuk update -->
                        @endif

                        Nama Lokasi : 
                        <input type="text" class="form-control @error('nama_lokasi') is-invalid @enderror" name="nama_lokasi" value="{{ old('nama_lokasi', $lokasi->nama_lokasi ?? '') }}" placeholder="Masukkan Nama Lokasi">
                        @error('nama_lokasi')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br>
                        <div id="MapLocation" style="height: 400px"></div>
                        <br>
                        Latitude : 
                        <input type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude" value="{{ old('latitude', $lokasi->latitude ?? '') }}" id="Latitude" placeholder="Latitude">
                        @error('latitude')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br>
                        Longitude : 
                        <input type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{ old('longitude', $lokasi->longitude ?? '') }}" id="Longitude" placeholder="Longitude">
                        @error('longitude')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br>
                        Gambar
                        <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar" value="">
                        @error('gambar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        Diskripsi : 
                        <textarea name="diskripsi" class="form-control @error('diskripsi') is-invalid @enderror" cols="30" rows="10">{{ old('diskripsi', $lokasi->diskripsi ?? '') }}</textarea>
                        @error('diskripsi')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br>
                        Kategori:
                        <select name="id_kategori" class="form-control">
                        @foreach ($kategori as $row)
                            <option value="{{ $row->id }}" {{ (isset($lokasi) && $lokasi->id_kategori == $row->id) ? 'selected' : '' }}>
                                {{ $row->kategori }}
                            </option>
                        @endforeach
                        </select>
                        @error('id_kategori')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br>
                        Icon : 
                        <input type="text" class="form-control @error('icon') is-invalid @enderror" name="icon" value="{{ old('icon', $lokasi->icon ?? '') }}" placeholder="Icon Kategori">
                        @error('icon')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <br>
                        <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                         <button type="reset" class="btn btn-md btn-warning">RESET</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </section>
</div>

<link rel="stylesheet" href="https://npmcdn.com/leaflet@0.7.7/dist/leaflet.css">
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://npmcdn.com/leaflet@0.7.7/dist/leaflet.js"></script>

<script>
    $(function() {
        var curLocation = [{{ old('latitude', $lokasi->latitude ?? 0) }}, {{ old('longitude', $lokasi->longitude ?? 0) }}];

        var map = L.map('MapLocation').setView(curLocation, {{ $pengaturan->zoom }});

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = new L.marker(curLocation, {
            draggable: 'true'
        });

        marker.on('dragend', function(event) {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
                draggable: 'true'
            }).bindPopup(position).update();
            $("#Latitude").val(position.lat);
            $("#Longitude").val(position.lng).keyup();
        });

        $("#Latitude, #Longitude").change(function() {
            var position = [parseFloat($("#Latitude").val()), parseFloat($("#Longitude").val())];
            marker.setLatLng(position, {
                draggable: 'true'
            }).bindPopup(position).update();
            map.panTo(position);
        });

        map.addLayer(marker);
    });
</script>
@endsection