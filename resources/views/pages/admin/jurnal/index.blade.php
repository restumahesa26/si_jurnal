@extends('layouts.admin')

@section('title')
    SIAS | Jurnal
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            Silahkan Masukkan Mata Pelajaran dan Tanggal Jurnal Yang Ingin Dikoreksi
                        </div>
                        <form action="{{ route('admin-jurnal.show') }}">
                            @csrf
                            <div class="form-group">
                                <label for="mapel_id">Mata Pelajaran</label>
                                <select class="guru w-100" id="mapel_id" name="mapel_id" required>
                                    <option value=""></option>
                                    @foreach ($mapel as $item)
                                        <option value="{{ $item->id }}" @if(old('mapel_id') == $item->id) selected @endif>{{ $item->mata_pelajaran->nama_mata_pelajaran }} - {{ $item->kelas->jenjang }} {{ $item->kelas->kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pertemuan">Pertemuan</label>
                                <input type="number" name="pertemuan" id="pertemuan" class="form-control" required value="{{ old('pertemuan') }}" placeholder="Masukkan Pertemuan" autocomplete="off">
                            </div>
                            <button type="submit" class="btn btn-primary">Ubah Jurnal</button>
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
    <link href="{{ url('backend/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" >
@endpush

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.guru').select2({
            placeholder: "-- Pilih Mata Pelajaran --",
            allowClear: true,
            theme: "classic",
        });
    });
</script>
    <script src="{{ url('backend/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

    <script>
        $('#tanggal').datepicker({
            format: 'yyyy/mm/dd',
            todayBtn: 'linked',
            todayHighlight: true,
            autoclose: true,
        });
        $('#tanggal').keypress(function(e) {
            e.preventDefault();
        });
    </script>

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
