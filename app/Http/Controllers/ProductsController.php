<?php

namespace App\Http\Controllers;

use App\ProductsAttributes;
use Auth;
use Session;
use Image;
use Validator;
use App\Category;
use App\Products;
use Illuminate\Http\Request;

/**
 * Class ProductsController
 * @package App\Http\Controllers
 */
class ProductsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function addProduct(Request $request) {

        if($request->isMethod('post')) {
            $data = $request->all();

            $validate = Validator::make($data, [
                'sort' => 'required|numeric',
                'category_id' => 'required',
                'name' => 'required',
                'code'  => 'required',
                'image' => 'image|mimes:jpeg,,jpg,png,gif,svg,webp,jfif:4086'
            ]);

            if($validate->passes()) {

                if(empty($data['status'])) {
                    $status = 0;
                } else {
                    $status = 1;
                }

                $product = new Products;
                $product->category_id = $data['category_id'];
                $product->sort = $data['sort'];
                $product->name = $data['name'];
                $product->code = $data['code'];
                $product->description = $data['description'];
                $product->price = $data['price'];
                $product->list_price = $data['list_price'];
                $product->status = $status;

                if($request->hasFile('image')) {
                    $image_tmp = $request->file('image');
                    if($image_tmp->isValid()) {
                        $extension = $image_tmp->getClientOriginalExtension();
                        $fileName = rand(111, 99999).'.'.$extension;
                        $largeImagePath = 'backend/images/products/large/'.$fileName;
                        $mediumImagePath = 'backend/images/products/medium/'.$fileName;
                        $smallImagePath = 'backend/images/products/small/'.$fileName;

                        // Resize image
                        Image::make($image_tmp)->save($largeImagePath);
                        Image::make($image_tmp)->resize(600, 600)->save($mediumImagePath);
                        Image::make($image_tmp)->resize(300, 300)->save($smallImagePath);

                        // Store image name in categories table
                        $product->image = $fileName;
                    }
                }
                if($product->save()) {
                    return redirect('/admin/view-products')->with('flash_message_success', 'The '.$product->name.' Has been created');
                }
            } else {
                return back()->with('flash_message_error', $validate->errors()->all());
            }
        }

        $categories = Category::where(['parent_id' => 0])->get();
        $categoriesDropdown = '<option selected disabled>Select</option>';
        foreach ($categories as $category) {
            $categoriesDropdown .= '<option value="'.$category->id.'">'.$category->name.'</option>';
            $subCategories = Category::where(['parent_id' => $category->id])->get();
            foreach ($subCategories as $subCategory) {
                $categoriesDropdown .= '<option value="'.$subCategory->id.'">&nbsp;--&nbsp;'.$subCategory->name.'</option>';
            }
        }
        return view('admin.products.add_product')->with(compact('categoriesDropdown'));
    }

    /**
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function editProduct(Request $request, $id = null) {
        if($request->isMethod('post')) {
            $data = $request->all();

            $validate = Validator::make($data, [
                'sort' => 'required|numeric',
                'category_id' => 'required',
                'name' => 'required',
                'code'  => 'required',
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
                        $largeImagePath = 'backend/images/products/large/'.$fileName;
                        $mediumImagePath = 'backend/images/products/medium/'.$fileName;
                        $smallImagePath = 'backend/images/products/small/'.$fileName;

                        // Resize image
                        Image::make($image_tmp)->save($largeImagePath);
                        Image::make($image_tmp)->resize(600, 600)->save($mediumImagePath);
                        Image::make($image_tmp)->resize(300, 300)->save($smallImagePath);
                    }
                } else {
                    $fileName = $data['current_image'];
                }

                Products::where(['id' => $id])->update([
                    'category_id' => $data['category_id'],
                    'sort'        => $data['sort'],
                    'name'        => $data['name'],
                    'code'        => $data['code'],
                    'description' => $data['description'],
                    'price'       => $data['price'],
                    'list_price'  => $data['list_price'],
                    'image'       => $fileName,
                    'status'      => $status
                ]);

                return redirect()->back()->with('flash_message_success', 'The '.$data['name'].' has been updated!');
            } else {
                return back()->with('flash_message_error', $validate->errors()->all());
            }
        }

        $productDetails = Products::where(['id' => $id])->first();

        $categories = Category::where(['parent_id' => 0])->get();
        $categoriesDropdown = '<option selected disabled>Select</option>';
        foreach ($categories as $category) {
            if($category->id == $productDetails->category_id) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            $categoriesDropdown .= '<option value="'.$category->id.'" '.$selected.'>'.$category->name.'</option>';
            $subCategories = Category::where(['parent_id' => $category->id])->get();
            foreach ($subCategories as $subCategory) {
                if($subCategory->id == $productDetails->category_id) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
                $categoriesDropdown .= '<option value="'.$subCategory->id.'" '.$selected.'>&nbsp;--&nbsp;'.$subCategory->name.'</option>';
            }
        }

        return view('admin.products.edit_product')->with(compact('productDetails', 'categoriesDropdown'));
    }

    /**
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteProductImage($id = null) {

        // Get product image name
        $productImage = Products::where(['id' => $id])->first();

        // Get product image path
        $largeImagePath = 'backend/images/products/large/';
        $mediumImagePath = 'backend/images/products/medium/';
        $smallImagePath = 'backend/images/products/small/';

        // Delete Large image if not exists in folder
        if(file_exists($largeImagePath.$productImage->image)) {
            unlink($largeImagePath.$productImage->image);
        }

        // Delete Medium image if not exists in folder
        if(file_exists($mediumImagePath.$productImage->image)) {
            unlink($mediumImagePath.$productImage->image);
        }

        // Delete Small image if not exists in folder
        if(file_exists($smallImagePath.$productImage->image)) {
            unlink($smallImagePath.$productImage->image);
        }

        Products::where(['id' => $id])->update(['image' => '']);
        return response()->json(['flash_message_success' => 'Product image has been deleted successfully!']);
    }

    /**
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteProduct($id = null) {
        Products::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success', 'Product has been deleted successfully!');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewProducts() {
        $products = Products::get();
        $products = json_decode(json_encode($products));
        foreach ($products as $key => $product) {
            $categoryName = Category::where(['id' => $product->category_id])->first();
            $products[$key]->category_name = $categoryName->name;
        }
        return view('admin.products.view_products')->with(compact('products'));
    }

    /**
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function addAttributes(Request $request, $id = null) {
        $productDetails = Products::with('attributes')->where(['id' => $id])->first();
        if($request->isMethod('post')) {
            $data = $request->all();
            foreach ($data['sku'] as $key => $val) {

                if(!empty($val)) {
                    $attribute = new ProductsAttributes;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }
            }
            return redirect('admin/add-attributes/'.$id)->with('flash_message_success', 'Product Attributes has been added successfully!');
        }
        return view('admin.products.add_attributes')->with(compact('productDetails'));
    }

    public function deleteAttribute($id = null) {
        ProductsAttributes::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success', 'Attribute has been deleted successfully!');
    }
}
