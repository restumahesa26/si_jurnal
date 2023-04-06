@extends('layouts.admin')

@section('title')
    SIAS | Absensi
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('wali-kelas-absensi.index') }}" class="btn btn-warning btn-rounded text-white">Kembali</a>
        <div class="card mt-3">
            <div class="card-body">
                <div class="card-title">
                    Riwayat Absensi : {{ $siswa->nama }}
                </div>
                <div class="table-responsive">
                    <div class="">
                        <table class="table table-bordered table-hover w-100" id="table2">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Total Sakit</th>
                                    <th>Total Izin</th>
                                    <th>Total Tanpa Keterangan</th>
                                    <th>Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->mata_pelajaran->nama_mata_pelajaran }}</td>
                                        <td>{{ $item->kelas->jenjang }} {{ $item->kelas->kelas }}</td>
                                        <td>
                                            <label class="badge badge-primary">{{ $siswa->hitungStatus('Sakit', $siswa->nis, $item->id) }}</label>
                                        </td>
                                        <td>
                                            <label class="badge badge-warning">{{ $siswa->hitungStatus('Izin', $siswa->nis, $item->id) }}</label>
                                        </td>
                                        <td>
                                            <label class="badge badge-danger">{{ $siswa->hitungStatus('Tanpa Keterangan', $siswa->nis, $item->id) }}</label>
                                        </td>
                                        <td>
                                            <label class="badge badge-success">
                                                {{ $siswa->hitungPersentase($siswa->nis, $item->id) }} %
                                            </label>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="7">-- Data Absensi Kosong untuk Tahun Ajaran Sekarang --</td>
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
@endpush
