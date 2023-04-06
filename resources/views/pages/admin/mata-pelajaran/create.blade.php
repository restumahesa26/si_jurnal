@extends('layouts.admin')

@section('title')
    SIAS | Data Mata Pelajaran
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('mata-pelajaran.index') }}" class="btn btn-warning btn-rounded text-white">Kembali</a>
        <div class="card mt-3">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Mata Pelajaran</h4>
                <form class="forms-sample" action="{{ route('mata-pelajaran.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_mata_pelajaran">Mata Pelajaran</label>
                                <input type="text" name="nama_mata_pelajaran" class="form-control @error('nama_mata_pelajaran') is-invalid @enderror" id="nama_mata_pelajaran" placeholder="Masukkan Mata Pelajaran" value="{{ old('nama_mata_pelajaran') }}" required>
                                @error('nama_mata_pelajaran')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kelas_id">Kelas</label>
                                <select name="kelas_id" id="kelas_id" class="kelas w-100" required>
                                    <option value=""></option>
                                    @foreach ($items as $kelas)
                                        <option value="{{ $kelas->id }}" @if (old('kelas_id') == $kelas->id)
                                            selected
                                        @endif>{{ $kelas->jenjang }} {{ $kelas->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="hari">Hari</label>
                                <select name="hari" id="hari" class="hari w-100" required>
                                    <option value=""></option>
                                    <option value="Senin" @if (old('hari') == 'Senin')
                                            selected
                                        @endif>Senin</option>
                                    <option value="Selasa" @if (old('hari') == 'Selasa')
                                            selected
                                        @endif>Selasa</option>
                                    <option value="Rabu" @if (old('hari') == 'Rabu')
                                            selected
                                        @endif>Rabu</option>
                                    <option value="Kamis" @if (old('hari') == 'Kamis')
                                            selected
                                        @endif>Kamis</option>
                                    <option value="Jumat" @if (old('hari') == 'Jumat')
                                            selected
                                        @endif>Jumat</option>
                                    <option value="Sabtu" @if (old('hari') == 'Sabtu')
                                            selected
                                        @endif>Sabtu</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="guru">Guru Mata Pelajaran</label>
                        <select class="guru w-100" id="guru" name="guru" required>
                            <option value=""></option>
                            @foreach ($items2 as $item)
                                <option value="{{ $item->nip }}" @if(old('guru') == $item->nip) selected @endif>{{ $item->user->nama }} - {{ $item->nip }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jam_mulai">Jam Mulai</label>
                                <input type="number" name="jam_mulai" class="form-control @error('jam_mulai') is-invalid @enderror" id="jam_mulai" placeholder="Masukkan Jam Mulai" value="{{ old('jam_mulai') }}" required autocomplete="off" min="1">
                                @error('jam_mulai')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jam_akhir">Jam Akhir</label>
                                <input type="number" name="jam_akhir" class="form-control @error('jam_akhir') is-invalid @enderror" id="jam_akhir" placeholder="Masukkan Jam Akhir" value="{{ old('jam_akhir') }}" required autocomplete="off" min="1">
                                @error('jam_akhir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button type="reset" class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.guru').select2({
                placeholder: "-- Pilih Guru Pengampu --",
                allowClear: true,
                theme: "classic",
            });
        });
        $(document).ready(function() {
            $('.kelas').select2({
                placeholder: "-- Pilih Kelas --",
                allowClear: true,
                theme: "classic",
            });
        });
        $(document).ready(function() {
            $('.hari').select2({
                placeholder: "-- Pilih Hari --",
                allowClear: true,
                theme: "classic",
            });
        });
        $(document).ready(function() {
            $('.mata_pelajaran').select2({
                placeholder: "-- Pilih Mata Pelajaran --",
                allowClear: true,
                theme: "classic",
            });
        });
    </script>
    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    @if(session()->has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session()->get("error") }}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endpush
