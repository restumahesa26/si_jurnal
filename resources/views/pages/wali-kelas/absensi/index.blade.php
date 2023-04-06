@extends('layouts.admin')

@section('title')
    SIAS | Absensi
@endsection

@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    Silahkan Pilih Siswa
                </div>
                <form action="{{ route('wali-kelas-absensi.show') }}" method="get">
                    <div class="form-group">
                        <label for="nis" class="text-dark">Siswa</label>
                        <select class="form-control nis" id="nis" name="nis">
                            <option value=""></option>
                            @foreach ($items as $item)
                                <option value="{{ $item->nis }}" @if(old('nis') == $item->nis) selected @endif>{{ $item->nama }}</option>
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
