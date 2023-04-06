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
                        <div class="card-title">Cetak Absen Format Excel</div>
                        <form action="{{ route('laporan.cetak-siswa-excel') }}" method="get" target="_blank">
                            <div class="form-group">
                                <label for="nis">Pilih Siswa</label>
                                <select name="nis" id="nis" class="nis w-100">
                                    <option value=""></option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->nis }}" @if(old('nis') == $item->nis) selected @endif>{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mapel">Pilih Mata Pelajaran</label>
                                <select name="mapel_id" id="mapel" class="mapel w-100">
                                    <option value=""></option>
                                    @foreach ($items2 as $item)
                                        <option value="{{ $item->id }}" @if(old('mapel_id') == $item->id) selected @endif>{{ $item->mata_pelajaran->nama_mata_pelajaran }} -{{ $item->kelas->jenjang }} {{ $item->kelas->kelas }}</option>
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
                        <div class="card-title">Cetak Absen Format PDF</div>
                        <form action="{{ route('laporan.cetak-siswa-pdf') }}" method="get" target="_blank">
                            <div class="form-group">
                                <label for="nis_2">Pilih Siswa</label>
                                <select name="nis" id="nis_2" class="nis_2 w-100">
                                    <option value=""></option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->nis }}" @if(old('nis') == $item->nis) selected @endif>{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="mapel_2">Pilih Mata Pelajaran</label>
                                <select name="mapel_id" id="mapel_2" class="mapel_2 w-100">
                                    <option value=""></option>
                                    @foreach ($items2 as $item)
                                        <option value="{{ $item->id }}" @if(old('mapel_id') == $item->id) selected @endif>{{ $item->mata_pelajaran->nama_mata_pelajaran }} -{{ $item->kelas->jenjang }} {{ $item->kelas->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-danger">Cetak Laporan PDF</button>
                        </form>
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
            $('.mapel').select2({
                placeholder: "-- Pilih Mata Pelajaran --",
                allowClear: true,
                theme: "classic",
            });
        });
        $(document).ready(function() {
            $('.nis_2').select2({
                placeholder: "-- Pilih Siswa --",
                allowClear: true,
                theme: "classic",
            });
            $('.mapel_2').select2({
                placeholder: "-- Pilih Mata Pelajaran --",
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
