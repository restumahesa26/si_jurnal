@extends('layouts.admin')

@section('title')
    SIAS | Jurnal
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    Silahkan Pilih Mata Pelajaran
                </div>
                <form action="{{ route('waka-kurikulum-jurnal.show') }}" method="get">
                    <div class="form-group">
                        <label for="mapel_id" class="text-dark">Mata Pelajaran</label>
                        <select class="form-control mapel_id" id="mapel_id" name="mapel_id">
                            <option value=""></option>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}" @if(old('mapel_id') == $item->id) selected @endif>{{ $item->nama_mata_pelajaran }} - {{ $item->kelas->jenjang }} {{ $item->kelas->kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
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

<script>
    $(document).ready(function() {
        $('.mapel_id').select2({
            placeholder: "-- Pilih Mata Pelajaran --",
            allowClear: true,
            theme: "classic",
        });
    });
</script>
@endpush
