

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div class="container mt-4">
        @if (!empty($data))
            <h1 class="text-center">Data Grafik Login</h1>
            <table border="1" class="table table-success table-striped-columns">

                <thead>
                    <tr class="table-dark">
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Login</th>
                        <th scope="col">Logout</th>
                        <th scope="col">Lama Waktu</th>
                        <th class="text-center" scope="col">Action</th>
                    </tr>
                </thead>
                @php
                    $no = 1;
                @endphp

                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ // konversi timestamp ke waktu indonesia
                            date('d-m-Y H:i:s', strtotime($item['login_time'])) }}
                        </td>

                        @if ($item['logout_time'] != null)
                            <td>{{ date('d-m-Y H:i:s', strtotime($item['logout_time'])) }}</td>
                        @else
                            <td>Belum Logout</td>
                        @endif

                        @if ($item['logout_time'] != null)
                            <td>
                                {{ (new DateTime($item['logout_time']))->diff(new DateTime($item['login_time']))->h }}
                                Jam
                                {{ (new DateTime($item['logout_time']))->diff(new DateTime($item['login_time']))->i }}
                                Menit
                                {{ (new DateTime($item['logout_time']))->diff(new DateTime($item['login_time']))->s }}
                                Detik
                            </td>
                        @else
                            <td>
                                {{ (new DateTime($item['login_time']))->diff(new DateTime())->h }} Jam
                                {{ (new DateTime($item['login_time']))->diff(new DateTime())->i }} Menit
                                {{ (new DateTime($item['login_time']))->diff(new DateTime())->s }} Detik
                            </td>
                        @endif


                        <td class="d-flex justify-content-center">
                            {{-- <a class="btn btn-warning" href="{{ url('logout/' . $item['_id']) }}">Logout</a> || --}}
                            @if ($item['logout_time'] == null)
                                <form action="{{ url('/logout/user') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_id" value="{{ $item['_id'] }}">
                                    <button class="btn btn-warning" type="submit">Logout</button>
                                </form>
                                ||
                              <a class="btn btn-danger" href="{{ url('delete/' . $item['_id']) }}">Delete</a>
                            @else
                            {{-- delete data api --}}
                                <form action="{{ url('/delete/user') }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="_id" value="{{ $item['_id'] }}">
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            @endif

                        </td>
                    </tr>
                @endforeach
            @else
                <h1 class="text-center mt-4">Data Kosong</h1>


            </table>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>
