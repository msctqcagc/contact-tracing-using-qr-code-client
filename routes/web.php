<?php

use App\Models\Resident;
use App\Models\User;
use Illuminate\Support\Facades\Route;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('test', function () {
    // $user = User::find(6);

    $user = Resident::find(5);

    $writer = new PngWriter();

    // Create QR code
    $qrCode = QrCode::create('$2y$10$tCN7SHHrk7VSz7LRH1R4S.A8YQ/sH7LptXbBHzKBbNrL/ejBvPe/.')
        ->setEncoding(new Encoding('UTF-8'))
        ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
        ->setSize(300)
        ->setMargin(10)
        ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->setForegroundColor(new Color(0, 0, 0))
        ->setBackgroundColor(new Color(255, 255, 255));

    // // Create generic logo
    $logo = Logo::create(__DIR__.'/assets/symfony.png')
        ->setResizeToWidth(50);

    // Create generic label
    $label = Label::create('Label')
        ->setTextColor(new Color(255, 0, 0));

    $result = $writer->write($qrCode);

    $path = asset('qr-code');
    // Save it to a file
    $result->saveToFile(__DIR__.'/qrcode.png');
});
