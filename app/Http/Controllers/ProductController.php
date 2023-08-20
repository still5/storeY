<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function index()
    {
        $model = new Product();
        $products = $model->getActiveProductsWithImageNames();
        return view('products.index', compact('products'));
    }

    public function showProduct($id) {
        $model = new Product();
        $product = $model->getProductByIdWithImageName($id);
        if ($product->isEmpty()) {
            $text = 'Product not found';

            return view('404', compact('text'));

        } else {
            $product = $product->first();
        }

        return view('products.view', compact('product'));
    }

    public function delete($id) {
        $data['is_active'] = 0;
        $model = Product::where('id', $id);
        $model->update($data);

        return redirect()->route('home');
    }

    public function getProductForUpdate(Request $request, $productId) {
        if (!Auth::check()) {
            $text = 'You\'re not authorized to edit products';

            return view('404', compact('text'));
        }
        $model = new Product();
        $product = $model->getProductByIdWithImageName($productId);
        if ($product->isEmpty()) {
            $text = 'Can\'t find product with ID '.$productId;

            return view('404', compact('text'));

        } else {
            if ((!$request->user()->is_admin)) {
                $text = 'You have no rights to edit this order';

                return view('404', compact('text'));
            }

            $product = $product->first();
        }

        return view('products.edit', compact('product'));
    }

    public function createPage() {

        return view('products.create');
    }

    public function createProduct(Request $request) {
        $data = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'discount_price' => $request->input('discount_price'),
            'description_short' => $request->input('description_short'),
            'description_full' => $request->input('description_full'),
            'specifications' => $request->input('specifications'),
            'is_active' => $request->input('is_active') ? 1 : 0,
        ];
        $newProduct = Product::create($data);
        $productId = $newProduct->id;

        $fileModel = new ProductImage();
        if($request->file('file')) {
            $fileName = $request->file->getClientOriginalName();
            $filePath = '/public/img/Products/'; // . $fileName;
            $fileModel->id = $productId;
            $fileModel->is_main = 1;
            $fileModel->filename = $fileName;
            $fileModel->product_id = $productId;
            $fileModel->save();
            $request->file('file')->storeAs($filePath, $fileName);
        }

        return redirect()->route('products.view', [$productId]);
    }

    public function updateProduct(Request $request, $productId)
    {
        $data = [
            'name' => $request->get('name'),
            'price' => $request->get('price'),
            'discount_price' => $request->get('discount_price'),
            'description_short' => $request->get('description_short'),
            'description_full' => $request->get('description_full'),
            'specifications' => $request->get('specifications'),
        ];
        $data['is_active'] = $request->get('is_active') ? 1 : 0;

        $model = Product::where('id', $productId);
        $model->update($data);

        if($request->file('file')) {
            $file = $request->file('file');
            $productImage = (new ProductImage)->findMainImageForProduct($productId);
            $fileName = $file->getClientOriginalName();
            $filePath = '/public/img/Products/';
            $imageData = [
                'product_id' => $productId,
                'is_main' => 1,
                'filename' => $fileName,
            ];
            if ($productImage) {
                $productImage->update($imageData);
            } else {
                ProductImage::create($imageData);
            }
            $request->file('file')->storeAs($filePath, $fileName);
        }

        return redirect()->route('products.view', [$productId]);
    }

    private function handleFile($file) {

    }
}

