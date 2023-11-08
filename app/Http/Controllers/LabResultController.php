<?php

namespace App\Http\Controllers;

use App\Models\LabResult;
use App\Http\Requests\LabResultStoreRequest;
use Illuminate\Http\Request;

class LabResultController extends Controller
{
    public function retrieve()
    {
        // Retrieve all lab results decrypted
        $labResults = collect();
        foreach (LabResult::all() as $labResult)
            $labResults->push($labResult->withDecryptedData());

        // Return a response
        return response()->json([
            'message' => 'Successfully retrieved lab results',
            'data' => $labResults
        ], 200);
    }

    public function retrieveById(LabResult $labResult)
    {
        // Return a response
        return response()->json([
            'message' => 'Successfully retrieved lab result',
            'data' => $labResult->withDecryptedData(),
        ], 200);
    }

    private function retrieveByCode($code){
        // Retrieve the lab results
        $labResults = collect();
        foreach (LabResult::all() as $labResult) {
            if ($labResult->getDecryptedCode() === $code)
                $labResults->push($labResult->withDecryptedData());
        }
        return $labResults;
    }

    public function retrieveByCodeWeb($code){
        // Retrieve the lab results
        $labResults = $this->retrieveByCode($code);

        // Check if lab results exists
        if ($labResults->isEmpty()) {
            return redirect()->route('login')->withErrors([
                'code' => 'Lab result not found'
            ], 'labresults');
        }

        // Return a response
        return view('labresults', [
            'labResults' => $labResults,
        ]);
    }

    public function retrieveByCodeApi($code)
    {
        // Validate code
        if (!preg_match('/^[0-9a-f]{8}-([0-9a-f]{4}-){3}[0-9a-f]{12}$/i', $code)) {
            return response()->json([
                'message' => 'Invalid code',
                'data' => null
            ], 400);
        }

        // Retrieve lab results
        $labResults = $this->retrieveByCode($code);

        // Check if lab results exists
        if ($labResults->isEmpty()) {
            return response()->json([
                'message' => 'Lab result not found',
                'data' => null
            ], 404);
        }

        // Return a response
        return response()->json([
            'message' => 'Successfully retrieved lab result',
            'data' => $labResults,
        ], 200);
    }

    public function store($code, $result)
    {
        // Store the lab result
        $labResult = new LabResult();
        $labResult->setKey();
        $labResult->setCode($code);
        $labResult->setResult($result);
        $labResult->save();

        // Return a response
        return $labResult->withDecryptedData();
    }

    public function storeApi(LabResultStoreRequest $request){
        // Store the lab result
        $labResult = $this->store($request->code, $request->result);

        // Return a response
        return response()->json([
            'message' => 'Successfully stored lab result',
            'data' => $labResult->withDecryptedData(),
        ], 201);
    }

    public function storeWeb(Request $request){
        // Validate the request
        $request->validate([
            'code' => 'required|string',
        ]);

        // Check if code is valid guid
        if (!preg_match('/^[0-9a-f]{8}-([0-9a-f]{4}-){3}[0-9a-f]{12}$/i', $request->code)) {
            return view('storelabresult')->withErrors([
                'code' => 'Invalid code'
            ], 'labresults');
        }

        // Store the lab result
        $labResult = $this->store($request->code, isset($request->result));

        // Return a response
        return view('storelabresult')->with([
            'successMessage' => 'Successfully stored lab result!',
            'data' => $labResult->withDecryptedData(),
        ]);
    }

    public function storeLabResult(){
        return view('storelabresult');
    }
}
