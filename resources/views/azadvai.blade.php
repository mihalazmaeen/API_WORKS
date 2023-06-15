<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
</head>
<body>
<div class="d-flex flex-column-fluid">
    <div class="container-fluid">
        <!--begin::Notice-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-5">
                <div class="card-title">
                    <h3 class="card-label"><i class="{{ $page_icon }} text-primary"></i> {{ $sub_title }}</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="" class="btn btn-warning btn-sm font-weight-bolder">
                        <i class="fas fa-arrow-left"></i> Back</a>
                    <!--end::Button-->
                </div>
            </div>
        </div>
        <!--end::Notice-->
        <!--begin::Card-->
        <div class="card card-custom" style="padding-bottom: 100px !important;">
            <div class="card-body" style="padding-bottom: 100px !important;">
                <!--begin: Datatable-->
                <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer pb-5">

                    <form id="generate-barcode-form" method="POST">
                        @csrf
                        <div class="row">
                            <input type="hidden" class="form-control" name="barcodeprint_name" id="barcodeprint_name">
                            <input type="hidden" class="form-control" name="barcodeprint_code" id="barcodeprint_code">
                            <input type="hidden" class="form-control" name="barcodeprint_price" id="barcodeprint_price">
                            <input type="hidden" class="form-control" name="barcode_symbology" id="barcode_symbology">
                            <input type="hidden" class="form-control" name="tax_rate" id="tax_rate">
                            <input type="hidden" class="form-control" name="tax_method" id="tax_method">

                            <x-form.selectbox labelName="Barcode Start" name="mdata_barcode_prefix_number_start" onchange="getVariantOptionList(this.value)" col="col-md-4" class="selectpicker">
{{--                                @if (!$barcodeGenerates->isEmpty())--}}
{{--                                    @foreach ($barcodeGenerates as $barcodeGenerate)--}}
{{--                                        <option value="{{ $barcodeGenerate->mdata_barcode_prefix_number }}">{{ $barcodeGenerate->mdata_barcode_prefix_number }}</option>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
                            </x-form.selectbox>
                            <x-form.selectbox labelName="Barcode End" name="mdata_barcode_prefix_number_end" col="col-md-4 mdata_barcode_prefix_number_end" class="selectpicker" />
                            <x-form.textbox labelName="No. of Barcode" name="barcode_qty" required="required" col="col-md-2" class="text-center" value="1" placeholder="Enter barcode print quantity"/>
                            <x-form.textbox labelName="Qunatity Each Row" name="row_qty" required="required" col="col-md-2" class="text-center" value="1" placeholder="Enter barcode print quantity"/>
                            <div class="form-group col-md-2">
                                <label for="">Print With</label>
                                <div class="div">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="pname">
                                        <label class="custom-control-label" for="pname">barcodeprint Name</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="price">
                                        <label class="custom-control-label" for="price">Price</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-3" style="padding-top:28px;">
                                <button type="button" class="btn btn-primary btn-sm" id="generate-barcode"><i class="fas fa-barcode"></i>Generate Barcode</button>
                            </div>
                        </div>
                    </form>

                    <div class="row" id="barcode-section">

                    </div>
                </div>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
