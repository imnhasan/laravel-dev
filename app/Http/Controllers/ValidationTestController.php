<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidationTestController extends Controller
{
    public function thisValidationCreate()
    {
        return view('validation-test.this-validation');
    }

    public function thisValidationStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        return redirect()->route('validation.this-validation-create');
    }

    public function manualValidationCreate()
    {
        return view('validation-test.manual-validation');
    }

    public function manualValidationStore(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], $messages = [
            'required' => 'The :attribute field is required.',
        ]);
 
        if ($validator->fails()) {
            return redirect('validation/manual-validation-create')->withErrors($validator)->withInput();
        }

        return redirect()->route('validation.manual-validation-create');
    }
}
