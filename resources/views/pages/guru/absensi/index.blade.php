@extends('layouts.admin')

@section('title')
    SIAS | Absensi
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{ route('absensi.select') }}" class="btn btn-primary mb-3 btn-rounded">Kembali</a>
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    Mata Pelajaran {{ $item->nama_mata_pelajaran }} <br>
                    Kelas {{ $item->kelas->jenjang }} {{ $item->kelas->kelas }}
                </div>
                @php
                $check2 = $item->checkJurnal($item->id);
                @endphp
                @if ($check2 == 'Success')
                <form action="{{ route('jurnal.store', ['mapel_id' => $item->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="topik_pembelajaran" class="text-dark">Topik Pembelajaran</label>
                        <input type="text" name="topik_pembelajaran" class="form-control @error('topik_pembelajaran') is-invalid @enderror" id="topik_pembelajaran" placeholder="Masukkan Topik Pembelajaran" value="{{ old('topik_pembelajaran') }}" required>
                        @error('topik_pembelajaran')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kegiatan_belajar" class="text-dark">Kegiatan Belajar</label>
                        <textarea name="kegiatan_belajar" id="kegiatan_belajar" cols="30" rows="10" class="form-control"
                            required placeholder="Masukkan Kegiatan Belajar">{{ old('kegiatan_belajar') }}</textarea>
                        @error('kegiatan_belajar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="kendala_belajar" class="text-dark">Kendala Belajar</label>
                        <textarea name="kendala_belajar" id="kendala_belajar" cols="30" rows="10" class="form-control"
                            required placeholder="Masukkan Kendala Belajar">{{ old('kendala_belajar') }}</textarea>
                        @error('kendala_belajar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-block btn-primary btn-md w-100 mt-3">Simpan Jurnal</button>
                </form>
                @elseif ($check2 == 'Error')
                <div class="form-group">
                    <label for="topik_pembelajaran" class="text-dark">Topik Pembelajaran</label>
                    <input type="text" name="topik_pembelajaran" class="form-control @error('topik_pembelajaran') is-invalid @enderror" id="topik_pembelajaran" placeholder="Masukkan Topik Pembelajaran" value="{{ old('topik_pembelajaran', $item->getJurnal->topik_pembelajaran) }}" disabled>
                </div>
                <div class="form-group">
                    <label for="kegiatan_belajar" class="text-dark">Kegiatan Belajar</label>
                    <textarea name="kegiatan_belajar" id="kegiatan_belajar" cols="30" rows="10" class="form-control"
                        disabled placeholder="Masukkan Kegiatan Belajar">{{ old('kegiatan_belajar', $item->getJurnal->kegiatan_belajar) }}</textarea>
                </div>
                <div class="form-group">
                    <label for="kendala_belajar" class="text-dark">Kendala Belajar</label>
                    <textarea name="kendala_belajar" id="kendala_belajar" cols="30" rows="10" class="form-control"
                        disabled placeholder="Masukkan Kendala Belajar">{{ old('kendala_belajar', $item->getJurnal->kendala_belajar) }}</textarea>
                </div>
                @php
                $check = $item->checkAbsen($item->id);
                @endphp
                @if ($check == 'Success')
                <form action="{{ route('absensi.store', ['mapel_id' => $item->id]) }}" method="POST" class="mt-3">
                    @csrf
                    <div class="table-responsive">
                        <div class="">
                            <table class="table table-hover table-bordered" id="table1">
                                <thead>
                                    <tr>
                                        <th>NIS</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th style="width: 20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($item->kelas->kelas_siswa as $siswa)
                                    <tr>
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
                                            <select class="form-control" id="status" name="status[]"
                                                style="color: #000;">
                                                <option value="Hadir">Hadir</option>
                                                <option value="Sakit">Sakit</option>
                                                <option value="Izin">Izin</option>
                                                <option value="Tanpa Keterangan">Tanpa Keterangan</option>
                                            </select>
                                        </td>
                                        <input type="hidden" name="kelas_siswa_id[]" value="{{ $siswa->id }}">
                                    </tr>
                                    @empty
                                    <tr class="text-center">
                                        <td colspan="7"> -- Data Kosong --</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary btn-md w-100 mt-3">Simpan Absensi</button>
                </form>
                @else
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="table1">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th style="width: 20%">Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($item->getAbsen as $absen)
                            <tr>
                                <td>{{ $absen->kelasSiswa->siswa->nis }}</td>
                                <td>{{ $absen->kelasSiswa->siswa->nama }}</td>
                                <td>
                                    @if ($absen->kelasSiswa->siswa->jenis_kelamin == 'L')
                                            <i class="mdi mdi-human-male text-primary" style="font-size: 30px"></i>
                                    @elseif ($absen->kelasSiswa->siswa->jenis_kelamin == 'P')
                                        <i class="mdi mdi-human-female text-warning" style="font-size: 30px"></i>
                                    @endif
                                </td>
                                <td>
                                    <label class="badge
                                    @if($absen->status == 'Hadir') badge-primary
                                    @elseif ($absen->status == 'Sakit') badge-info
                                    @elseif ($absen->status == 'Izin') badge-warning
                                    @elseif ($absen->status == 'Tanpa Keterangan') badge-danger
                                    @endif">{{ $absen->status }}</label>
                                </td>
                            </tr>
                            @empty
                            <tr class="text-center">
                                <td colspan="7"> -- Data Kosong --</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <h4 class="text-success mt-3">Daftar Hadir Telah Disimpan, Silahkan Hubungi Admin Apabila Terdapat Kesalahan Dalam Pengisian Daftar Hadir</h4>
                </div>
                @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="{{ url('js/sweetalert2.all.min.js') }}"></script>

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
