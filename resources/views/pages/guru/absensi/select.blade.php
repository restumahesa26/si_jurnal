@extends('layouts.admin')

@section('title')
    SIAS | Absensi
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    Daftar Mata Pelajaran Yang Diampu
                </div>
                <div class="row">
                    @forelse ($items as $item)
                    <div class="col-md-4" >
                        <div class="card border-left border-right border-top border-bottom border-primary mb-3" style="border-radius: 10px">
                            <div class="card-body ">
                                <div class="card-title">{{ $item->nama_mata_pelajaran }}</div>
                                <h5 class="text-dark">Kelas {{ $item->kelas->jenjang }} {{ $item->kelas->kelas }}</h5>
                                <h5 class="text-dark">Jumlah Siswa {{ $item->kelas->totalSiswa($item->kelas->id) }}</h5>
                                <h5 class="text-dark">Hari {{ $item->hari }} Jam ke {{ $item->jam_mulai }} - {{ $item->jam_akhir }}</h5>
                                <a href="{{ route('absensi.index', $item->id) }}" class="btn btn-primary">Isi Absensi</a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-md-12">
                        <h4 class="text-danger">Tidak Ada Mata Pelajaran Yang Diampu Hari Ini</h4>
                    </div>
                    @endforelse
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
@endpush
