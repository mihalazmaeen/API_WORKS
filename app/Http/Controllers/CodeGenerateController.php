<?php

namespace App\Http\Controllers;

use App\Models\base_table;
use App\Models\CodeGenerate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Milon\Barcode\DNS1D;

class CodeGenerateController extends Controller
{
    public function PrintGeneratedBarcode(){
        $generated=CodeGenerate::where('status',2)->orderBy('code_format','asc')->orderBy('range','asc')->get('generate');
//        dd($generated);
        return view('print',compact('generated'));
    }

    public function ShowDemo(){
        return view('azadvai');
    }

    public function ShowReport(){
        $data=[];

        $base_codes=CodeGenerate::groupBy('code_format')->get(['code_format']);
        foreach($base_codes as $base_code){
            $report=[];
            $report['starting']= CodeGenerate::where('code_format',$base_code->code_format)->first('generate');

            $report['ending'] = CodeGenerate::where('code_format', $base_code->code_format)->latest('generate')->first('generate');

            $report['unused']= CodeGenerate::where('code_format',$base_code->code_format)->where('status',2) ->count('generate');
            $report['used']= CodeGenerate::where('code_format',$base_code->code_format)->where('status',1) ->count('generate');
            $report['total']= CodeGenerate::where('code_format',$base_code->code_format)->count('generate');

          $data[] = $report;
        }
return view('report',compact('data'));
//      return response()->json($data);
    }

    public function CodeGenerate(){
        $base_formats=base_table::get();
        foreach($base_formats as $base){
            $check=CodeGenerate::where('code_format',$base->base_code)->get();
            if($check->isEmpty()){
                $check=base_table::where('base_code',$base->base_code)->get();
            }else{
                $check = CodeGenerate::where('code_format', $base->base_code)->latest('range')->first();
            }
            $results[] = $check;
        }
//        return response()->json($results);
    return view('code',compact('base_formats','check','results'));
    }

    public function GetLatestRange($code_format){
        $check=CodeGenerate::where('code_format',$code_format)->get();
        if($check->isEmpty()){
            $check=base_table::select('numbers')->where('base_code',$code_format)->latest('numbers')->first();
        }else{
            $check = CodeGenerate::select('range')->where('code_format', $code_format)->latest('range')->first();
        }
        return json_encode($check);

    }
    public function CodeGenerateUsingRange(Request $request){
        set_time_limit(3600);
        $data = array();
        $data['code_format'] = $request->code_format;
        $data['range'] = $request->range;
        $data['generate'] = $request->generate;
        $check = CodeGenerate::where('code_format', $request->code_format)->latest('range')->first();
        if(empty($check)){
            foreach (range(0, $request->generate - 1) as $i) {



                $data['range'] = $request->range + $i; // Increase the value of $data['range'] by 1
                $data['create_date'] = Carbon::now()->toDateTimeString();
                $data['status'] = '2';
                $data['concat'] = $data['code_format'].$data['range'];
                $data['barcode'] = DNS1D::getBarcodeHTML($data['concat'], 'C39+', 1, 33);
                $data['barcodeBase64'] = base64_encode($data['barcode']);






                // Insert the data into the database
                DB::table('code_generates')->insert([
                    'code_format' => $data['code_format'],
                    'range' => $data['range'],
                    'generate'=>$data['concat'],
                    'barcode'=> $data['barcodeBase64'],
                    'created_at' => $data['create_date'],
                    'status' => $data['status'],
                ]);


                $jsonObjects[] = $data;
            }
        }else{
            foreach (range(0, $request->generate - 1) as $i) {



                $data['range']++; // Increase the value of $data['range'] by 1
                $data['create_date'] = Carbon::now()->toDateTimeString();
                $data['status'] = '2';
                $data['concat'] = $data['code_format'].$data['range'];
                $data['barcode'] = DNS1D::getBarcodeHTML($data['concat'], 'C39');
                $data['barcodeBase64'] = base64_encode($data['barcode']);






                // Insert the data into the database
                DB::table('code_generates')->insert([
                    'code_format' => $data['code_format'],
                    'range' => $data['range'],
                    'generate'=>$data['concat'],
                    'barcode'=> $data['barcodeBase64'],
                    'created_at' => $data['create_date'],
                    'status' => $data['status'],
                ]);


                $jsonObjects[] = $data;
            }
        }

        $jsonObjects = array(); // Array to store each iteration as a JSON object



        $new_range = $data['range'];
        $responseData = [
            'jsonObjects' => $jsonObjects,
            'new_range' => $new_range,
        ];
        return response()->json($responseData);


//        foreach (range(0, $request->generate - 1) as $i) {
//            $data['range']++;
//            print_r($data);
//
//
////            return response()->json($data);
//
//        }
//        return $data;
    }
    public function CodeView(){
        $barcodes= CodeGenerate::all();
        return view('view-code',compact('barcodes'));
    }
}
