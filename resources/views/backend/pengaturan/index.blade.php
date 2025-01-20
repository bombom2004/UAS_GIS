@extends('layout.app')
@section('isi')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pengaturan Aplikasi</h1>
                <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                  <div class="breadcrumb-item"><a href="/daftar">Pengaturan</a></div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                  <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        <h4>Form Pengaturan Aplikasi</h4>
                      </div>
                      <div class="card-body">
                        <div class="card-body">
                            <form action="/pengaturan/update" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <input type="hidden" name="id" value="{{ $pengaturan->id }}">
                                    <label for="nama_app" class="form-label">Nama Aplikasi</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="nama_app"
                                           name="nama_app" placeholder="Nama Aplikasi" value="{{ $pengaturan->nama_app }}">
                                    @error('nama_app')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Singkatan</label>
                                    <input type="text" class="form-control @error('singkatan') is-invalid @enderror" id="singkatan"
                                           name="singkatan" placeholder="Singkatan" value="{{ $pengaturan->singkatan }}">
                                    @error('singkatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <img src="{{ asset('storage/logo/' . $pengaturan->logo) }}" width="100px"/>
                                    <br>

                                    <label for="name" class="form-label">Logo</label>
                                    <input type="file" class="form-control @error('name') is-invalid @enderror"
                                           name="logo"  value="{{ $pengaturan->logo }}">
                                    @error('logo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div id="MapLocation" style="height: 400px"></div>
                                <text-area id = "lng"></text-area>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Latitude</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="Latitude"
                                           name="latitude"  value="{{ $pengaturan->latitude }}">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Longitude</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="Longitude"
                                           name="longitude" value="{{ $pengaturan->longitude }}">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Zoom</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="zoom" placeholder="Zoom" value="{{ $pengaturan->zoom }}">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <input type="submit" class="btn btn-primary btn-flat" value="Ubah">
                                </div>
                            </form>
                        </div>
                          </table>
                        </div>
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
  // use below if you want to specify the path for leaflet's images
  //L.Icon.Default.imagePath = '@Url.Content("~/Content/img/leaflet")';

  var curLocation = [0, 0];
  // use below if you have a model
  // var curLocation = [@Model.Location.Latitude, @Model.Location.Longitude];

  if (curLocation[0] == 0 && curLocation[1] == 0) {
    curLocation = [{{ $pengaturan->latitude }},{{ $pengaturan->longitude }}];
  }

  var map = L.map('MapLocation').setView(curLocation, {{ $pengaturan->zoom }});

  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  map.attributionControl.setPrefix(false);
  map.options.minZoom = 9;
  map.options.maxZoom = 14;
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
    var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
    marker.setLatLng(position, {
      draggable: 'true'
    }).bindPopup(position).update();
    map.panTo(position);
  });

  map.addLayer(marker);
})
        </script>
@endsection
