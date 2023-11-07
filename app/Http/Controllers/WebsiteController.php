<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteController extends Controller
{
  public function update(Request $request)
  {
      // 驗證輸入
      $request->validate([
          'website_name' => 'sometimes|required|string|max:255',
          'website_logo' => 'sometimes|nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
          'favicon' => 'sometimes|nullable|image|mimes:png,ico|max:2048',
      ]);
  
      // 更新網站名稱
      if ($request->has('website_name')) {
          $websiteName = $request->input('website_name');
          $envFile = app()->environmentFilePath();
          $str = file_get_contents($envFile);
          $oldAppName = env('APP_NAME');
          $str = str_replace("APP_NAME={$oldAppName}", "APP_NAME={$websiteName}", $str);
          file_put_contents($envFile, $str);
      }
  
      // 處理 logo
      if ($request->hasFile('website_logo')) {
          $this->updateImage($request->file('website_logo'), 'assets_admin/img', 'logo.png');
      }
  
      // 處理 favicon
      if ($request->hasFile('favicon')) {
          $this->updateImage($request->file('favicon'), 'favicons', 'favicon.ico');
      }
  
      return response()->json(['success' => true]);
  }
  
  private function updateImage($image, $folder, $filename)
  {
      $newPath = "{$folder}/{$filename}";
  
      // 刪除舊文件，如果它存在
      if (Storage::disk('public')->exists($newPath)) {
          Storage::disk('public')->delete($newPath);
      }
  
      // 儲存新文件
      $image->storeAs($folder, $filename, 'public');
  }
  
}

