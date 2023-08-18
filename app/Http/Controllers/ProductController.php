<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use Illuminate\Http\Request;
use App\Models\Product; // Import your Product model
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    //
    public function index()
    {
        $model = new Product();
        $products = $model->getActiveProducts();
        return view('products.index', compact('products'));
    }

    public function showProduct($id) {
        $model = new Product();
        $product = $model->getProductById($id);
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
        $product = $model->getProductById($productId);
          Log::debug('The product: ' . json_encode($product));
        if ($product->isEmpty()) {
            $text = 'Can\'t find product with ID '.$productId;

            return view('404', compact('text'));

        } else {
            if ((!$request->user()->is_admin)) {
                $text = 'You have no rights to edit this order';

                return view('404', compact('text'));
            }

            $productModel = new Product();
            $product = $productModel->getProductById($productId);
            $product = $product->first();
        }

        return view('products.edit', compact('product'));
    }

    public function createPage() {

        return view('products.create');
    }

    public function createProduct(CreateProductRequest $request) {
        $data = [
            'name' => $request->validated('name'),
            'price' => $request->validated('price'),
            'discount_price' => $request->validated('discount_price'),
            'description_short' => $request->validated('description_short'),
            'description_full' => $request->validated('description_full'),
            'specifications' => $request->validated('specifications'),
            'is_active' => $request->validated('is_active') ? 1 : 0,
        ];
        $newProduct = Product::create($data);
        $productId = $newProduct->id;

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

        return redirect()->route('products.view', [$productId]);
    }
}

