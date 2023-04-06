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
                                Silahkan Ubah Jurnal Pertemuan ke-{{ $item->pertemuan }}
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
                                <div class="col-md-10">: {{ $item->mataPelajaran->mata_pelajaran->nama_mata_pelajaran }}</div>
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
                                <label for="pokok_bahasan" class="text-dark">Kompetensi Dasar</label>
                                <input type="text" name="pokok_bahasan" class="form-control @error('pokok_bahasan') is-invalid @enderror" id="pokok_bahasan" placeholder="Masukkan Kompetensi Dasar" value="{{ old('pokok_bahasan', $item->pokok_bahasan) }}" required>
                                @error('pokok_bahasan')
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
