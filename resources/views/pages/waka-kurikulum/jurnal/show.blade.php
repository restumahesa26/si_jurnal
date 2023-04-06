@extends('layouts.admin')

@section('title')
    SIAS | Jurnal
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('waka-kurikulum-jurnal.index') }}" class="btn btn-warning btn-rounded text-white">Kembali</a>
        <div class="card mt-3">
            <div class="card-body">
                <h4 class="card-title">Riwayat Jurnal {{ $items->first()->mataPelajaran->nama_mata_pelajaran }} {{ $items->first()->mataPelajaran->kelas->jenjang }} {{ $items->first()->mataPelajaran->kelas->kelas }}</h4>
                <div class="table-responsive">
                    <div class="">
                        <table class="table table-hover table-bordered" id="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Topik Pembelajaran</th>
                                    <th>Kegiatan Belajar</th>
                                    <th>Kendala Belajar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l, d F Y') }}</td>
                                    <td>{{ $item->topik_pembelajaran }}</td>
                                    <td>{{ $item->kegiatan_belajar }}</td>
                                    <td>{{ $item->kendala_belajar }}</td>
                                </tr>
                                @empty
                                <tr class="text-center">
                                    <td colspan="5">-- Data Wali Siswa Masih Kosong --</td>
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
