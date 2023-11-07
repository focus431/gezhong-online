<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

     public function handle($request, Closure $next)
     {
         $browserLang = $request->header('Accept-Language'); // 從請求頭中獲取語言
         $langs = explode(',', $browserLang); // 分割多個語言
     
         $availableLangs = ['en','zh','zh_TW','ja']; // 你應用支持的語言列表
         $primaryLang = config('app.locale'); // 默認語言
     
         foreach ($langs as $lang) {
             $lang = explode(';', $lang)[0]; // 去掉品質值
             $lang = str_replace('-', '_', $lang); // 將 "zh-TW" 轉換為 "zh_TW"
     
             // 如果語言是 'zh'，則使用 'zh_TW'
             if ($lang == 'zh') {
                 $lang = 'zh_TW';
             }
     
             if (in_array($lang, $availableLangs)) {
                 $primaryLang = $lang;
                 break;
             }
         }
     
         App::setLocale($primaryLang); // 設定應用語言
     
         return $next($request);
     }
     


}
