<?php
namespace App\Http\Controllers\Mobile\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Nutrisi;
class NutrisiController extends Controller
{
    public function getNutrisi(Request $request){
        $validator = Validator::make($request->only('id_nutrisi'), [
            'id_nutrisi'=>'required',
        ], [
            'id_nutrisi.required' => 'ID Nutrisi wajib di isi',
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