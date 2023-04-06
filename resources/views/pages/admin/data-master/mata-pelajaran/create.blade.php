@extends('layouts.admin')

@section('title')
    SIAS | Data Master | Mata Pelajaran
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('master-mapel.index') }}" class="btn btn-warning btn-rounded text-white">Kembali</a>
        <div class="card mt-3">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Master Mata Pelajaran</h4>
                <form class="forms-sample" action="{{ route('master-mapel.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_mata_pelajaran">Nama Mata Pelajaran</label>
                        <input type="text" name="nama_mata_pelajaran" class="form-control @error('nama_mata_pelajaran') is-invalid @enderror" placeholder="Masukkan Nama Mata Pelajaran" value="{{ old('nama_mata_pelajaran') }}" required>
                        @error('nama_mata_pelajaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis_mata_pelajaran">Nama Mata Pelajaran</label>
                        <select name="jenis_mata_pelajaran" id="jenis_mata_pelajaran" class="jenis_mata_pelajaran w-100" required>
                            <option value=""></option>
                            <option value="Wajib" @if (old('jenis_mata_pelajaran') == 'Wajib')
                                    selected
                                @endif>Wajib</option>
                            <option value="Peminatan" @if (old('jenis_mata_pelajaran') == 'Peminatan')
                                    selected
                                @endif>Peminatan</option>
                        </select>
                        @error('jenis_mata_pelajaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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

    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.jenis_mata_pelajaran').select2({
                placeholder: "-- Pilih Jenis Mata Pelajaran --",
                allowClear: true,
                theme: "classic",
            });
        });
    </script>

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
