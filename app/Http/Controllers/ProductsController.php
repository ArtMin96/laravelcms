<?php

namespace App\Http\Controllers;

use App\Country;
use App\Coupon;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;
use App\ProductFiles;
use App\ProductsAttributes;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Session;
use Image;
use Validator;
use App\Category;
use App\Products;
use Illuminate\Support\Str;
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
                'name' => 'required',
                'code'  => 'required',
                'image' => 'image|mimes:jpeg,,jpg,png,gif,svg,webp,jfif:4086',
            ]);

            if($validate->passes()) {

                if(empty($data['status'])) {
                    $status = 0;
                } else {
                    $status = 1;
                }

                $product = new Products;
                $product->category_id = $data['category_id'];
                $product->sort        = $data['sort'];
                $product->name        = $data['name'];
                $product->code        = $data['code'];
                $product->description = $data['description'];
                $product->care        = $data['care'];
                $product->price       = $data['price'];
                $product->list_price  = $data['list_price'];
                $product->status      = $status;

                // Main Image
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

                $product->save();

                // More photos
                if($request->hasFile('more_photo')) {
                    $morePhotos = $request->file('more_photo');

                    foreach ($morePhotos as $files) {

                        // Upload images after resize
                        $image = new ProductFiles;
                        $extensions = $files->getClientOriginalExtension();
                        $filesName = rand(111, 99999).'.'.$extensions;

                        // Add images to specific paths
                        $largeImagesPath = 'backend/images/products/large/'.$filesName;
                        $mediumImagesPath = 'backend/images/products/medium/'.$filesName;
                        $smallImagesPath = 'backend/images/products/small/'.$filesName;

                        // Resize images
                        Image::make($files)->save($largeImagesPath);
                        Image::make($files)->resize(600, 600)->save($mediumImagesPath);
                        Image::make($files)->resize(300, 300)->save($smallImagesPath);

                        $image->more_photo = $filesName;
                        $image->product_id = $product->id;
                        $image->save();
                    }
                }

                return redirect('/admin/view-products')->with('flash_message_success', 'The '.$product->name.' Has been created');
            } else {
                return back()->with('flash_message_error', $validate->errors()->all());
            }
        }

        $categories = Category::where(['parent_id' => 0])->get();
        $categoriesDropdown = '<option value="" selected disabled>Select</option>';
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
                'name' => 'required',
                'code'  => 'required',
                'image' => 'image|mimes:jpeg,,jpg,png,gif,svg,webp,jfif:4086',
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
                    'care'        => $data['care'],
                    'price'       => $data['price'],
                    'list_price'  => $data['list_price'],
                    'image'       => $fileName,
                    'status'      => $status
                ]);

                // More photos
                if($request->hasFile('more_photo')) {
                    $morePhotos = $request->file('more_photo');

                    foreach ($morePhotos as $files) {

                        // Upload images after resize
                        $image = new ProductFiles;
                        $extensions = $files->getClientOriginalExtension();
                        $filesName = rand(111, 99999).'.'.$extensions;

                        // Add images to specific paths
                        $largeImagesPath = 'backend/images/products/large/'.$filesName;
                        $mediumImagesPath = 'backend/images/products/medium/'.$filesName;
                        $smallImagesPath = 'backend/images/products/small/'.$filesName;

                        // Resize images
                        Image::make($files)->save($largeImagesPath);
                        Image::make($files)->resize(600, 600)->save($mediumImagesPath);
                        Image::make($files)->resize(300, 300)->save($smallImagesPath);

                        $image->more_photo = $filesName;
                        $image->product_id = $data['product_id'];
                        $image->save();
                    }
                }

                return redirect()->back()->with('flash_message_success', 'The '.$data['name'].' has been updated!');
            } else {
                return back()->with('flash_message_error', $validate->errors()->all());
            }
        }

        $productDetails = Products::where(['id' => $id])->first();

        // Get Categories and Sub Categories
        $categories = Category::where(['parent_id' => 0])->get();
        $categoriesDropdown = '<option value="" selected disabled>Select</option>';
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

        // Get More Photos
        $morePhotos = ProductFiles::where(['product_id' => $id])->get();

        return view('admin.products.edit_product')->with(compact('productDetails', 'categoriesDropdown', 'morePhotos'));
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteMorePhotos($id = null) {

        // Get product image name
        $productImage = ProductFiles::where(['id' => $id])->first();

        // Get product image path
        $largeImagePath = 'backend/images/products/large/';
        $mediumImagePath = 'backend/images/products/medium/';
        $smallImagePath = 'backend/images/products/small/';

        // Delete Large image if not exists in folder
        if(file_exists($largeImagePath.$productImage->more_photo)) {
            unlink($largeImagePath.$productImage->more_photo);
        }

        // Delete Medium image if not exists in folder
        if(file_exists($mediumImagePath.$productImage->more_photo)) {
            unlink($mediumImagePath.$productImage->more_photo);
        }

        // Delete Small image if not exists in folder
        if(file_exists($smallImagePath.$productImage->more_photo)) {
            unlink($smallImagePath.$productImage->more_photo);
        }

        ProductFiles::where(['id' => $id])->delete();
        return response()->json(['flash_message_success' => 'Image has been deleted successfully!']);
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
        $products = Products::orderBy('id', 'DESC')->get();
        $products = json_decode(json_encode($products));
        foreach ($products as $key => $product) {
            $categoryName = Category::where(['id' => $product->category_id])->first();

            if(!empty($categoryName)) {
                $products[$key]->category_name = $categoryName->name;
            } else {
                return redirect()->back()->with('flash_message_error', 'Categories attached to products may not exist. Please check the categories!');
            }
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

                    // Prevent duplicate Product SKU
                    $attributesCountSKU = ProductsAttributes::where('sku', $val)->count();
                    if($attributesCountSKU > 0) {
                        return redirect('admin/add-attributes/'.$id)->with('flash_message_error', 'SKU: '.$val.' already exists for this product! Please add another SKU.');
                    }

                    // Prevent duplicate Product Size
                    $attributesCountSize = ProductsAttributes::where(['product_id' => $id, 'size' => $data['size'][$key]])->count();
                    if($attributesCountSize > 0) {
                        return redirect('admin/add-attributes/'.$id)->with('flash_message_error', 'Size: '.$data['size'][$key].' already exists for this product! Please add another size.');
                    }

                    $attribute = new ProductsAttributes;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();

                    return redirect('admin/add-attributes/'.$id)->with('flash_message_success', 'Product Attributes has been added successfully!');
                }
            }
        }
        return view('admin.products.add_attributes')->with(compact('productDetails'));
    }

    public function editAttributes(Request $request, $id = null) {
        if($request->isMethod('post')) {
            $data = $request->all();

            foreach ($data['idAttr'] as $key => $attr) {
                ProductsAttributes::where(['id' => $data['idAttr'][$key]])->update([
                    'price' => $data['price'][$key],
                    'stock' => $data['stock'][$key],
                ]);
            }

            return redirect()->back()->with('flash_message_success', 'Attribute has been updated!');
        }
    }

    /**
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAttribute($id = null) {
        ProductsAttributes::where(['id' => $id])->delete();
        return redirect()->back()->with('flash_message_success', 'Attribute has been deleted successfully!');
    }

    /**
     * @param null $url
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function products($url = null) {

        $countCategory = Category::where(['url' => $url, 'status' => 1])->count();

        if($countCategory == 0) {
            abort(404);
        }

        $categories = Category::with('categories')->where(['parent_id' => 0])->get();

        $categoryDetails = Category::where(['url' => $url])->first();

        if($categoryDetails->parent_id == 0) {
            // If url is main category url
            $subCategories = Category::where(['parent_id' => $categoryDetails->id])->get();
            foreach ($subCategories as $subCategory) {
                $categoryIds[] = $subCategory->id;
            }
            $productsAll = Products::whereIn('category_id', $categoryIds)->where('status', 1)->get();
        } else {
            // If url is sub category url
            $productsAll = Products::where(['category_id' => $categoryDetails->id])->get();
        }

        return view('products.listing')->with(compact('categories', 'categoryDetails', 'productsAll'));
    }

    /**
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function product($id = null) {

        // Show 404 page if product is disabled
        $productsCount = Products::where(['id' => $id, 'status' => 1])->count();
        if($productsCount == 0) {
            abort(404);
        }

        $productDetails = Products::with('attributes')->where('id', $id)->first();
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();

        // Related Products
        $relatedProducts = Products::where('id', '!=', $id)->where(['category_id' => $productDetails->category_id])->get();

        // Get Product More Photos
        $productMorePhotos = ProductFiles::where('product_id', $id)->get();

        // Sum of stock
        $totalStock = ProductsAttributes::where('product_id', $id)->sum('stock');

        return view('products.detail')->with(compact('productDetails', 'categories', 'productMorePhotos', 'totalStock', 'relatedProducts'));
    }

    /**
     * @param Request $request
     */
    public function getProductPrice(Request $request) {
        $data = $request->all();
        $productArr = explode('-', $data['productByAttribute']);
        $productAttr = ProductsAttributes::where(['product_id' => $productArr[0], 'size' => $productArr[1]])->first();
        echo $productAttr->price;
        echo '#';
        echo $productAttr->stock;
    }

    /**
     * @param Request $request
     */
    public function addToCart(Request $request) {

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();

        if(empty(Auth::user()->name)) {
            $data['user_name'] = '';
        } else {
            $data['user_name'] = Auth::user()->name;
        }

        if(empty(Auth::user()->email)) {
            $data['user_email'] = '';
        } else {
            $data['user_email'] = Auth::user()->email;
        }

        if(empty($data['session_id'])) {
            $data['session_id'] = '';
        }

        if(empty($data['list_price'])) {
            $data['list_price'] = '';
        }

        if(empty($data['size'])) {
            $sizeArray = $data['size'] = '';
        } else {
            $sizeArray = explode('-', $data['size']);
        }

        $session_id = Session::get('session_id');

        // Generate session id
        if(empty($session_id)) {
            $session_id = Str::random(40);
            Session::put('session_id', $session_id);
        }

        $countProducts = DB::table('cart')->where([
            'product_id' => $data['product_id'],
            'size' => $sizeArray[1],
            'session_id' => $session_id,
        ])->count();

        if ($countProducts > 0) {
            return redirect()->back()->with('flash_message_warning', $data['product_name'].' already exists in Cart.');
        } else {

            $getSKU = ProductsAttributes::select('sku')->where(['product_id' => $data['product_id'], 'size' => $sizeArray[1]])->first();

            if(empty(Auth::user()->name)) {
                $data['user_name'] = '';
            } else {
                $data['user_name'] = Auth::user()->name;
            }

            if(empty(Auth::user()->email)) {
                $data['user_email'] = '';
            } else {
                $data['user_email'] = Auth::user()->email;
            }

            DB::table('cart')->insert([
                'product_id' => $data['product_id'],
                'product_name' => $data['product_name'],
                'product_code' => $getSKU->sku,
                'size' => $sizeArray[1],
                'price' => $data['price'],
                'list_price' => $data['list_price'],
                'quantity' => $data['quantity'],
                'user_name' => $data['user_name'],
                'user_email' => $data['user_email'],
                'session_id' => $session_id,
            ]);

            return redirect('cart')->with('flash_message_success', $data['product_name'].' has been added in Cart.');
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cart() {

        if(Auth::check()) {
            $userEmail = Auth::user()->email;
            $userCart = DB::table('cart')->where(['user_email' => $userEmail])->get();
        } else {
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id' => $session_id])->get();
        }

        foreach ($userCart as $key => $product) {
            $productDDetails = Products::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productDDetails->image;
        }

        return view('products.cart')->with(compact('userCart'));
    }

    /**
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteCartProduct($id = null) {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        DB::table('cart')->where('id', $id)->delete();
        return redirect('cart')->with('flash_message_success', 'Product has been deleted from Cart.');
    }

    /**
     * @param null $id
     * @param null $quantity
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateCartQuantity($id = null, $quantity = null) {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $getProductSKU  = DB::table('cart')->where('id', $id)->first();
        $getProductStock = ProductsAttributes::where('sku', $getProductSKU->product_code)->first();
        $updatedQuantity = $getProductSKU->quantity + $quantity;

        if ($getProductStock->stock >= $updatedQuantity) {
            DB::table('cart')->where('id', $id)->increment('quantity', $quantity);
            return redirect('cart')->with('flash_message_success', 'Product quantity has been updated.');
        } else {
            return redirect('cart')->with('flash_message_error', 'Required product quantity is not available.');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function applyCoupon(Request $request) {
        $data = $request->all();
        $couponCount = Coupon::where('coupon_code', $data['coupon_code'])->count();
        if($couponCount == 0) {
            return redirect()->back()->with('flash_message_error', $data['coupon_code'].' does not exist.');
        } else {
            // Perform other checks like Active/Inactive, Expiry etc.

            Session::forget('CouponAmount');
            Session::forget('CouponCode');

            // Get Coupon details
            $couponDetails = Coupon::where('coupon_code', $data['coupon_code'])->first();

            // If coupon is Inactive
            if($couponDetails->status == 0) {
                return redirect()->back()->with('flash_message_error', $data['coupon_code'].' is not active.');
            }

            // If coupon is Expired
            $expiryDate = $couponDetails->expiry_date;
            $currentDate = date('Y-m-d H:i:s');

            if ($expiryDate < $currentDate) {
                return redirect()->back()->with('flash_message_error', $data['coupon_code'].' is expired.');
            }

            // Coupon is Valid for Discount

            // Get cart total amount
            $sessionId = Session::get('session_id');

            if(Auth::check()) {
                $userEmail = Auth::user()->email;
                $userCart = DB::table('cart')->where(['user_email' => $userEmail])->get();
            } else {
                $session_id = Session::get('session_id');
                $userCart = DB::table('cart')->where(['session_id' => $session_id])->get();
            }

            $totalAmount = 0;
            foreach ($userCart as $key => $item) {
                $totalAmount = $totalAmount + ($item->price * $item->quantity);
            }

            // Check if amount is fixed or percentage
            if($couponDetails->amount_type == 'Fixed') {
                $couponAmount = $couponDetails->amount;
            } else {
                $couponAmount = $totalAmount * ($couponDetails->amount / 100);
            }

            // Add coupon code and amount in session
            Session::put('CouponAmount', $couponAmount);
            Session::put('CouponCode', $data['coupon_code']);

            return redirect()->back()->with('flash_message_success', 'Coupon code '.$data['coupon_code'].' successfully applied. You are availing discount!');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function checkout(Request $request) {
        $userId = Auth::user()->id;
        $userEmail = Auth::user()->email;
        $userDetails = User::find($userId);
        $countries = Country::get();

        // Check if Shipping address exists
        $shippingCount = DeliveryAddress::where('user_id', $userId)->count();
        $shippingDetails = [];
        if ($shippingCount > 0) {
            $shippingDetails = DeliveryAddress::where('user_id', $userId)->first();
        }

        // Update cart table with user email
        $sessionId = Session::get('session_id');
        DB::table('cart')->where(['session_id' => $sessionId])->update(['user_email' => $userEmail]);

        if ($request->isMethod('post')) {
            $data = $request->all();

            $validate = Validator::make($data, [
                'billing_name' => 'required|min:2',
                'billing_address' => 'required|min:5',
                'billing_city'  => 'required|string',
                'billing_state'  => 'required|string',
                'billing_country'  => 'required|string',
                'billing_pincode'  => 'required|string',
                'billing_phone'  => 'required|numeric|min:5',
                'shipping_name'  => 'required|min:2',
                'shipping_address'  => 'required|min:5',
                'shipping_city'  => 'required|string',
                'shipping_state'  => 'required|string',
                'shipping_country'  => 'required|string',
                'shipping_pincode'  => 'required|string',
                'shipping_phone'  => 'required|numeric|min:5',
            ]);

            if($validate->fails()) {
                return redirect()->back()->with('flash_message_validation_error', $validate->errors()->all());
            }

            // Update user details
            User::where('id', $userId)->update([
                'name' => $data['billing_name'],
                'address' => $data['billing_address'],
                'city' => $data['billing_city'],
                'state' => $data['billing_state'],
                'country' => $data['billing_country'],
                'pincode' => $data['billing_pincode'],
                'phone' => $data['billing_phone'],
            ]);

            if($shippingCount > 0) {
                // Update Shipping address
                DeliveryAddress::where('user_id', $userId)->update([
                    'name' => $data['shipping_name'],
                    'address' => $data['shipping_address'],
                    'city' => $data['shipping_city'],
                    'state' => $data['shipping_state'],
                    'country' => $data['shipping_country'],
                    'pincode' => $data['shipping_pincode'],
                    'phone' => $data['shipping_phone'],
                ]);

                $message = 'Shipping details has been updated.';
            } else {
                // Add new Shipping address
                $shipping = new DeliveryAddress;
                $shipping->user_id = $userId;
                $shipping->user_email = $userEmail;
                $shipping->name = $data['shipping_name'];
                $shipping->address = $data['shipping_address'];
                $shipping->city = $data['shipping_city'];
                $shipping->state = $data['shipping_state'];
                $shipping->country = $data['shipping_country'];
                $shipping->pincode = $data['shipping_pincode'];
                $shipping->phone = $data['shipping_phone'];
                $shipping->save();

                $message = 'Shipping details has been added.';
            }

            return redirect()->action('ProductsController@orderReview')->with('flash_message_success', $message);
        }
        return view('products.checkout')->with(compact('userDetails', 'countries', 'shippingDetails'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function orderReview() {
        $userId = Auth::user()->id;
        $userEmail = Auth::user()->email;
        $userDetails = User::where('id', $userId)->first();
        $shippingDetails = DeliveryAddress::where('user_id', $userId)->first();
        $userDetails = json_decode(json_encode($userDetails));

        $userCart = DB::table('cart')->where(['user_email' => $userEmail])->get();

        foreach ($userCart as $key => $product) {
            $productDDetails = Products::where('id', $product->product_id)->first();
            $userCart[$key]->image = $productDDetails->image;
        }

        return view('products.order_review')->with(compact('userDetails', 'shippingDetails', 'userCart'));
    }

    /**
     * @param Request $request
     */
    public function placeOrder(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();
            $userId = Auth::user()->id;
            $userEmail = Auth::user()->email;

            // Get shipping address of user
            $shippingDetails = DeliveryAddress::where(['user_email' => $userEmail])->first();

            if (empty(Session::get('CouponCode'))) {
                $couponCode = '';
            } else {
                $couponCode = Session::get('CouponCode');
            }

            if (empty(Session::get('CouponAmount'))) {
                $couponAmount = '';
            } else {
                $couponAmount = Session::get('CouponAmount');
            }

            $order = new Order;
            $order->user_id = $userId;
            $order->user_email = $userEmail;
            $order->name = $shippingDetails->name;
            $order->address = $shippingDetails->address;
            $order->phone = $shippingDetails->phone;
            $order->pincode = $shippingDetails->pincode;
            $order->city = $shippingDetails->city;
            $order->state = $shippingDetails->state;
            $order->country = $shippingDetails->country;

            $order->coupon_code = $couponCode;
            $order->coupon_amount = $couponAmount;
            $order->order_status = 'New';
            $order->payment_method = $data['payment_method'];
            $order->grand_total = $data['grand_total'];
            $order->save();

            $orderId = DB::getPdo()->lastInsertId();

            $cartProducts = DB::table('cart')->where(['user_email' => $userEmail])->get();

            foreach ($cartProducts as $cartProduct) {
                $orderProduct = new OrdersProduct;
                $orderProduct->order_id = $orderId;
                $orderProduct->user_id = $userId;
                $orderProduct->product_id = $cartProduct->product_id;
                $orderProduct->product_code = $cartProduct->product_code;
                $orderProduct->product_name = $cartProduct->product_name;
                $orderProduct->product_size = $cartProduct->size;
                $orderProduct->product_price = $cartProduct->price;
                $orderProduct->product_qty = $cartProduct->quantity;
                $orderProduct->save();
            }

            Session::put('order_id', $orderId);
            Session::put('grand_total', $data['grand_total']);

            if ($data['payment_method'] == 'PayPal') {
                return redirect('/paypal');
            }
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function thanks(Request $request) {
        $userEmail = Auth::user()->email;
        DB::table('cart')->where('user_email', $userEmail)->delete();
        return view('orders.thanks');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userOrders() {
        $userId = Auth::user()->id;
        $orders = Order::with('orders')->where('user_id', $userId)->get();
        return view('orders.user_orders')->with(compact('orders'));
    }

    /**
     * Payment
     */

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function paypal(Request $request) {
        $userEmail = Auth::user()->email;
        DB::table('cart')->where('user_email', $userEmail)->delete();
        return view('payment.paypal.paypal');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function thanksPaypal() {
        return view('payment.paypal.thanks');
    }

    public function cancelPaypal() {
        return view('payment.paypal.cancel');
    }
}
