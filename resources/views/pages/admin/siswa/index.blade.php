@extends('layouts.admin')

@section('title')
    SIAS | Data Siswa
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('siswa.create') }}" class="btn btn-primary mb-3 btn-rounded">Tambah Data Siswa</a>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Siswa</h4>
                <div class="table-responsive">
                    <div class="">
                        <table class="table table-hover table-bordered" id="table">
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
                                    <td>{{ $item->nis }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        @if ($item->jenis_kelamin == 'L')
                                            <i class="mdi mdi-human-male text-primary" style="font-size: 30px"></i>
                                        @elseif ($item->jenis_kelamin == 'P')
                                            <i class="mdi mdi-human-female text-warning" style="font-size: 30px"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('siswa.edit', $item->nis) }}" class="btn btn-sm btn-primary">Edit</a>
                                        @if ($item->kelas_siswa_count < 1)
                                        <form action="{{ route('siswa.destroy', $item->nis) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-hapus">Hapus</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="5">-- Data Siswa Masih Kosong --</td>
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endpush

@push('addon-script')
    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                "orderable" : false
            });
        });
    </script>

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
