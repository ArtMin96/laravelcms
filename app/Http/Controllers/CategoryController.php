<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Image;
use Validator;

class CategoryController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function addCategory(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();

            $validate = Validator::make($data, [
                'sort' => 'required|numeric',
                'name' => 'required',
                'url'  => 'required',
                'image' => 'image|mimes:jpeg,,jpg,png,gif,svg,webp,jfif:4086'
            ]);

            if($validate->passes()) {

                if(empty($data['status'])) {
                    $status = 0;
                } else {
                    $status = 1;
                }

                $category = new Category;
                $category->parent_id = $data['parent_id'];
                $category->sort = $data['sort'];
                $category->name = $data['name'];
                $category->description = $data['description'];
                $category->url = $data['url'];
                $category->status = $status;

                if($request->hasFile('image')) {
                    $image_tmp = $request->file('image');
                    if($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $fileName = rand(111, 99999).'.'.$extension;
                        $largeImagePath = 'backend/images/categories/large/'.$fileName;
                        $mediumImagePath = 'backend/images/categories/medium/'.$fileName;
                        $smallImagePath = 'backend/images/categories/small/'.$fileName;

                        // Resize image
                        Image::make($image_tmp)->save($largeImagePath);
                        Image::make($image_tmp)->resize(600, 600)->save($mediumImagePath);
                        Image::make($image_tmp)->resize(300, 300)->save($smallImagePath);

                        // Store image name in categories table
                        $category->image = $fileName;
                    }
                }

                if($category->save()) {
                    return redirect('/admin/view-categories')->with('flash_message_success', 'Category Has been created');
                }
            } else {
                return back()->with('flash_message_error', $validate->errors()->all());
            }
        }

        $levels = Category::where(['parent_id' => 0])->get();

        return view('admin.categories.add_category')->with(compact('levels'));
    }

    /**
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function editCategory(Request $request, $id = null) {
        if($request->isMethod('post')) {
            $data = $request->all();

            $validate = Validator::make($data, [
                'sort' => 'required|numeric',
                'name' => 'required',
                'url'  => 'required',
                'image' => 'image|mimes:jpeg,,jpg,png,gif,svg,webp,jfif:4086'
            ]);

            if($validate->passes()) {
                if(empty($data['status'])) {
                    $status = 0;
                } else {
                    $status = 1;
                }

                if($request->hasFile('image')) {
                    $image_tmp = $request->file('image');
                    if($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $fileName = rand(111, 99999).'.'.$extension;
                        $largeImagePath = 'backend/images/categories/large/'.$fileName;
                        $mediumImagePath = 'backend/images/categories/medium/'.$fileName;
                        $smallImagePath = 'backend/images/categories/small/'.$fileName;

                        // Resize image
                        Image::make($image_tmp)->save($largeImagePath);
                        Image::make($image_tmp)->resize(600, 600)->save($mediumImagePath);
                        Image::make($image_tmp)->resize(300, 300)->save($smallImagePath);

                    }
                } else {
                    $fileName = $data['current_image'];
                }

                Category::where(['id' => $id])->update([
                    'sort' => $data['sort'],
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'url' => $data['url'],
                    'image' => $fileName,
                    'status' => $status
                ]);

                return redirect('/admin/view-categories')->with('flash_message_success', 'Category updated Successfully');
            }
        }
        $categoryDetails = Category::where(['id' => $id])->first();
        $levels = Category::where(['parent_id' => 0])->get();

        return view('admin.categories.edit_category')->with(compact('categoryDetails', 'levels'));
    }

    public function deleteCategory(Request $request, $id = null) {
        if(!empty($id)) {
            Category::where(['id' => $id])->delete();
            return redirect()->back()->with('flash_message_success', 'Category deleted Successfully!');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewCategories() {
        $categories = Category::get();
        $categories = json_decode(json_encode($categories));
        return view('admin.categories.view_categories')->with(compact('categories'));
    }
}
