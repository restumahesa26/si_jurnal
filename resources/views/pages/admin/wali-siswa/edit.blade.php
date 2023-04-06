@extends('layouts.admin')

@section('title')
    SIAS | Data Wali Siswa
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('wali-murid.index') }}" class="btn btn-warning btn-rounded text-white">Kembali</a>
        <div class="card mt-3">
            <div class="card-body">
                <h4 class="card-title">Edit Data Wali Siswa</h4>
                <form class="forms-sample mt-3" action="{{ route('wali-murid.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama" class="text-dark">Nama</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan Nama" value="{{ old('nama', $item->user->nama) }}" required>
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_handphone" class="text-dark">No. Handphone</label>
                                <input type="text" name="no_handphone" class="form-control @error('no_handphone') is-invalid @enderror" id="no_handphone" placeholder="Masukkan No. Handphone" value="{{ old('no_handphone', $item->no_handphone) }}" required>
                                @error('no_handphone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="text-dark">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan Email" value="{{ old('email', $item->user->email) }}" required>
                                @error('email')
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
                                <label for="agama" class="text-dark">Agama</label>
                                <input type="text" name="agama" class="form-control @error('agama') is-invalid @enderror" id="agama" placeholder="Masukkan Agama" value="{{ old('agama', $item->agama) }}">
                                @error('agama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pendidikan" class="text-dark">Pendidikan</label>
                                <input type="text" name="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror" id="pendidikan" placeholder="Masukkan Pendidikan" value="{{ old('pendidikan', $item->pendidikan) }}">
                                @error('pendidikan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pekerjaan" class="text-dark">Pekerjaan</label>
                                <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" placeholder="Masukkan Pekerjaan" value="{{ old('pekerjaan', $item->pekerjaan) }}">
                                @error('pekerjaan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat" class="text-dark">Alamat</label>
                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Masukkan Alamat" value="{{ old('alamat', $item->alamat) }}">
                        @error('alamat')
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
                    <button type="submit" class="btn btn-primary me-2 btn-simpan">Submit</button>
                    <button type="reset" class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

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

    <script>
        $('.btn-simpan').on('click', function (e) {
            e.preventDefault(); // prevent form submit
            var form = event.target.form;
            Swal.fire({
            title: 'Simpan Perubahan Data?',
            text: "Data Akan Tersimpan",
            icon: 'info',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }else {
                    //
                }
            });
        });
    </script>
@endpush
