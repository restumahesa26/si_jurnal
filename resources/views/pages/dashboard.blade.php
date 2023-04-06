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
                <a href="{{ route('dashboard.show-absen-kelas', $item->id) }}" class="btn btn-primary">Lihar Rekap Absen</a>
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
                <a href="{{ route('dashboard.show-absen-kelas', $item->id) }}" class="btn btn-primary">Lihar Rekap Absen</a>
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
                <a href="{{ route('dashboard.show-absen-kelas', $item->id) }}" class="btn btn-primary">Lihar Rekap Absen</a>
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
@endpush
