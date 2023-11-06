<?php

namespace App\Http\Controllers;

use App\Models\LabResult;
use App\Http\Requests\LabResultStoreRequest;

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

    public function retrieveByCode($code)
    {
        // Validate code
        if (!preg_match('/^[0-9a-f]{8}-([0-9a-f]{4}-){3}[0-9a-f]{12}$/i', $code)) {
            return response()->json([
                'message' => 'Invalid code',
                'data' => null
            ], 400);
        }

        // Retrieve the lab results
        $labResults = collect();
        foreach (LabResult::all() as $labResult) {
            if ($labResult->getDecryptedCode() === $code)
                $labResults->push($labResult->withDecryptedData());
        }

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

    public function store(LabResultStoreRequest $request)
    {
        // Store the lab result
        $labResult = new LabResult();
        $labResult->setKey();
        $labResult->setCode($request->code);
        $labResult->setResult($request->result);
        $labResult->save();

        // Return a response
        return response()->json([
            'message' => 'Successfully stored lab result',
            'data' => $labResult->withDecryptedData(),
        ], 201);
    }
}
