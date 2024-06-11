<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadImageRequest;
use Carbon\Carbon;
use App\Models\Facility;
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    /**
     * イメージアップロード画面表示
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function imageUploadIndex()
    {
        $facility = Facility::latest()->first();
        $logoPath = $facility ? $facility->logo_image_name : null;
        session(['image' => $logoPath]);
        return view('smart.image_upload', compact('logoPath', 'facility'));
    }

    /**
     * イメージアップロード
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function imageToroku(UploadImageRequest $request)
    {

        $image = $request->file('hsptl_image');
        
        // 新しい画像アップロード
        $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $imageName = $originalName . '_' . Carbon::now()->format('YmdHis') . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        session(['image' => $imageName]);

        // Facility テーブルにデータを保存
        Facility::Create(

        [
            'name' => $request->facility_name,
            'license_count' => $request->license_count ?? 100,
            'lang_type' => $request->lang_type ?? '01',
            'logo_image_name' => $imageName,
            'status' => '00'
        ]);

        return back()->with('success', '画像をアップロードしました。');
    }
    /**
     * イメージ削除
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function imageDelete(Request $request) {
        
        $facility = Facility::first();
        
        if($facility && $facility->logo_image_name) {
            $imagePath = public_path('images') . '/' . $facility->logo_image_name;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            // データベースから画像情報削除
            $facility->delete();
            session()->forget('image');
            return response()->json(['success' => '画像を削除しました。']);
        }
        return response()->json(['error' => '画像の削除が失敗になりました。']);
    }
}
