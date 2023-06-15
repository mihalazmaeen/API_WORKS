<?php
use Illuminate\Support\Facades\Session;
?>
<!doctype html >
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Code Generator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<div class="container">
    <form id="" method="POST" action="{{route('code.generate')}}">
        <div class="row">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlSelect1">Code Format</label>
                <select class="form-control" id="exampleFormControlSelect1" name="starting_range">
                    <option value="" selected="" disabled="">Select Starting Range</option>
                    @foreach($generated as $item)
                        <option value="{{$item->generate}}" >{{$item->generate}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-4">
                <label for="name">Range Start</label>
                <select class="form-control" id="exampleFormControlSelect1" name="ending_range" id="ending_range" >
                    <option value="" selected="" disabled="">Select Ending Range</option>

                </select>

            </div>
            <div id="barcodes">

            </div>

            <div class="form-group col-md-4">
                <label for="name">Generate Amount</label>
                <input type="number" class="form-control" name="generate" id="generate"
                       placeholder="Enter Amount to be generated">
            </div>
            <div class="form-group col-md-8 pt-24">
                <button class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
</div>



<script type="text/javascript">
    {{--$(document).ready(function() {--}}
    {{--    $('select[name="starting_range"]').on('change', function() {--}}
    {{--        let starting_range = $(this).val();--}}
    {{--        if (starting_range) {--}}
    {{--            $.ajax({--}}
    {{--                url: "{{url('/print/latest/ajax')}}/" + starting_range,--}}
    {{--                type: "GET",--}}
    {{--                dataType: "json",--}}
    {{--                success: function(data) {--}}
    {{--                    console.log(data);--}}

    {{--                    $('select[name="ending_range"]').empty();--}}
    {{--                    let d = $('select[name="ending_range"]').empty();--}}
    {{--                    $.each(data, function(key, value) {--}}
    {{--                        $('select[name="ending_range"]').append('<option value="' + value.generate + '">' + value.generate + '</option>');--}}
    {{--                    });--}}
    {{--                    generateBarcodes();--}}
    {{--                }--}}
    {{--            });--}}
    {{--        } else {--}}
    {{--            alert('Please select a code format.');--}}
    {{--        }--}}
    {{--    });--}}

    {{--    $('select[name="ending_range"]').on('click', function() {--}}
    {{--        generateBarcodes(); // Generate and display barcodes--}}
    {{--    });--}}

    {{--    function generateBarcodes() {--}}
    {{--        let startingRange = $('select[name="starting_range"]').val();--}}
    {{--        let endingRange = $('select[name="ending_range"]').val();--}}

    {{--        if (startingRange && endingRange) {--}}
    {{--            let startingNumber = parseInt(startingRange.match(/\d+$/)[0]);--}}
    {{--            let endingNumber = parseInt(endingRange.match(/\d+$/)[0]);--}}

    {{--            // Clear existing barcodes--}}
    {{--            $('#barcodes').empty();--}}

    {{--            // Generate and append barcodes--}}
    {{--            for (let i = startingNumber; i <= endingNumber; i++) {--}}
    {{--                let regexPattern = /\d+$/;--}}
    {{--                let barcodeValue = startingRange.replace(regexPattern, i);--}}
    {{--                let barcode = "{!! \Milon\Barcode\DNS1D::getBarcodeHTML('" + value.generate + "', 'C39', 1, 33) !!}";--}}
    {{--                let barcodeHTML = '<p class="card-text">' + barcodeValue + '</p>';--}}
    {{--                $('#barcodes').append(barcodeHTML);--}}

    {{--            }--}}
    {{--        }--}}
    {{--    }--}}
    {{--});--}}


    $(document).ready(function() {
        $('select[name="starting_range"]').on('change', function() {
            let starting_range = $(this).val();
            if (starting_range) {
                $.ajax({
                    url: "{{ url('/print/latest/ajax') }}/" + starting_range,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);

                        $('select[name="ending_range"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="ending_range"]').append('<option value="' + value.generate + '">' + value.generate + '</option>');
                        });
                    }
                });
            } else {
                alert('Please select a code format.');
            }
        });

        $('select[name="ending_range"]').on('change', function() {
            generateBarcodes(); // Generate and display barcodes
        });

        function generateBarcodes() {
            let startingRange = $('select[name="starting_range"]').val();
            let endingRange = $('select[name="ending_range"]').val();

            if (startingRange && endingRange) {
                let startingNumber = parseInt(startingRange.match(/\d+$/)[0]);
                let endingNumber = parseInt(endingRange.match(/\d+$/)[0]);

                // Clear existing barcodes
                $('#barcodes').empty();

                // Generate and append barcodes
                for (let i = startingNumber; i <= endingNumber; i++) {
                    let barcodeValue = startingRange.replace(/\d+$/, i);
                    let barcodeHTML = '<svg id="barcode' + i + '"></svg>';
                    $('#barcodes').append(barcodeHTML);
                    JsBarcode("#barcode" + i, barcodeValue, {
                        format: "CODE39",
                        lineColor: "#000000",
                        width: 1,
                        height: 25,
                        displayValue: false
                    });
                }
            }
        }
    });


</script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
