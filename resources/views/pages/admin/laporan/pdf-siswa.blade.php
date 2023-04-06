<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Absen</title>
    <link rel="shortcut icon" href="{{ url('logo_si_mini.svg') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        @media print{
            @page {
                size: landscape
            }
        }

        body {
            font-family: 'Times New Roman';
        }

        table tr th, table tr td {
            font-size: 13px;
        }

        .table-bordered tr td {
            padding: 8px !important;
        }

        .table-bordered th, .table-bordered td{
            border: 1px solid #2C3333 !important;
        }
    </style>
</head>
<body>
    <h4 class="text-center font-weight-bold" style="font-size: 18px;">Rekap Absen Semua Siswa</h4>
    <div class="table-responsive mt-3">
        <table class="table table-hover table-bordered" id="table1">
            <thead>
                <tr class="text-center">
                    <th style="vertical-align : middle; text-align:center;">NISN</th>
                    <th style="vertical-align : middle; text-align:center;">Nama</th>
                    <th style="vertical-align : middle; text-align:center; width: 15%">Jenis Kelamin</th>
                    <th style="width: 5%">Total Hadir</th>
                    <th style="width: 5%">Total Sakit</th>
                    <th style="width: 5%">Total Izin</th>
                    <th style="width: 10%">Total Tanpa Keterangan</th>
                    <th style="vertical-align : middle; text-align:center; width: 5%">Persentase Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $siswa)
                <tr>
                    <td>{{ $siswa->nis }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>
                        @if ($siswa->jenis_kelamin == 'L')
                            Laki-Laki
                        @elseif ($siswa->jenis_kelamin == 'P')
                            Perempuan
                        @endif
                    </td>
                    <td class="text-center">
                        {{ $siswa->hitungStatus2('Hadir', $siswa->nis) != 0 ? $siswa->hitungStatus2('Hadir', $siswa->nis) : '-' }}
                    </td>
                    <td class="text-center">
                        {{ $siswa->hitungStatus2('Sakit', $siswa->nis) != 0 ? $siswa->hitungStatus2('Sakit', $siswa->nis) : '-' }}
                    </td>
                    <td class="text-center">
                        {{ $siswa->hitungStatus2('Izin', $siswa->nis) != 0 ? $siswa->hitungStatus2('Izin', $siswa->nis) : '-' }}
                    </td>
                    <td class="text-center">
                        {{ $siswa->hitungStatus2('Tanpa Keterangan', $siswa->nis) != 0 ? $siswa->hitungStatus2('Tanpa Keterangan', $siswa->nis) : '-' }}
                    </td>
                    <td class="text-center">
                        {{ $siswa->hitungPersentase2($siswa->nis) != 0 ? $siswa->hitungPersentase2($siswa->nis) : '0' }} %
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
</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script>
    window.print()
</script>
</html>