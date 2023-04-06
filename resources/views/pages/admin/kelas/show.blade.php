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
                <form action="{{ route('kelas-siswa.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nis">Pilih Siswa</label><br>
                        <select class="nis w-100" id="nis" name="nis[]" multiple="multiple" required>
                            <option value=""></option>
                            @foreach ($siswa as $data)
                                @if ($data->checkSiswa($data->nis))
                                    <option value="{{ $data->nis }}" @if(old('nis') == $data->nis) selected @endif>{{ $data->nama }} - {{ $data->nis }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="kelas_id" value="{{ $item->id }}">
                    <button type="submit" class="btn btn-primary btn-rounded">Tambah Siswa Kelas</button>
                </form>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <h4 class="card-title">Data Siswa Kelas {{ $item->jenjang }} {{ $item->kelas }}</h4>
                <div class="table-responsive">
                    <div class="">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->siswa->nis }}</td>
                                    <td>{{ $item->siswa->nama }}</td>
                                    <td>
                                        @if ($item->siswa->jenis_kelamin == 'L')
                                            <i class="mdi mdi-human-male text-primary" style="font-size: 30px"></i>
                                        @elseif ($item->siswa->jenis_kelamin == 'P')
                                            <i class="mdi mdi-human-female text-warning" style="font-size: 30px"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('kelas-siswa.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-hapus">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="4">-- Data Daftar Siswa Masih Kosong --</td>
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

@push('addon-style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('addon-script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.nis').select2({
                placeholder: "-- Pilih Siswa --",
                allowClear: true,
                theme: "classic",
            });
        });
    </script>

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
