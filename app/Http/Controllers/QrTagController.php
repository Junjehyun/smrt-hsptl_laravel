<?php

namespace App\Http\Controllers;

use App\Models\SmartTag;
use Illuminate\Http\Request;

class QrTagController extends Controller
{
    //
    public function QrPageIndex() {
        return view('smart.qr-tag');
    }

    /**
     * Save QR Code
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     * 
     */
    public function saveQrCode(Request $request) {

        $validated = $request->validate([
            'tag_id' => 'required',
            'mac_address' => 'required',
            'tag_type' => 'required',
        ]);

        $device = SmartTag::create([
            'tag_id' => $request->tag_id,
            'mac_address' => $request->mac_address,
            'tag_type' => $request->tag_type,
        ]);

        return redirect()->route('qr-tag')->with('success', 'QRコードが保存されました。');
    }
}
