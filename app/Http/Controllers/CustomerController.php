<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerCreateRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use App\Models\Master;
use App\Models\Medical_comment;
use App\Models\Medical_info;
use Exception;
use Faker\Provider\Medical;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\CustomerQuery;
use Illuminate\Support\Facades\Log;
use App\Consts\ControllerConsts;
use App\Consts\ModelConsts;
use App\Traits\CustomerTrait;

class CustomerController extends Controller
{ 
    /**
     * CustomerTraitを使用する
     */
    use CustomerTrait;
    
    /**
     * 患者情報の一覧画面に移動する
     * logメソッドを使用して、ログにメッセージを記録する。
     * 
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     * @throws \Exception
     * @throws \Throwable
     */
    public function customerIndex(Request $request) {
        Log::channel('smart_hsptl')->info('customerIndexメソッドを実行します。', ['request' => $request->all()]);

        $customers = $this->buildCustomerQuery()
            ->orderBy('customers.' .ModelConsts::CUSTOMER_FIELD_CREATED_AT, 'desc')
            ->paginate(ControllerConsts::PAGINATION_COUNT, 'vendor.pagination.tailwind');
        
        Log::channel('smart_hsptl')->info('customerIndexメソッドを終了します。', ['customers_count' => $customers->total()]);
        return view('smart.kanja-list', compact('customers'));
    }
    /**
     * 患者情報を検索する
     * logメソッドを使用して、ログにメッセージを記録する。
     * 
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     * @throws \Exception
     * @throws \Throwable
     */
    public function customerSearch(Request $request) {
        Log::channel('smart_hsptl')->info('customerSearchメソッドを実行します。', ['request' => $request->all()]);

        $query = $this->buildCustomerQuery();

        if ($request->filled('kanja-search')) {
            $search = $request->input('kanja-search');
            $query->where('customers.' . ModelConsts::CUSTOMER_FIELD_NAME, 'like', "%{$search}%")
                ->orWhere('customers.' . ModelConsts::CUSTOMER_FIELD_CUSTOMER_NO, 'like', "%{$search}%");
        }

        $customers = $query->paginate(ControllerConsts::PAGINATION_COUNT, 'vendor.pagination.tailwind');

        Log::channel('smart_hsptl')->info('customerSearchメソッドを終了します。', ['customers_count' => $customers->total()]);
        return view('smart.kanja-list', compact('customers'));
    }

    /**
     * 患者情報の作成画面に移動する, セレクトボックスにマスターデータを表示
     * logメソッドを使用して、ログにメッセージを記録する。
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function customerCreate() {
        Log::channel('smart_hsptl')->info('customerCreateメソッドを実行します。');

        $masterData = $this->getMasterData();

        Log::channel('smart_hsptl')->info('customerCreateメソッドを終了します。', ['masterData' => $masterData]);
        return view('smart.kanja-create', $masterData);
    }

    /**
     * 患者情報を生成する
     * logメソッドを使用して、ログにメッセージを記録する。
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception 
     */
    public function customerStore(CustomerCreateRequest $request) {
        Log::channel('smart_hsptl')->info('customerStoreメソッドを実行します。', ['request' => $request->all()]);

        DB::beginTransaction();

        try{
            // 最後にりようされた'customer_no'を探す。
            Log::channel('smart_hsptl')->info('最後に利用されたcustomer_noを探しています。');
            $lastCustomer = Customer::orderBy('customer_no', 'desc')->firstOrFail();
            Log::channel('smart_hsptl')->info('最後のcustomer_noを取得しました。', ['lastCustomer' => $lastCustomer]);

            //'customer_no'がまだない場合、最初の'customer_no'を'K001'として設定する。
            $customer_no = $lastCustomer ? intval(substr($lastCustomer->customer_no, 1)) + 1 : 1;
            //'customer_no'を'K'で始まり、その後に3桁の数字を付ける形で生成する。
            $customer_no = 'K' . str_pad($customer_no, 3, '0', STR_PAD_LEFT);
            Log::channel('smart_hsptl')->info('新しいcustomer_noを計算しました。', ['customer_no' => $customer_no]);

            Log::channel('smart_hsptl')->info('新しい患者情報を生成します。');
            $patient = Customer::create([
                ModelConsts::CUSTOMER_FIELD_CUSTOMER_NO => $customer_no,
                ModelConsts::CUSTOMER_FIELD_NAME => $request->input(ModelConsts::CUSTOMER_FIELD_NAME),
                ModelConsts::CUSTOMER_FIELD_BIRTHDATE => $request->input(ControllerConsts::FIELD_BIRTH_YEAR) . str_pad($request->input(ControllerConsts::FIELD_BIRTH_MONTH), 2, '0', STR_PAD_LEFT) . str_pad($request->input(ControllerConsts::FIELD_BIRTH_DAY), 2, '0', STR_PAD_LEFT),
                ModelConsts::CUSTOMER_FIELD_SEX => $this->convertGender($request->input(ControllerConsts::FIELD_GENDER)),
                ModelConsts::CUSTOMER_FIELD_HOSPITALIZED_DATE => $request->input(ControllerConsts::FIELD_HOSPITAL_DATE),
                ModelConsts::CUSTOMER_FIELD_BLOOD_TYPE => $request->input(ControllerConsts::FIELD_BLOOD_TYPE),
                ModelConsts::CUSTOMER_FIELD_TELEPHONE => $request->input(ControllerConsts::FIELD_TELEPHONE),
                ModelConsts::CUSTOMER_FIELD_ADDRESS => $request->input(ControllerConsts::FIELD_ADDRESS),
                ModelConsts::CUSTOMER_FIELD_ROOM_CODE => $this->generateRoomCode()
            ]);
            Log::channel('smart_hsptl')->info('患者情報を生成しました。', ['patient' => $patient]);

            Log::channel('smart_hsptl')->info('新しい医療情報を生成しいます。');
            $medicalInfo = Medical_info::create([
                ModelConsts::MEDICAL_INFO_FIELD_CUSTOMER_NO => $customer_no,
                ModelConsts::MEDICAL_INFO_FIELD_DEPARTMENT => $request->input(ControllerConsts::FIELD_DEPARTMENT),
                ModelConsts::MEDICAL_INFO_FIELD_DOCTOR_NAME => $request->input(ControllerConsts::FIELD_DOCTOR_NAME),
                ModelConsts::MEDICAL_INFO_FIELD_SEVERITY => $request->input(ControllerConsts::FIELD_SEVERITY),
                ModelConsts::MEDICAL_INFO_FIELD_FALL => $request->input(ControllerConsts::FIELD_FALL),
                ModelConsts::MEDICAL_INFO_FIELD_BLOOD_WARN => filter_var($request->input(ControllerConsts::FIELD_BLOOD_WARN, 'false'), FILTER_VALIDATE_BOOLEAN),
                ModelConsts::MEDICAL_INFO_FIELD_CONTACT_WARN => filter_var($request->input(ControllerConsts::FIELD_CONTACT_WARN, 'false'), FILTER_VALIDATE_BOOLEAN),
                ModelConsts::MEDICAL_INFO_FIELD_AIR_WARN => filter_var($request->input(ControllerConsts::FIELD_AIR_WARN, 'false'), FILTER_VALIDATE_BOOLEAN),
                ModelConsts::MEDICAL_INFO_FIELD_REMARKS => $request->input(ControllerConsts::FIELD_REMARKS)
            ]);
            Log::channel('smart_hsptl')->info('医療情報を生成しました。', ['medicalInfo' => $medicalInfo]);
            
            DB::commit();
            Log::channel('smart_hsptl')->info('customerStoreメソッドを終了します。');

            return redirect()->route('kanja-list')->with('success', '患者情報を登録しました');
        } catch(Exception $e) {
            DB::rollBack();
            Log::channel('smart_hsptl')->error('患者情報の登録に失敗しました。' . $e->getMessage());
            return redirect()->route('kanja-create')->with('error', '患者情報の登録に失敗しました。');
        }
    }

    /**
     * 性別を変換する
     * log::infoメソッドを使用して、ログにメッセージを記録する。
     * 
     * @param string $gender
     * @return string
     */
    public function convertGender($gender) {
        Log::channel('smart_hsptl')->info('convertGender メソッドは性別で呼び出されます:' . $gender);
        return $gender === '1' ? ControllerConsts::GENDER_MALE : ControllerConsts::GENDER_FEMALE;
    }
    /**
     * 病室コードを生成する  例：'R001'
     * logメソッドを使用して、ログにメッセージを記録する。
     * 
     * @return string
     * @throws Exception
     */
    private function generateRoomCode() {

        Log::channel('smart_hsptl')->info('generateRoomCodeメソッドを実行します。');
        
        $wardCodes = range('A', 'Z');
        $lastRoom = Customer::orderBy('room_code', 'desc')->first();

        if($lastRoom) {
            $lastWardCode = substr($lastRoom->room_code, 0, 1);
            $lastRoomNumber = intval(substr($lastRoom->room_code, 1)); 

        if ($lastWardCode === 'Z' && $lastRoomNumber >= 999) {
            throw new Exception('病室が満室です。');
        }

        if ($lastRoomNumber >= 999) {
            $newWardCodeIndex = array_search($lastWardCode, $wardCodes) + 1;
            $newWardCode = $wardCodes[$newWardCodeIndex];
            $newRoomNumber = 1;
        } else {
            $newWardCode = $lastWardCode;
            $newRoomNumber = $lastRoomNumber + 1;
        }
        } else {
            $newWardCode = 'A';
            $newRoomNumber = 1;
        }
        Log::channel('smart_hsptl')->info('generateRoomCodeメソッドを終了します。' . $newWardCode . str_pad($newRoomNumber, 3, '0', STR_PAD_LEFT));
        return $newWardCode . str_pad($newRoomNumber, 3, '0', STR_PAD_LEFT); 
    }

    /**
     * 患者情報を編集する
     * logメソッドを使用して、ログにメッセージを記録する。
     * 
     * @param Request $request
     * @param string $customer_no
     * @return \Illuminate\Contracts\View\View
     */
    public function customerEdit(Request $request, $customer_no) {

        Log::channel('smart_hsptl')->info('customerEditメソッドを実行します。', ['customer_no' => $customer_no, 'request' => $request->all()]);

        $customerDetails = $this->findCustomerDetails($customer_no);
        Log::channel('smart_hsptl')->info('患者情報を取得しました。', ['customerDetails' => $customerDetails]);

        $genders = Master::where('master_key', ControllerConsts::MASTER_KEY_GENDER)
                        ->where('item_code', '!=', '000')
                        ->pluck('item_name');
        $departments = Master::where('master_key', ControllerConsts::MASTER_KEY_DEPARTMENT)
                        ->where('item_code', '!=', '000')
                        ->pluck('item_name');
        $severities = Master::where('master_key', ControllerConsts::MASTER_KEY_SEVERITY)
                        ->where('item_code', '!=', '000')
                        ->pluck('item_nm_short');
        $falls = Master::where('master_key', ControllerConsts::MASTER_KEY_FALL)
                        ->where('item_code', '!=', '000')
                        ->pluck('item_nm_short');
        $blood_types = Master::where('master_key', ControllerConsts::MASTER_KEY_BLOOD_TYPE)
                        ->where('item_code', '!=', '000')
                        ->pluck('item_name');

        if (!$departments->contains($customerDetails['department'])) {
            $departments->push($customerDetails['department']);
        }

        Log::channel('smart_hsptl')->info('customerEditメソッドを終了します。');

        return view('smart.kanja-edit', array_merge(
                compact('genders', 'departments', 'severities', 'falls', 'blood_types'), 
                $customerDetails
            )
        );
    }

    /**
     * 患者情報を更新する
     * logメソッドを使用して、ログにメッセージを記録する。
     * 
     * @param Request $request
     * @param string $customer_no
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Throwable
     */
    public function customerUpdate(CustomerUpdateRequest $request, $customer_no) { 

        Log::channel('smart_hsptl')->info('customerUpdateメソッドを実行します。' . $customer_no);

        DB::beginTransaction();

        try{
            Log::channel('smart_hsptl')->info('患者情報を更新します。');

            $customer = Customer::where('customer_no', $customer_no)->firstOrFail();
            $medical_info = Medical_info::where('customer_no', $customer_no)->firstOrFail();    
            $medical_comment = Medical_comment::where('customer_no', $customer_no)->firstOrFail();  
            Log::channel('smart_hsptl')->info('患者情報を取得しました。', ['customer' => $customer, 'medical_info' => $medical_info, 'medical_comment' => $medical_comment]);
            
            //情報がいない場合、エラーを表示
            if (!$customer || !$medical_comment || !$medical_info) {
                Log::channel('smart_hsptl')->warning('情報が見つかりません。', ['customer_no' => $customer_no]);
                abort(404);
            }

            Log::channel('smart_hsptl')->info('患者情報を更新します。');
            $customer->update([
               // ModelConsts::CUSTOMER_FIELD_NAME => $request->input(ModelConsts::CUSTOMER_FIELD_NAME),
                ModelConsts::CUSTOMER_FIELD_BIRTHDATE => $request->input(ControllerConsts::FIELD_BIRTH_YEAR) . str_pad($request->input(ControllerConsts::FIELD_BIRTH_MONTH), 2, '0', STR_PAD_LEFT) . str_pad($request->input(ControllerConsts::FIELD_BIRTH_DAY), 2, '0', STR_PAD_LEFT),
                ModelConsts::CUSTOMER_FIELD_SEX => $this->convertGender($request->input(ControllerConsts::FIELD_GENDER)),
                //ModelConsts::CUSTOMER_FIELD_HOSPITALIZED_DATE => $request->input(ControllerConsts::FIELD_HOSPITAL_DATE),
                ModelConsts::CUSTOMER_FIELD_BLOOD_TYPE => $request->input(ControllerConsts::FIELD_BLOOD_TYPE),
                ModelConsts::CUSTOMER_FIELD_TELEPHONE => $request->input(ControllerConsts::FIELD_TELEPHONE),
                ModelConsts::CUSTOMER_FIELD_ADDRESS => $request->input(ControllerConsts::FIELD_ADDRESS)
            ]);
            Log::channel('smart_hsptl')->info('患者情報を更新しました。', ['customer' => $customer]);

            Log::channel('smart_hsptl')->info('医療情報を更新します。');
            $medical_info->update([
                ModelConsts::MEDICAL_INFO_FIELD_DEPARTMENT => $request->input(ControllerConsts::FIELD_DEPARTMENT),
                ModelConsts::MEDICAL_INFO_FIELD_DOCTOR_NAME => $request->input(ControllerConsts::FIELD_DOCTOR_NAME),
                ModelConsts::MEDICAL_INFO_FIELD_SEVERITY => $request->input(ControllerConsts::FIELD_SEVERITY),
                ModelConsts::MEDICAL_INFO_FIELD_FALL => $request->input(ControllerConsts::FIELD_FALL),
                ModelConsts::MEDICAL_INFO_FIELD_BLOOD_WARN => filter_var($request->input(ControllerConsts::FIELD_BLOOD_WARN, 'false'), FILTER_VALIDATE_BOOLEAN),
                ModelConsts::MEDICAL_INFO_FIELD_CONTACT_WARN => filter_var($request->input(ControllerConsts::FIELD_CONTACT_WARN, 'false'), FILTER_VALIDATE_BOOLEAN),
                ModelConsts::MEDICAL_INFO_FIELD_AIR_WARN => filter_var($request->input(ControllerConsts::FIELD_AIR_WARN, 'false'), FILTER_VALIDATE_BOOLEAN),
                ModelConsts::MEDICAL_INFO_FIELD_REMARKS => $request->input(ControllerConsts::FIELD_REMARKS)
            ]);
            
            Log::channel('smart_hsptl')->info('医療情報を更新しました。', ['medical_info' => $medical_info]);

            Log::channel('smart_hsptl')->info('医療コメントを更新します。');
            $medical_comment->update([
                ModelConsts::MEDICAL_COMMENT_FIELD_COMMENTS => $request->input('comment')
            ]);
            Log::channel('smart_hsptl')->info('医療コメントを更新しました。', ['medical_comment' => $medical_comment]);

            DB::commit();

            Log::channel('smart_hsptl')->info('customerUpdateメソッドを終了します。');

            return redirect()->route('kanja-list')->with('success', '患者情報を更新しました');

        } catch(Exception $e) {
            DB::rollBack();
            Log::channel('smart_hsptl')->error('患者情報の更新に失敗しました。' . $e->getMessage());
            return redirect()->route('kanja-edit', ['customer_no' => $customer_no])->with('error', '患者情報の更新に失敗しました。');
        }
    }
    /**
     * 患者の詳細画面を表示する
     * logメソッドを使用して、ログにメッセージを記録する。
     * 
     * @param string $customer_no
     * @return \Illuminate\Contracts\View\View
     */
    public function customerShow($customer_no) {
        
        Log::channel('smart_hsptl')->info('customerShowメソッドを実行します。', ['customer_no' => $customer_no]);

        $customer = Customer::where(ModelConsts::CUSTOMER_FIELD_CUSTOMER_NO, $customer_no)->firstOrFail();
        $medical_info = Medical_info::where(ModelConsts::MEDICAL_INFO_FIELD_CUSTOMER_NO, $customer_no)->first();
        $medical_comment = Medical_comment::where(ModelConsts::MEDICAL_COMMENT_FIELD_CUSTOMER_NO, $customer_no)->first();

        $comments = Medical_comment::where(ModelConsts::MEDICAL_COMMENT_FIELD_CUSTOMER_NO, $customer_no)->orderBy(ModelConsts::MEDICAL_COMMENT_FIELD_CREATED_AT, 'desc')->get();

        Log::channel('smart_hsptl')->info('customerShowメソッドを終了します。', ['customer' => $customer, 'medical_info' => $medical_info, 'medical_comment' => $medical_comment, 'comments_count' => $comments->count()]);
        return view('smart.kanja-show', compact('customer', 'medical_info', 'medical_comment', 'comments'));
    }

    /**
     * コメントを追加する
     * logメソッドを使用して、ログにメッセージを記録する。
     * 
     * @param Request $request
     * @param string $customer_no
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function addComment(Request $request, $customer_no) {

        Log::channel('smart_hsptl')->info('addCommentメソッドを実行します。', ['customer_no' => $customer_no, 'request' => $request->all()]);

        DB::beginTransaction();

        try {
            $comment = Medical_comment::create([
                'customer_no' => $customer_no,
                'department_code' => $request->input('department_code'),
                'employ_id' => $request->input('employ_id'), 
                'comments' => $request->input('comments'),
                'create_date' => now(),
            ]);
    
            DB::commit();
    
            return redirect()->route('kanja.show', ['customer_no' => $customer_no])->with('success', 'コメントが追加されました。');
        } catch (Exception $e) {
            DB::rollBack();
            Log::channel('smart_hsptl')->error('コメントの追加に失敗しました。' . $e->getMessage());
            return redirect()->route('kanja.show', ['customer_no' => $customer_no])->with('error', 'コメントの追加に失敗しました。');
        }
    }

    public function customerSort(Request $request)
    {
        $sortField = $request->input('sortField', ModelConsts::CUSTOMER_FIELD_NAME);
        $sortOrder = $request->input('sortOrder', 'desc');
        $customers = $customers = $this->buildCustomerQuery()
                    ->orderBy($sortField, $sortOrder)
                    ->paginate(10);
        return view('smart.kanja-list', compact('customers', 'sortField', 'sortOrder'));
    }
}