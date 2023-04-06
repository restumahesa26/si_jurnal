@extends('layouts.admin')

@section('title')
    SIAS | Data Tahun Ajaran
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('tahun-ajaran.index') }}" class="btn btn-warning btn-rounded text-white">Kembali</a>
        <div class="card mt-3">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Tahun Ajaran</h4>
                <form class="forms-sample" action="{{ route('tahun-ajaran.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <input type="text" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" placeholder="Masukkan Tahun Ajaran" value="{{ old('tahun_ajaran') }}" required>
                        @error('tahun_ajaran')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Ganjil">Semester</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="semester" id="Ganjil"
                                    value="Ganjil" @if (old('semester') == 'Ganjil') checked @endif required>
                                Ganjil
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="semester" id="Genap"
                                    value="Genap" @if (old('semester') == 'Genap') checked @endif required>
                                Genap
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Aktif">Status</label>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="Aktif"
                                    value="Aktif" @if (old('status') == 'Aktif') checked @endif required>
                                Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="Tidak Aktif"
                                    value="Tidak Aktif" @if (old('status') == 'Tidak Aktif') checked @endif required>
                                Tidak Aktif
                            </label>
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

@push('addon-script')
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
