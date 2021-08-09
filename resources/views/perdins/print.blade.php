<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    {{-- <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
            text-align: center;
		}
	</style>
</head>
<body>
    <header class="mb-5">
        <table class="table-borderless"  style="width:100%">
            <tr>
                <td style="width:20%">
                    <img src="{{ asset('logo.png') }}">
                </td>
                <td  style="width:80%" class="text-center">
                    <h2>PT. Akhdani Reka Solusi</h2>
                    <p>Jl. Cikutra Baru No.23, Neglasari, Kec. Cibeunying Kaler, Kota Bandung, Jawa Barat 40124</p>
                </td>
            </tr>
        </table>
    </header>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>No Perdin</th>
                <th>Nama</th>
                <th>Nip</th>
                <th>Jabatan</th>
                <th>Activity</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($perdin->log as $address)
                <tr class="active-row">
                    <td>{{ $perdin->no_perdin }}</td>
                    <td>{{ $address->name }}</td>
                    <td>{{ $address->nip }}</td>
                    <td>{{ $address->jabatan }}</td>
                    <td>{{ $address->activity }}</td>
                    <td>{{ $address->created_at->diffForHumans() }}</td>
                </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr class="active-row">
            </tr>
        </tfoot>
    </table>
    <div class="row">
        <div class="col-12">
            <div class="mt-2 float-left text-center">
                <br>
                <span>Menyetujui</span>
                <br>
                <br>
                <br>
                <br>
                <span class="mt-5">
                    <u>{{ $perdin->approve_by['nama'] }}</u>
                </span>
                <br>
                <span>{{ $perdin->approve_by['jabatan'] }}</span>
            </div>
        </div>
        <div class="col-12">
            <div class="mt-2 float-right text-center">
                <span>{{ $datePrint }}</span>
                <br>
                <span>Pembuat</span>
                <br>
                <br>
                <br>
                <br>
                <span class="mt-5">
                    <u>{{ $perdin->pembuat['nama'] }}</u>
                </span>
                <br>
                <span>{{ $perdin->pembuat['jabatan'] }}</span>
            </div>
        </div>
    </div>
</body>
</html>