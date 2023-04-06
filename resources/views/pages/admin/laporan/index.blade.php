@extends('layouts.admin')

@section('title')
    SIAS | Laporan
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Cetak Absen Berdasarkan Kelas</div>
                        <form action="{{ route('laporan.cetak-kelas-excel') }}" method="get" target="_blank">
                            <div class="form-group">
                                <label for="kelas">Pilih Kelas</label>
                                <select name="kelas" id="kelas" class="kelas w-100" required>
                                    <option value=""></option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}" @if(old('kelas') == $item->id) selected @endif>{{ $item->jenjang }} {{ $item->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Cetak Laporan Excel</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Cetak Absen Sesuai Mata Pelajaran</div>
                        <form action="{{ route('laporan.cetak-mapel-excel') }}" method="get" target="_blank">
                            <div class="form-group">
                                <label for="mapel">Pilih Mata Pelajaran</label>
                                <select name="mapel" id="mapel" class="mapel w-100" required>
                                    <option value=""></option>
                                    @foreach ($items2 as $item2)
                                        <option value="{{ $item2->id }}" @if(old('mapel') == $item2->id) selected @endif>{{ $item2->nama_mata_pelajaran }}  - {{ $item2->kelas->jenjang }} {{ $item2->kelas->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Cetak Laporan Excel</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Cetak Absen Seluruh Siswa</div>
                        <a href="{{ route('laporan.cetak-semua-excel') }}" target="_blank" class="btn btn-success">Cetak Laporan Excel</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Cetak Absen Berdasarkan Kelas</div>
                        <form action="{{ route('laporan.cetak-kelas') }}" method="get" target="_blank">
                            <div class="form-group">
                                <label for="kelas_2">Pilih Kelas</label>
                                <select name="kelas" id="kelas_2" class="kelas_2 w-100" required>
                                    <option value=""></option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}" @if(old('kelas') == $item->id) selected @endif>{{ $item->jenjang }} {{ $item->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger">Cetak Laporan PDF</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Cetak Absen Sesuai Mata Pelajaran</div>
                        <form action="{{ route('laporan.cetak-mapel') }}" method="get" target="_blank">
                            <div class="form-group">
                                <label for="mapel_2">Pilih Mata Pelajaran</label>
                                <select name="mapel" id="mapel_2" class="mapel_2 w-100" required>
                                    <option value=""></option>
                                    @foreach ($items2 as $item2)
                                        <option value="{{ $item2->id }}" @if(old('mapel') == $item2->id) selected @endif>{{ $item2->nama_mata_pelajaran }} - {{ $item2->kelas->jenjang }} {{ $item2->kelas->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger">Cetak Laporan PDF</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Cetak Absen Seluruh Siswa</div>
                        <a href="{{ route('laporan.cetak-semua') }}" target="_blank" class="btn btn-danger">Cetak Laporan PDF</a>
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Kepala Sekolah')
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Cetak Jurnal Sesuai Guru Excel</div>
                        <form action="{{ route('laporan.cetak-jurnal-guru-excel') }}" method="get" target="_blank">
                            <div class="form-group">
                                <label for="nip">Pilih Guru</label>
                                <select name="nip" id="nip" class="nip w-100" required>
                                    <option value=""></option>
                                    @foreach ($items3 as $item3)
                                        <option value="{{ $item3->nip }}" @if(old('nip') == $item3->nip) selected @endif>{{ $item3->user->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Cetak Laporan Excel</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Cetak Jurnal Sesuai Guru PDF</div>
                        <form action="{{ route('laporan.cetak-jurnal-guru') }}" method="get" target="_blank">
                            <div class="form-group">
                                <label for="nip_2">Pilih Guru</label>
                                <select name="nip" id="nip_2" class="nip_2 w-100" required>
                                    <option value=""></option>
                                    @foreach ($items3 as $item3)
                                        <option value="{{ $item3->nip }}" @if(old('nip') == $item3->nip) selected @endif>{{ $item3->user->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger">Cetak Laporan PDF</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif

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
            $('.kelas').select2({
                placeholder: "-- Pilih Kelas --",
                allowClear: true,
                theme: "classic",
            });

            $('.mapel').select2({
                placeholder: "-- Pilih Mata Pelajaran --",
                allowClear: true,
                theme: "classic",
            });

            $('.nip').select2({
                placeholder: "-- Pilih Guru --",
                allowClear: true,
                theme: "classic",
            });
        });
        $(document).ready(function() {
            $('.kelas_2').select2({
                placeholder: "-- Pilih Kelas --",
                allowClear: true,
                theme: "classic",
            });

            $('.mapel_2').select2({
                placeholder: "-- Pilih Mata Pelajaran --",
                allowClear: true,
                theme: "classic",
            });

            $('.nip_2').select2({
                placeholder: "-- Pilih Guru --",
                allowClear: true,
                theme: "classic",
            });
        });

    </script>

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
