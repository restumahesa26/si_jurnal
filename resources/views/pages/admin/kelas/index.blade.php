@extends('layouts.admin')

@section('title')
    SIAS | Data Kelas
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('kelas.create') }}" class="btn btn-primary mb-3 btn-rounded">Tambah Data Kelas</a>
        <button type="button" class="btn btn-warning mb-3 btn-rounded" data-toggle="modal"
            data-target="#exampleModal">
            Export Kelas
        </button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Export Kelas</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="mdi mdi-close-circle"></i>
                        </button>
                    </div>
                    <form action="{{ route('kelas.export-kelas') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="tahun">Pilih Tahun Ajaran</label>
                                <select class="form-control" id="tahun" name="id" style="color: #000;">
                                    @foreach ($tahuns as $item)
                                        <option value="{{ $item->id }}">{{ $item->tahun_ajaran }} - {{ $item->semester }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Kelas</h4>
                <div class="table-responsive">
                    <div class="">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Wali Kelas</th>
                                    <th>Jumlah Siswa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->jenjang }} {{ $item->kelas }}</td>
                                    <td>{{ $item->waliKelas->user->nama }}</td>
                                    <td>{{ $item->totalSiswa($item->id) != '0' ? $item->totalSiswa($item->id) : '-' }}</td>
                                    <td>
                                        <a href="{{ route('kelas.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ route('kelas-siswa.show', $item->id) }}" class="btn btn-sm btn-success">Lihat Siswa</a>
                                        @if ($item->kelas_siswa_count < 1 && $item->mapel_count < 1)
                                        <form action="{{ route('kelas.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-hapus">Hapus</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="5">-- Data Kelas Masih Kosong --</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    @if(session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session()->get("success") }}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

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
@endpush
