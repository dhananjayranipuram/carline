<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;
use Storage;

class SignatureController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Dubai');
        // date_default_timezone_set('Asia/Kolkata');
        $site = new Site();
        $emirates = $site->getEmirates();
        $layoutCarTypes = $site->getCarType();
        $country = $site->getCountry();

        view()->share('emirates', $emirates);
        view()->share('country', $country);
        view()->share('layoutCarTypes', $layoutCarTypes);
    }

    public function show()
    {
        return view('document/signature');
    }

    // public function upload(Request $request)
    // {
    //     $dataUrl = $request->input('signature');

    //     if (!$dataUrl) {
    //         return response()->json(['error' => 'No signature data provided.'], 400);
    //     }

    //     // Validate and extract image content from data URL
    //     if (preg_match('/^data:image\/(\w+);base64,/', $dataUrl, $type)) {
    //         $data = substr($dataUrl, strpos($dataUrl, ',') + 1);
    //         $type = strtolower($type[1]); // e.g. png, jpg

    //         // Decode base64
    //         $decodedImage = base64_decode($data);
    //         if ($decodedImage === false) {
    //             return response()->json(['error' => 'Failed to decode base64 image.'], 400);
    //         }

    //         try {
    //             $userId = base64_encode(Session::get('userId'));
    //             // Encrypt image
    //             $encryptedImage = Crypt::encrypt($decodedImage);

    //             // Save encrypted image to storage
    //             $fileName = 'private_signatures/' . $userId . '/' . 'signature.' . $type . '.enc';
    //             Storage::disk('local')->put($fileName, $encryptedImage);

    //             return response()->json(['success' => true]);
    //         } catch (\Exception $e) {
    //             return response()->json(['error' => 'Encryption/storage failed.'], 500);
    //         }
    //     } else {
    //         return response()->json(['error' => 'Invalid image data URL.'], 400);
    //     }
    // }

    public function upload(Request $request)
    {
        $dataUrl = $request->input('signature');

        if (!$dataUrl) {
            return response()->json(['error' => 'No signature data provided.'], 400);
        }

        // Validate and extract image content from data URL
        if (preg_match('/^data:image\/(\w+);base64,/', $dataUrl, $type)) {
            $data = substr($dataUrl, strpos($dataUrl, ',') + 1);
            $type = strtolower($type[1]); // e.g. png, jpg

            // Decode base64
            $decodedImage = base64_decode($data);
            if ($decodedImage === false) {
                return response()->json(['error' => 'Failed to decode base64 image.'], 400);
            }

            try {
                $userId = base64_encode(Session::get('userId'));

                // Save image without encryption
                $fileName = 'private_signatures/' . $userId . '/' . 'signature.' . $type;
                Storage::disk('local')->put($fileName, $decodedImage);

                return response()->json(['success' => true, 'path' => $fileName]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Storage failed.'], 500);
            }
        } else {
            return response()->json(['error' => 'Invalid image data URL.'], 400);
        }
    }


    public function generate()
    {
        $site = new Site();
        $data = [];
        $input['id'] = Session::get('userId');
        $data['userAccount'] = $site->getMyDetails($input);
        $data['userDocument'] = $site->getMyDocumentDetails($input);
        $userId = base64_encode(Session::get('userId'));
        $signaturePath = storage_path('app/private_signatures/' . $userId . '/signature.png'); // adjust extension if needed

        $base64Signature = null;

        if (file_exists($signaturePath)) {
            $imageData = file_get_contents($signaturePath);
            $mimeType = mime_content_type($signaturePath);
            $base64Signature = 'data:' . $mimeType . ';base64,' . base64_encode($imageData);
        } else {
            // Log or debug why file is not found
            logger("Signature not found at path: " . $signaturePath);
        }

        $data['sign'] = $base64Signature;

        // $data['sign'] = storage_path('app/' . $fileName);
        // echo '<pre>';
        // print_r($data);
        // exit;


        // if (!empty($data['userDocument'])) {
        //     foreach ($data['userDocument'] as $doc) {
        //         $decryptedFiles = [];

        //         foreach ($doc as $key => $filePath) {
        //             if (!in_array($key, ['id', 'user_type']) && !empty($filePath)) {

        //                 if (strpos($filePath, '.enc') !== false) {
        //                     if (Storage::exists($filePath)) {
        //                         try {
        //                             $encryptedContents = Storage::get($filePath);

        //                             $decryptedContents = Crypt::decrypt($encryptedContents);

        //                             $fileExtension = pathinfo(str_replace('.enc', '', $filePath), PATHINFO_EXTENSION);

        //                             $mimeType = $this->getMimeTypeFromExtension($fileExtension);

        //                             $base64Content = base64_encode($decryptedContents);

        //                             $dataUrl = "data:{$mimeType};base64,{$base64Content}";

        //                             $decryptedFiles[$key] = $dataUrl;
        //                         } catch (\Exception $e) {
        //                             $decryptedFiles[$key] = 'Error decrypting file';
        //                         }
        //                     } else {
        //                         $decryptedFiles[$key] = 'File not found';
        //                     }
        //                 } else {
        //                     $decryptedFiles[$key] = asset('/' . $filePath);
        //                     // $decryptedFiles[$key] = asset('storage/' . $filePath);
        //                 }
        //             }
        //         }
        //         $doc->decrypted_files = $decryptedFiles;
        //     }
        // }



        // echo '<pre>';print_r($data);exit;
        // return view('pdf.document', $data);
        $pdf = Pdf::loadView('pdf.document', $data);

        // Save PDF to storage/public/pdfs
        $fileName = 'document_' . time() . '.pdf';
        $filePath = 'pdfs/' . $fileName;
        Storage::disk('public')->put($filePath, $pdf->output());

        // Redirect to the view page and pass the filename
        return redirect()->route('pdf.view', ['filename' => $fileName]);
    }

    public function view($filename)
    {
        // echo '<pre>';print_r($filename);exit;
        return view('pdf/view', ['filename' => $filename]);
    }
}
