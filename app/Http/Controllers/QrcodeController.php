<?php

namespace App\Http\Controllers;

use Endroid\QrCode\QrCode;
use Input;
use Illuminate\Http\Request;

class QrcodeController extends Controller
{
    public function index(){
		$text = Input::get('text');
		$qr = new QrCode();
		$qr->setText($text);
		$qr->setPadding(10);
		$qr->setSize(200);
		$qr->render();
    }
}
