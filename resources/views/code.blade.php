<!doctype html>
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
</head>

<body>
<div class="container">
    <form id="" method="POST" action="{{route('code.generate')}}">
        <div class="row">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlSelect1">Code Format</label>
                <select class="form-control" id="exampleFormControlSelect1" name="code_format">
                    <option value="" selected="" disabled="">Select Your base</option>
                    @foreach($base_formats as $base)
                        <option value="{{$base->base_code}}" >{{$base->base_code}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="name">Range Start</label>
                <input type="text" class="form-control" name="range" id="range"
                       placeholder="Enter Start Range">
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
    $(document).ready(function() {
        $('select[name="code_format"]').on('change', function() {
            let code_format = $(this).val();
            if (code_format) {
                $.ajax({
                    url: "{{url('/generate/latest/ajax')}}/"+code_format,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        if (data) {
                            $('input[name="range"]').val(data.numbers ? data.numbers : data.range);
                        } else {
                            $('input[name="range"]').val('');
                        }
                    },

                });
            } else {
                alert('Please select a code format.');
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
