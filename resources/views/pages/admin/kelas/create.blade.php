@extends('layouts.admin')

@section('title')
    SIAS | Data Kelas
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('kelas.index') }}" class="btn btn-warning btn-rounded text-white">Kembali</a>
        <div class="card mt-3">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Kelas</h4>
                <form class="forms-sample" action="{{ route('kelas.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jenjang">Jenjang</label>
                                <select name="jenjang" id="jenjang" class="jenjang w-100">
                                    <option value="X" @if(old('jenjang') == 'X') selected @endif>X - Sepuluh</option>
                                    <option value="XI" @if(old('jenjang') == 'XI') selected @endif>XI - Sebelas</option>
                                    <option value="XII" @if(old('jenjang') == 'XII') selected @endif>XII - Dua Belas</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" id="kelas" placeholder="Contoh : IPA 1" value="{{ old('kelas') }}" required>
                                @error('kelas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="guru">Wali Kelas</label>
                        <select class="guru w-100" id="guru" name="wali_kelas" required>
                            @foreach ($items as $item)
                            <option value=""></option>
                                <option value="{{ $item->nip }}" @if(old('wali_kelas') == $item->nip) selected @endif>{{ $item->user->nama }} - {{ $item->nip }}</option>
                            @endforeach
                        </select>
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

    <script>
        $(document).ready(function() {
            $('.guru').select2({
                placeholder: "-- Pilih Wali Kelas --",
                allowClear: true,
                theme: "classic",
            });
            $('.jenjang').select2({
                placeholder: "-- Pilih Jenjang Kelas --",
                allowClear: true,
                theme: "classic",
            });
        });
    </script>
@endpush
