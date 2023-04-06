@extends('layouts.admin')

@section('title')
    SIAS | Dashboard
@endsection

@section('content')

@if (Auth::user()->role == 'Admin')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3 btn-rounded">Kembali</a>
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    Kelas : {{ $item->jenjang }} {{ $item->kelas }} <br>
                    Wali Kelas : {{ $item->waliKelas->user->nama }} <br>
                    Total Siswa : {{ $item->totalSiswa($item->id) }} orang<br>
                </div>
                <div class="table-responsive">
                    <div class="">
                        <table class="table table-hover table-bordered w-100" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Total Sakit</th>
                                    <th>Total Izin</th>
                                    <th>Total Tanpa Keterangan</th>
                                    <th>Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($item->kelas_siswa as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->siswa->nis }}</td>
                                    <td>{{ $siswa->siswa->nama }}</td>
                                    <td>
                                        @if ($siswa->siswa->jenis_kelamin == 'L')
                                            <i class="mdi mdi-human-male text-primary" style="font-size: 30px"></i>
                                        @elseif ($siswa->siswa->jenis_kelamin == 'P')
                                            <i class="mdi mdi-human-female text-warning" style="font-size: 30px"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <label class="badge badge-primary">{{ $siswa->hitungStatus2('Sakit', $siswa->siswa->nis) }}</label>
                                    </td>
                                    <td>
                                        <label class="badge badge-warning">{{ $siswa->hitungStatus2('Izin', $siswa->siswa->nis) }}</label>
                                    </td>
                                    <td>
                                        <label class="badge badge-danger">{{ $siswa->hitungStatus2('Tanpa Keterangan', $siswa->siswa->nis) }}</label>
                                    </td>
                                    <td>
                                        <label class="badge badge-success">{{ $siswa->hitungPersentase2($siswa->siswa->nis) }} %</label>
                                    </td>
                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="8"> -- Data Kosong --</td>
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
@elseif (Auth::user()->role == 'Guru')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3 btn-rounded">Kembali</a>
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    Mata Pelajaran : {{ $item->nama_mata_pelajaran }} <br>
                    Kelas : {{ $item->kelas->jenjang }} {{ $item->kelas->kelas }} <br>
                    Wali Kelas : {{ $item->kelas->waliKelas->user->nama }} <br>
                    Total Siswa : {{ $item->kelas->totalSiswa($item->kelas->id) }} orang<br>
                </div>
                <div class="table-responsive">
                    <div class="">
                        <table class="table table-hover table-bordered w-100" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Total Sakit</th>
                                    <th>Total Izin</th>
                                    <th>Total Tanpa Keterangan</th>
                                    <th>Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($item->kelas->kelas_siswa as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->siswa->nis }}</td>
                                    <td>{{ $siswa->siswa->nama }}</td>
                                    <td>
                                        @if ($siswa->siswa->jenis_kelamin == 'L')
                                            <i class="mdi mdi-human-male text-primary" style="font-size: 30px"></i>
                                        @elseif ($siswa->siswa->jenis_kelamin == 'P')
                                            <i class="mdi mdi-human-female text-warning" style="font-size: 30px"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <label class="badge badge-primary">{{ $siswa->hitungStatus('Sakit', $siswa->siswa->nis, $item->id) }}</label>
                                    </td>
                                    <td>
                                        <label class="badge badge-warning">{{ $siswa->hitungStatus('Izin', $siswa->siswa->nis, $item->id) }}</label>
                                    </td>
                                    <td>
                                        <label class="badge badge-danger">{{ $siswa->hitungStatus('Tanpa Keterangan', $siswa->siswa->nis, $item->id) }}</label>
                                    </td>
                                    <td>
                                        <label class="badge badge-success">{{ $siswa->hitungPersentase2($siswa->siswa->nis, $item->id) }} %</label>
                                    </td>
                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="8"> -- Data Kosong --</td>
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
@elseif (Auth::user()->role == 'Waka-Kurikulum')
<div class="row">
    <div class="col-md-12">
        <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3 btn-rounded">Kembali</a>
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    Kelas : {{ $item->jenjang }} {{ $item->kelas }} <br>
                    Wali Kelas : {{ $item->waliKelas->user->nama }} <br>
                    Total Siswa : {{ $item->totalSiswa($item->id) }} orang<br>
                </div>
                <div class="table-responsive">
                    <div class="">
                        <table class="table table-hover table-bordered w-100" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Total Sakit</th>
                                    <th>Total Izin</th>
                                    <th>Total Tanpa Keterangan</th>
                                    <th>Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($item->kelas_siswa as $siswa)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $siswa->siswa->nis }}</td>
                                    <td>{{ $siswa->siswa->nama }}</td>
                                    <td>
                                        @if ($siswa->siswa->jenis_kelamin == 'L')
                                            <i class="mdi mdi-human-male text-primary" style="font-size: 30px"></i>
                                        @elseif ($siswa->siswa->jenis_kelamin == 'P')
                                            <i class="mdi mdi-human-female text-warning" style="font-size: 30px"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <label class="badge badge-primary">{{ $siswa->hitungStatus2('Sakit', $siswa->siswa->nis) }}</label>
                                    </td>
                                    <td>
                                        <label class="badge badge-warning">{{ $siswa->hitungStatus2('Izin', $siswa->siswa->nis) }}</label>
                                    </td>
                                    <td>
                                        <label class="badge badge-danger">{{ $siswa->hitungStatus2('Tanpa Keterangan', $siswa->siswa->nis) }}</label>
                                    </td>
                                    <td>
                                        <label class="badge badge-success">{{ $siswa->hitungPersentase2($siswa->siswa->nis) }} %</label>
                                    </td>
                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="8"> -- Data Kosong --</td>
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
@endif
@endsection

@push('addon-script')

@endpush
