@extends('layouts.admin')

@section('title')
    SIAS | Jurnal
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    Daftar Mata Pelajaran Yang Diampu Hari Ini
                    <ul class="nav nav-pills mt-3" role="tablist">
                        @forelse ($items as $item)
                        <li class="nav-item">
                            <button type="button" class="nav-link {{ $item == $items->first() ? 'active' : '' }}" role="tab" data-toggle="pill"
                                data-target="#mapel{{ $item->id }}" aria-controls="#mapel{{ $item->id }}" aria-selected="true">
                                {{ $item->mata_pelajaran->nama_mata_pelajaran }} - {{ $item->kelas->jenjang }} {{ $item->kelas->kelas }}
                            </button>
                        </li>
                        @empty
                        <h4 class="text-primary">Tidak Ada Jadwal Mengajar Hari Ini</h4>
                        @endforelse
                    </ul>
                    <div class="tab-content mt-3" style="border: none; padding: 0px;">
                        @forelse ($items as $item)
                        @php
                            $check = $item->checkJurnal($item->id);
                        @endphp
                        @if ($check == 'Success')
                        <div class="tab-pane fade {{ $item == $items->first() ? 'active show' : '' }}" id="mapel{{ $item->id }}" role="tabpanel">
                            <form action="{{ route('jurnal.store', ['mapel_id' => $item->id]) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="pokok_bahasan">Pokok Bahasan</label>
                                    <input type="text" name="pokok_bahasan" class="form-control @error('pokok_bahasan') is-invalid @enderror" id="pokok_bahasan" placeholder="Masukkan Pokok Bahasan" value="{{ old('pokok_bahasan') }}" required>
                                    @error('pokok_bahasan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-block btn-primary btn-md w-100 mt-3">Simpan</button>
                            </form>
                        </div>
                        @elseif ($check == 'Error')
                        <div class="tab-pane fade {{ $item == $items->first() ? 'active show' : '' }}" id="mapel{{ $item->id }}" role="tabpanel">
                            <div class="form-group">
                                <label for="pokok_bahasan">Pokok Bahasan</label>
                                <input type="text" name="pokok_bahasan" class="form-control @error('pokok_bahasan') is-invalid @enderror" id="pokok_bahasan" placeholder="Masukkan Pokok Bahasan" value="{{ $item->getJurnal->pokok_bahasan }}" readonly>
                                @error('pokok_bahasan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="text-center">
                                <h4 class="text-success mt-3">Jurnal Telah Disimpan, Silahkan Hubungi Admin Apabila Terdapat Kesalahan Dalam Pengisian Jurnal</h4>
                            </div>
                        </div>
                        @endif

                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-style')
<link href="{{ url('backend/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" >
@endpush

@push('addon-script')
<script src="{{ url('backend/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

<script>
    $('#tanggal').datepicker({
        format: 'yyyy-mm-dd',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true,
    });
    $('#tanggal').keypress(function(e) {
        e.preventDefault();
    });
</script>
@endpush
