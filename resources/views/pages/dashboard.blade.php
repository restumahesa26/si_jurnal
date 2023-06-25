@extends('layouts.admin')

@section('title')
    SIAS | Dashboard
@endsection

@section('content')
<div class="d-xl-flex justify-content-between align-items-start">
    <h2 class="text-dark font-weight-bold mb-2">Selamat Datang, {{ Auth::user()->nama }}</h2>
    <h4 class="text-dark">Tahun Ajaran : {{ $tahun->tahun_ajaran }} - {{ $tahun->semester }}</h4>
</div>

@if (Auth::user()->role == 'Admin')
<div class="row mt-2">
    <div class="col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-center">
                <h5 class="mb-2 text-dark font-weight-normal">Siswa Kelas X</h5>
                <h2 class="mb-2 text-dark font-weight-bold">{{ $siswaSepuluh }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-center">
                <h5 class="mb-2 text-dark font-weight-normal">Siswa Kelas XI</h5>
                <h2 class="mb-2 text-dark font-weight-bold">{{ $siswaSebelas }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-center">
                <h5 class="mb-2 text-dark font-weight-normal">Siswa Kelas XII</h5>
                <h2 class="mb-2 text-dark font-weight-bold">{{ $siswaDuabelas }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-center">
                <h5 class="mb-2 text-dark font-weight-normal">Tahun Ajaran</h5>
                <h2 class="mb-2 text-dark font-weight-bold">{{ $tahun->tahun_ajaran }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    @forelse ($semuaMapel as $item)
    <div class="col-md-3">
        <div class="card border-left border-right border-top border-bottom @if ($item->jenjang == 'X')
            border-primary @elseif ($item->jenjang == 'XI') border-warning @elseif ($item->jenjang == 'XII') border-danger @endif mb-3" style="border-radius: 10px">
            <div class="card-body ">
                <div class="card-title">Kelas : {{ $item->jenjang }} {{ $item->kelas }}</div>
                <h5 class="text-dark">Jumlah Siswa {{ $item->totalSiswa($item->id) }} orang</h5>
                <h5 class="text-dark">Wali Kelas : {{ $item->waliKelas->user->nama }}</h5>
                <a href="{{ route('dashboard.show-absen-kelas', $item->id) }}" class="btn btn-primary">Lihat Rekap Absen</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4>Belum Ada Kelas Tersedia</h4>
                </div>
            </div>
        </div>
    </div>
    @endforelse
</div>
@elseif (Auth::user()->role == 'Guru')
<div class="row">
    @forelse ($semuaMapel as $item)
    <div class="col-md-3">
        <div class="card border-left border-right border-top border-bottom @if ($item->kelas->jenjang == 'X')
            border-primary @elseif ($item->kelas->jenjang == 'XI') border-warning @elseif ($item->kelas->jenjang == 'XII') border-danger @endif mb-3" style="border-radius: 10px">
            <div class="card-body ">
                <div class="card-title">{{ $item->nama_mata_pelajaran }} <br>Kelas : {{ $item->kelas->jenjang }} {{ $item->kelas->kelas }}</div>
                <h5 class="text-dark">Jumlah Siswa {{ $item->kelas->totalSiswa($item->id) }} orang</h5>
                <h5 class="text-dark">Wali Kelas : {{ $item->kelas->waliKelas->user->nama }}</h5>
                <a href="{{ route('dashboard.show-absen-kelas', $item->id) }}" class="btn btn-primary">Lihat Rekap Absen</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4>Belum Ada Kelas Tersedia</h4>
                </div>
            </div>
        </div>
    </div>
    @endforelse
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="exampleModalLabel">Notifikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="text-dark">Harap Isi Absensi dan Jurnal Untuk Hari Ini</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@elseif (Auth::user()->role == 'Waka-Kurikulum')
<div class="row">
    @forelse ($semuaMapel as $item)
    <div class="col-md-3">
        <div class="card border-left border-right border-top border-bottom @if ($item->jenjang == 'X')
            border-primary @elseif ($item->jenjang == 'XI') border-warning @elseif ($item->jenjang == 'XII') border-danger @endif mb-3" style="border-radius: 10px">
            <div class="card-body ">
                <div class="card-title">Kelas : {{ $item->jenjang }} {{ $item->kelas }}</div>
                <h5 class="text-dark">Jumlah Siswa {{ $item->totalSiswa($item->id) }} orang</h5>
                <h5 class="text-dark">Wali Kelas : {{ $item->waliKelas->user->nama }}</h5>
                <a href="{{ route('dashboard.show-absen-kelas', $item->id) }}" class="btn btn-primary">Lihat Rekap Absen</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4>Belum Ada Kelas Tersedia</h4>
                </div>
            </div>
        </div>
    </div>
    @endforelse
</div>
@endif
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
@if (Auth::user()->role == 'Guru')
@if (App\Helpers\Helper::checkAbsen(Auth::user()->guru->nip))
<script>
    $('#exampleModal').modal('show');
</script>
@endif
@endif
@endpush
