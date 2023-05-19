@extends('layouts.admin')

@section('title')
    SIAS | Jurnal
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="card-title">
                                Silahkan Ubah Jurnal Pertemuan Hari {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}
                            </div>
                            <form action="{{ route('admin-jurnal.delete', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-rounded btn-hapus">
                                    Hapus Daftar Hadir
                                </button>
                            </form>
                        </div>
                        <div class="text-dark">
                            <div class="row">
                                <div class="col-md-2">Mata Pelajaran</div>
                                <div class="col-md-10">: {{ $item->mataPelajaran->nama_mata_pelajaran }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Kelas</div>
                                <div class="col-md-10">: {{ $item->mataPelajaran->kelas->jenjang }} {{ $item->first()->mataPelajaran->kelas->kelas }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Guru Pengampu</div>
                                <div class="col-md-10">: {{ $item->mataPelajaran->guruPengampu->user->nama }}</div>
                            </div>
                        </div>
                        <form action="{{ route('admin-jurnal.update', $item->id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="topik_pembelajaran" class="text-dark">Topik Pembelajaran</label>
                                <input type="text" name="topik_pembelajaran"
                                    class="form-control @error('topik_pembelajaran') is-invalid @enderror"
                                    id="topik_pembelajaran" placeholder="Masukkan Topik Pembelajaran"
                                    value="{{ old('topik_pembelajaran', $item->topik_pembelajaran) }}" required>
                                @error('topik_pembelajaran')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kegiatan_belajar" class="text-dark">Kegiatan Belajar</label>
                                <textarea name="kegiatan_belajar" id="kegiatan_belajar" cols="30" rows="10" class="form-control"
                                    required placeholder="Masukkan Kegiatan Belajar">{{ old('kegiatan_belajar', $item->kegiatan_belajar) }}</textarea>
                                @error('kegiatan_belajar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="kendala_belajar" class="text-dark">Kendala Belajar</label>
                                <textarea name="kendala_belajar" id="kendala_belajar" cols="30" rows="10" class="form-control"
                                    required placeholder="Masukkan Kendala Belajar">{{ old('kendala_belajar', $item->kendala_belajar) }}</textarea>
                                @error('kendala_belajar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-block btn-primary btn-md w-100 mt-3 btn-simpan">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    <script>
        $('.btn-hapus').on('click', function (e) {
            e.preventDefault(); // prevent form submit
            var form = event.target.form;
            Swal.fire({
            title: 'Hapus Data?',
            text: "Data Akan Terhapus Permanen",
            icon: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
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
