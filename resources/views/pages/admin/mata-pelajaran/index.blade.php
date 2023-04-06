@extends('layouts.admin')

@section('title')
    SIAS | Data Mata Pelajaran
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('mata-pelajaran.create') }}" class="btn btn-primary mb-3 btn-rounded">Tambah Data Mata Pelajaran</a>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Data Mata Pelajaran</h4>
                <div class="table-responsive">
                    <div class="">
                        <table class="table table-hover table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Jadwal</th>
                                    <th>Guru Pengampu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_mata_pelajaran }}</td>
                                    <td>{{ $item->kelas->jenjang }} {{ $item->kelas->kelas }}</td>
                                    <td>{{ $item->hari }}, Jam ke {{ $item->jam_mulai }} - {{ $item->jam_akhir }}</td>
                                    <td>{{ $item->guruPengampu->user->nama }}</td>
                                    <td>
                                        <a href="{{ route('mata-pelajaran.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        @if ($item->absen_count < 1)
                                        <form action="{{ route('mata-pelajaran.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-hapus">Hapus</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="6">-- Data Mata Pelajaran Kosong --</td>
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
