@extends('layouts.admin')

@section('title')
    SIAS | Absensi
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
                                Silahkan Ubah Absensi Pertemuan ke-{{ $items->first()->pertemuan }}
                            </div>
                            <form action="{{ route('admin-absensi.delete') }}" method="POST">
                                @csrf
                                @foreach ($items as $item)
                                    <input type="hidden" name="id[]" value="{{ $item->id }}">
                                    <input type="hidden" name="tanggal" value="{{ $item->tanggal }}">
                                @endforeach
                                <button type="submit" class="btn btn-danger btn-rounded btn-hapus">
                                    Hapus Daftar Hadir
                                </button>
                            </form>
                        </div>
                        <div class="text-dark">
                            <div class="row">
                                <div class="col-md-2">Mata Pelajaran</div>
                                <div class="col-md-10">: {{ $items->first()->mataPelajaran->nama_mata_pelajaran }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Kelas</div>
                                <div class="col-md-10">: {{ $items->first()->kelasSiswa->kelas->jenjang }} {{ $items->first()->kelasSiswa->kelas->kelas }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">Wali Kelas</div>
                                <div class="col-md-10">: {{ $items->first()->kelasSiswa->kelas->waliKelas->user->nama }}</div>
                            </div>
                        </div>
                        <form action="{{ route('admin-absensi.update') }}" method="POST" class="mt-3">
                            @csrf
                            @method('PUT')
                            <div class="table-responsive">
                                <div class="">
                                    <table class="table table-hover table-bordered" id="table1">
                                        <thead>
                                            <tr>
                                                <th>NIS</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th style="width: 20%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($items as $item)
                                            <tr>
                                                <td>{{ $item->kelasSiswa->siswa->nis }}</td>
                                                <td>{{ $item->kelasSiswa->siswa->nama }}</td>
                                                <td>
                                                    @if ($item->kelasSiswa->siswa->jenis_kelamin == 'L')
                                                        <i class="mdi mdi-human-male text-primary" style="font-size: 30px"></i>
                                                    @elseif ($item->kelasSiswa->siswa->jenis_kelamin == 'P')
                                                        <i class="mdi mdi-human-female text-warning" style="font-size: 30px"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    <select class="form-control" id="status" name="status[]" style="color: #000;">
                                                        <option value="Hadir" @if($item->status == 'Hadir') selected @endif>Hadir</option>
                                                        <option value="Sakit" @if($item->status == 'Sakit') selected @endif>Sakit</option>
                                                        <option value="Izin" @if($item->status == 'Izin') selected @endif>Izin</option>
                                                        <option value="Tanpa Keterangan" @if($item->status == 'Tanpa Keterangan') selected @endif>Tanpa Keterangan</option>
                                                    </select>
                                                    <input type="hidden" name="id[]" value="{{ $item->id }}">
                                                    <input type="hidden" name="tanggal" value="{{ $item->tanggal }}">
                                                </td>
                                            </tr>
                                            @empty
                                            <tr class="text-center">
                                                <td colspan="7"> -- Data Kosong --</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
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
