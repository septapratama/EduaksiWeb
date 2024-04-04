<?php
namespace App\Http\Controllers\Mobile\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pengasuhan;
class PengasuhanController extends Controller
{
    public function getPengasuhan(Request $request){
        $validator = Validator::make($request->only('id_pengasuhan'), [
            'id_pengasuhan'=>'required',
        ], [
            'id_pengasuhan.required' => 'ID Pengasuhan wajib di isi',
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