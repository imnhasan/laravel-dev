<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Alerts';
        $categories = Category::query()->orderBy('id', 'DESC')->paginate(15);
        // return view
        if ($request->ajax()) {
            return view('categories.ajax', compact('title', 'categories'));
        }
        return view('categories.index', compact('title', 'categories'));
    }

    public function storeUpdate(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'Please select name.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('category.index')->with('error', $validator->errors()->first());
        }

        // check user data
        if ($request->id) {
            $check = Category::query()
                ->where([
                    ['id', $request->id],
                ])->exists();
            if (!$check) {
                return redirect()->route('category.index')->with('error', 'Category not found.');
            }
        }

        // save
        try {
            $id = $request->id;
            $category = new Category();
            if ($id != null) {
                $category->exists = true;
                $category->id = $id;
                $message = 'Category successfully updated.';
            } else {
                $message = 'Category successfully added.';
            }
            $category->name = $request->name;

            $category->save();

            $status = "success";
        } catch (\Illuminate\Database\QueryException $ex) {
            $status = "error";
            $message = $ex->getMessage();
            Log::error('Category not storeUpdate: ' . $message);
        }

        return redirect()->route('category.index')->with($status, $message);
    }

    public function destroy(Category $category)
    {
        try {
            if (1) {
                $category->delete();
                $status = "success";
                $message = "Alert successfully deleted.";
            } else {
                $status = "error";
                $message = 'Alert not found.';
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException  $ex) {
            $status = "error";
            $message = 'Alert not found.';
            Log::error('Alerts not destroy: ' . $message);
        }

        return redirect()->route('category.index')->with($status, $message);
    }
}
