<?php

namespace Modules\Category\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Category\Http\Repositories\CategoryRepo;
use Modules\Category\Http\Requests\CategoryRequest;
use Modules\Category\Http\Requests\CategoryUpdateRequest;
use Modules\Category\Http\Services\CategoryService;
use Modules\Category\Models\Category;
use Modules\Common\Http\Services\CommonServices;
use Modules\Common\Http\Services\Image\ImageService;

class CategoryController extends Controller
{
    public function categories()
    {
        if (auth()->user()->can('CategoryPermission')){
            $categories = Category::all();
            return view('category::panel.categories',compact('categories'));
        } else {
            $toasts = [ 'toast' => [
                [
                    'message' => 'شما به این صفحه دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function getCategories(Request $request)
    {
        if (auth()->user()->can('CategoryPermission')){
            return CategoryRepo::getCategories($request);
        } else {
            $toasts = [ 'toast' => [
                [
                    'message' => 'شما به این صفحه دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function getCategoriesList()
    {
        $categories = Category::all();
        $catsList = '<option value="">دسته مادر</option>';
        foreach ($categories as $cat) {
            $catsList .= '<option value="'. $cat->id .'">'. $cat->name .'</option>';
        }
        return $catsList;
    }

    public function categoriesStore(CategoryRequest $request)
    {
        if (auth()->user()->can('CategoryPermission')){
            $input = $request->validated();
            $category = CategoryService::store($input);
            return 'دسته با موفقیت ایجاد شد';
        } else {
            return 'شما به این صفحه دسترسی ندارید';
        }
    }

    public function categoriesUpdate(CategoryUpdateRequest $request)
    {
        if (auth()->user()->can('CategoryPermission')){
            $input = $request->validated();
            $category = Category::query()->where('id',$input['id'])->first();
            if ($category->id == $input['parent_id']) {
                return 'دسته نمی تواند زیردسته خودش باشد';
            }
            CategoryService::update($category,$input);
            return 'دسته با موفقیت ویرایش شد';
        } else {
            return 'شما به این صفحه دسترسی ندارید';
        }
    }

    public function categoriesDelete(Category $category)
    {
        if (auth()->user()->can('CategoryPermission')){
            $category->delete();
            $toasts = [ 'toast' => [
                [
                    'message' => 'دسته با موفقیت حذف شد',
                    'alert-type' => 'success'
                ]
            ]];
            return to_route('panel.category.categories')->with($toasts);
        } else {
            $toasts = [ 'toast' => [
                [
                    'message' => 'شما به این صفحه دسترسی ندارید',
                    'alert-type' => 'error'
                ]
            ]];
            return back()->with($toasts);
        }
    }

    public function getCategoriesAjax(Request $request)
    {
        $cats = Category::query()->where('name','like','%'.$request->string.'%')->get();
        return $cats;
    }
}
