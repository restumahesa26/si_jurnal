<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Jurnal</title>
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
            font-size: 10px;
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
    <h4 class="text-center font-weight-bold" style="font-size: 18px;">Jurnal Guru</h4>
    <div class="table-responsive">
        <table class="table table-hover table-bordered" id="table1">
            <thead>
                <tr class="text-center">
                    <th style="vertical-align : middle; text-align:center; width: 3%">No</th>
                    <th style="vertical-align : middle; text-align:center; width: 10%">Mata Pelajaran</th>
                    <th style="vertical-align : middle; text-align:center; width: 6%">Kelas</th>
                    <th style="vertical-align : middle; text-align:center; width: 13%">Pertemuan</th>
                    <th style="vertical-align : middle; text-align:center; width: 45%">Pokok Bahasan</th>
                    <th style="vertical-align : middle; text-align:center; width: 4%">Total Sakit</th>
                    <th style="vertical-align : middle; text-align:center; width: 4%">Total Izin</th>
                    <th style="vertical-align : middle; text-align:center; width: 4%">Total Alfa</th>
                    <th style="vertical-align : middle; text-align:center; width: 6%">Persentase Kehadiran</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                <tr>
                    <td style="vertical-align : middle; text-align:center;">{{ $loop->iteration }}</td>
                    <td style="vertical-align : middle; text-align:center;">{{ $item->mataPelajaran->mata_pelajaran->nama_mata_pelajaran }}</td>
                    <td style="vertical-align : middle; text-align:center;">{{ $item->mataPelajaran->kelas->jenjang }} {{ $item->mataPelajaran->kelas->kelas }}</td>
                    <td style="vertical-align : middle; text-align:center;">Ke - {{ $item->pertemuan }}</td>
                    <td style="vertical-align : middle;">{{ $item->pokok_bahasan }}</td>
                    <td style="vertical-align : middle; text-align:center;">{{ $item->hitungStatus('Sakit', $item->mapel_id, $item->pertemuan) }}</td>
                    <td style="vertical-align : middle; text-align:center;">{{ $item->hitungStatus('Izin', $item->mapel_id, $item->pertemuan) }}</td>
                    <td style="vertical-align : middle; text-align:center;">{{ $item->hitungStatus('Tanpa Keterangan', $item->mapel_id, $item->pertemuan) }}</td>
                    <td style="vertical-align : middle; text-align:center;">{{ $item->persentaseKehadiran($item->mapel_id) }} %</td>
                </tr>
                @empty
                <tr class="text-center">
                    <td colspan="9"> -- Data Kosong --</td>
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
