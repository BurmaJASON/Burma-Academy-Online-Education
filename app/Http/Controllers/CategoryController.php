<?php

namespace App\Http\Controllers;

use App\Models\Category;
use function Ramsey\Uuid\v1;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //categories page
    public function index() {
        $categories = Category::latest()->where('name', 'LIKE' , '%'.request()->search .'%')->get();
        return view('category.index',compact('categories'));
    }

    //category create
    public function createCategory() {
        $this->categoryValidationCheck();
        $categoryData  = $this->getCategoryData();
        Category::create($categoryData);
        return back();
    }

    //category delete
    public function deleteCategory($id) {
        Category::find($id)->delete();
        return redirect()->route('category')->with(['success'=>'Category Deleted Successfully!']);
    }

    //category edit
    public function editCategory(Category $category) {
        return view('category.index',[
            'category' => $category,
            'categories' => Category::all()
        ]);
    }

    //category update
    public function updateCategory($id) {
        $this->categoryValidationCheck();
        $data = $this->getCategoryData();
        Category::where('id',$id)->update($data);
        return redirect()->route('category');
    }


    //category validation check
    private function categoryValidationCheck() {
        Validator::make(request()->all(),[
            'title' => 'required|unique:categories,name,'.request()->id
        ])->validate();
    }


    //get category data
    private function getCategoryData() {
        return [
            'name' => request()->title,
            'slug' =>  fake()->unique()->slug(),
        ];
    }
}
