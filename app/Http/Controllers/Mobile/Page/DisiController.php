<?php
namespace App\Http\Controllers\Mobile\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\DigitalLiterasi;
class DisiController extends Controller
{
    public function getDisi(Request $request){
        $validator = Validator::make($request->only('id_disi'), [
            'id_disi'=>'required',
        ], [
            'id_disi.required' => 'ID Disi wajib di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
    }
}