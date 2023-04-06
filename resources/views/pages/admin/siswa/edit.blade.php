@extends('layouts.admin')

@section('title')
    SIAS | Data Siswa
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('siswa.index') }}" class="btn btn-warning btn-rounded text-white">Kembali</a>
        <div class="card mt-3">
            <div class="card-body">
                <h4 class="card-title">Edit Data Siswa</h4>
                <form class="forms-sample mt-3" action="{{ route('siswa.update', $item->nis) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nis" class="text-dark">NIS</label>
                                <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror" id="nis" placeholder="Masukkan NIS" value="{{ old('nis', $item->nis) }}" required>
                                @error('nis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama" class="text-dark">Nama</label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan Nama" value="{{ old('nama', $item->nama) }}" required>
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="L" class="text-dark">Jenis Kelamin</label>
                                <div class="form-check">
                                    <label class="form-check-label text-dark">
                                        <input type="radio" class="form-check-input" name="jenis_kelamin" id="L"
                                            value="L" @if (old('jenis_kelamin', $item->jenis_kelamin) == 'L') checked @endif required>
                                        Laki-Laki
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label text-dark">
                                        <input type="radio" class="form-check-input" name="jenis_kelamin" id="P"
                                            value="P" @if (old('jenis_kelamin', $item->jenis_kelamin) == 'P') checked @endif required>
                                        Perempuan
                                    </label>
                                </div>
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
<link href="{{ url('backend/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" >
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('addon-script')
<script src="{{ url('backend/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: 'Terdapat Kesalahan Input',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif

<script>
    $('#tanggal_lahir').datepicker({
        format: 'yyyy-mm-dd',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true,
    });
    $('#angkatan').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    });
    $('#tanggal_lahir, #angkatan').keypress(function(e) {
        e.preventDefault();
    });
</script>

<script>
    $(document).ready(function() {
        $('.wali_siswa_id').select2({
            placeholder: "-- Pilih Wali Siswa --",
            allowClear: true,
            theme: "classic",
        });
    });
</script>
@endpush
