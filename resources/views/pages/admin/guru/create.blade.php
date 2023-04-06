@extends('layouts.admin')

@section('title')
    SIAS | Data Guru
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('guru.index') }}" class="btn btn-warning btn-rounded text-white">Kembali</a>
        <div class="card mt-3">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Guru</h4>
                <form class="forms-sample mt-3" action="{{ route('guru.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama" class="text-dark">Nama</label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan Nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nip" class="text-dark">NIP</label>
                                <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" id="nip" placeholder="Masukkan NIP" value="{{ old('nip') }}" required>
                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pangkat" class="text-dark">Pangkat</label>
                                <input type="text" name="pangkat" class="form-control @error('pangkat') is-invalid @enderror" id="pangkat" placeholder="Masukkan Pangkat" value="{{ old('pangkat') }}">
                                @error('pangkat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="golongan" class="text-dark">Golongan</label>
                                <input type="text" name="golongan" class="form-control @error('golongan') is-invalid @enderror" id="golongan" placeholder="Masukkan Golongan" value="{{ old('golongan') }}">
                                @error('golongan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jabatan" class="text-dark">Jabatan</label>
                                <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" placeholder="Masukkan Jabatan" value="{{ old('jabatan') }}">
                                @error('jabatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="text-dark">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan Email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="text-dark">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Masukkan Password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation" class="text-dark">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" placeholder="Masukkan Konfirmasi Password" required>
                                @error('password_confirmation')
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
    <link href="{{ url('backend/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" >
@endpush

@push('addon-script')
    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    <script src="{{ url('backend/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $('#tanggal_lahir').datepicker({
            format: 'yyyy/mm/dd',
            todayBtn: 'linked',
            todayHighlight: true,
            autoclose: true,
        });
        $('#tanggal_lahir').keypress(function(e) {
            e.preventDefault();
        });
    </script>

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Perhatikan Lagi Field Yang Diisi',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@endpush
