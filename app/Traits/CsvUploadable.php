<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Master;
trait CsvUploadable {

    /**
     * CSVファイルをアップロードする
     * 例えばこのTraitを使った場合CSVファイルアップロード機能が必要な色んなコントローラから
     * このTraitを使える。
     * こんな風にすると、各コントローラで同じ処理を書かなくて済む。
     */
    public function csvUploadTrait(Request $request) {
            // ファイルがアップロードされているかチェック
        $validator = Validator::make($request->all(), 
        [
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        // 検証失敗時エラーメッセージを返す
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
         // アップロードされたCSVファイルのパスを取得
        $path = $request->file('csv_file')->getRealPath();
        
         // CSVファイルを配列に読み込む
        $data = array_map('str_getcsv', file($path));

         // 一番目の行をヘッダーとして使用
        $header = $data[0];
        unset($data[0]);

         // データベースに行を挿入
        foreach($data as $row) {
            $row = array_combine($header, $row);
            
             // use_flagが'T'の場合はtrue、'F'の場合はfalseに変換
            if (isset($row['use_flag'])) {
                $row['use_flag'] = $row['use_flag'] == 'T' ? 1 : 0;
            }

            Master::create($row);
        }
        

        return redirect()->route('index')
            ->with('success', 'CSVファイルをアップロードされました。');
    }

}