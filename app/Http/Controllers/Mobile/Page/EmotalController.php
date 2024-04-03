<?php
namespace App\Http\Controllers\Mobile\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\EmosiMental;
use App\Models\GaleriEmosiMental;
class EmotalController extends Controller
{
    public function getEmotal(Request $request){
        $validator = Validator::make($request->only('id_emotal'), [
            'id_emotal'=>'required',
        ], [
            'id_emotal.required' => 'ID Emotal wajib di isi',
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