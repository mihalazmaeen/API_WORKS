<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Code Generator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
<div class="container">
    <div class="container">
        <h1>Barcodes</h1>
        <div class="row">
            @foreach($barcodes as $barcode)
                <div class="col-md-4">
                    <div class="card mb-3">





                        <div class="card-body">
                            <p class="card-text">{!! \Milon\Barcode\DNS1D::getBarcodeHTML($barcode->generate, 'C39',1,33) !!}</p>

{{--                            <img src="data:image/png;base64,{!! $barcode->barcode !!}" >--}}

                            <h5 class="card-title">Barcode ID: {{ $barcode->id }}</h5>
                            <p class="card-text">Code: {{ $barcode->code_format }}</p>
                            <p class="card-text">Range: {{ $barcode->range }}</p>
                            <p class="card-text">Created At: {{ $barcode->created_at }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>




<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
