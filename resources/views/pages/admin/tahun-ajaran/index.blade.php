@extends('layouts.admin')

@section('title')
    SIAS | Data Tahun Ajaran
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('tahun-ajaran.create') }}" class="btn btn-primary mb-3 btn-rounded"
            style="margin-right: 12px;">Tambah Data Tahun Ajaran</a>
        <button type="button" class="btn btn-warning mb-3 btn-rounded" data-toggle="modal"
            data-target="#exampleModal">
            Ubah Tahun Ajaran Aktif
        </button>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Tahun Ajaran Aktif</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            <i class="mdi mdi-close-circle"></i>
                        </button>
                    </div>
                    <form action="{{ route('tahun-ajaran.update-status-aktif') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="tahun">Pilih Tahun Ajaran</label>
                                <select class="form-control" id="tahun" name="id" style="color: #000;">
                                    @foreach ($items->where('status', 'Tidak Aktif') as $item)
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
                <h4 class="card-title">Data Tahun Ajaran</h4>
                <div class="table-responsive">
                    <div class="">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Semester</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tahun_ajaran }}</td>
                                    <td>{{ $item->semester }}</td>
                                    <td>
                                        <label class="badge @if($item->status == 'Aktif') badge-primary @else badge-danger @endif">{{ $item->status }}</label>
                                    </td>
                                    <td>
                                        <a href="{{ route('tahun-ajaran.edit', $item->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        @if ($item->kelas_count < 1)
                                        <form action="{{ route('tahun-ajaran.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-hapus">Hapus</button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="5">-- Data Tahun Ajaran Masih Kosong --</td>
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
