<?php /** @noinspection PhpParamsInspection */

/** @noinspection PhpUndefinedFieldInspection */

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function add_category(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sub_category' => 'required|string|min:3',
            'image' => 'image',
            'category_id' => 'required|int|exists:categories,id'
        ]);
        if ($validator->fails())
            return response()->json($validator->errors(), 400);

        $sub_category = SubCategory::create([
            'sub_category' => $request->sub_category,
            'category_id' => $request->category_id
        ]);

        $sub_category = $this->store_category_image($request, $sub_category);

        return response()->json($sub_category, 201);
    }

    public function store_category_image(Request $request, $category)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $image->move("photos/", $filename);
            $category->update([
                //'photo_path' => URL::to("/photos/$filename"),
                'photo_path'=>'/photos/'.$filename
            ]);
        }
        $category->photo_path = URL::to($category->photo_path);
        return $category;
    }

    public function edit_category(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sub_category_id' => 'required|integer|exists:sub_categories,id',
            'sub_category' => 'required|string|min:3',
            'image' => 'image',
        ]);
        if ($validator->fails())
            return response()->json($validator->errors(), 400);
        SubCategory::where('id', $request->sub_category_id)
            ->update([
                'sub_category' => $request->sub_category,
            ]);
        $sub_category = SubCategory::find($request->sub_category_id);
        $sub_category = $this->store_category_image($request, $sub_category);
        $sub_category->photo_path = URL::to($sub_category->photo_path);
        return $sub_category;
    }
}
