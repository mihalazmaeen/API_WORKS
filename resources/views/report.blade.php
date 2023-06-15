<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcode Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
</head>

<body>
<div class="container">
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th>Barcode Starting</th>
                <th>Barcode Ending</th>
                <th>Used</th>
                <th>Unused</th>
                <th>Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item['starting']->generate  }}</td>
                    <td>{{ $item['ending']->generate  }}</td>
                    <td>{{ $item['used'] }}</td>
                    <td>{{ $item['unused'] }}</td>
                    <td>{{ $item['total'] }}</td>

                </tr>
            @endforeach



            </tbody>
        </table>
    </div>
</div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
