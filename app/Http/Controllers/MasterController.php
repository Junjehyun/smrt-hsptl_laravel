<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Master;
use App\Traits\CsvUploadable;
use Illuminate\Support\Facades\Log;
class MasterController extends Controller
{
    use CsvUploadable;

    /**
     * マスタファイル登録画面を表示する
     * logメソッドを使用して、ログにメッセージを記録する。
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function csvPage() {
        Log::channel('smart_hsptl')->info('CSV一覧画面を表示しました。');
        return view('smart.csv');
    }
    /**
     * csvファイルをアップロード処理をする
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function csvUpload(Request $request) {
        return $this->csvUploadTrait($request);
    }

    /**
     * マスタファイルの一覧を表示する
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function MasterViewIndex()
    {
        $masters = Master::select('master_name')->distinct()->get();
        return view('smart.master-index', compact('masters'));
    }

    /**
     * マスタファイルの一覧を表示する
     * item_codeが000以外のデータを取得する
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getValuesByMasterName(Request $request)
    {
        $values = Master::where('master_name', $request->master_name)
                        ->where('item_code', '<>', '000') // SQL文法ではitem_code != '000'と同じ
                        ->get();

        return response()->json($values);
    }
}