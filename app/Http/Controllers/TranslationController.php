<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TranslationController extends Controller
{
  public function index(Request $request)
{
    $lang = $request->get('lang', 'en');
    
    $translations = [
        'en' => ['welcome' => 'Welcome'],
        'zh_TW' => ['welcome' => '歡迎']
    ];
    
    $response_data = $translations[$lang] ?? $translations['en'];
    
    return response()->json($response_data);
}


}
