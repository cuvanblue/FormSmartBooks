<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\ImageRepository;
use App\Repositories\Eloquent\ProductCategoryRepository;
use App\Repositories\Eloquent\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    protected $_productRepository;
    protected $_productCategoryRepository;
    protected $_categoryRepository;
    protected $_imageRespository;
    public function __construct(
        ProductRepository $productRepository,
        ProductCategoryRepository $productCategoryRepository,
        CategoryRepository $categoryRepository,
        ImageRepository $imageRespository
    ) {
        $this->_productRepository = $productRepository;
        $this->_productCategoryRepository = $productCategoryRepository;
        $this->_categoryRepository = $categoryRepository;
        $this->_imageRespository = $imageRespository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return Collection|ProductRepository[]
     */
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => [
                'product' => $this->_productRepository->getProductsIndex(),
                'hotProduct' => $this->_productRepository->getProductsByCategory(12),
                'newProduct' => $this->_productRepository->getProductsByCategory(11),
                'thumbnail' => $this->_imageRespository->getThumbnails()
            ]
        ], 200);
    }
    public function productDetail($id)
    {
        $result = $this->_productRepository->findById($id);
        if ($result) {
            return response()->json([
                'status' => 200,
                'data' => $result
            ], 200);
        }
        return response()->json([
            'status' => 401,
            'message' => 'Product not found',
        ], 401);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function addProduct(Request $request)
    {
        $result = $request->all();

        $validator = Validator::make($result, [
            'name' => ['required', 'max:255'],
            'slug' => ['nullable'],
            'price' => ['required'],
            'sku' => ['required', 'unique:product'],
            'detail_product' => ['max:255', 'nullable'],
            'description' => ['nullable'],
            'brand_id' => ['nullable', 'integer'],
            'image' => ['nullable'],
            'category_id' => ['integer', 'nullable'],
            'status' => ['nullable', 'integer']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => 'Validate failed, pls check again',
                'errors' => $validator->errors()
            ], 400);
        }

        $this->_productRepository->create($result);
        return response()->json([
            'status' => 200,
            'message' => 'Created',
            'data' => $result
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $result = $this->_productRepository->findById($id);

        if ($result) {
            return response()->json([
                'status' => 200,
                'data' => $result
            ], 200);
        }

        return response()->json([
            'status' => 401,
            'message' => 'Product not found',
        ], 401);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $result = $request->all();
        $productById = $this->_productRepository->findById($id);
        if ($productById) {
            $validator = Validator::make($result, [
                'name' => ['required', 'max:255'],
                'slug' => ['nullable'],
                'price' => ['required', 'numeric', 'between:0,9999999999.99'],
                'quantity' => ['required', 'numeric'],
                'sku' => ['required', 'unique:product'],
                'detail_product' => ['max:255', 'nullable'],
                'description' => ['nullable'],
                'brand_id' => ['nullable', 'integer'],
                'image' => ['nullable'],
                'category_id' => ['integer', 'nullable'],
                'status' => ['nullable', 'integer']
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Validate failed, pls check again',
                    'errors' => $validator->errors()
                ], 400);
            }

            $this->_productRepository->update($result, $id);
            return response()->json([
                'status' => 200,
                'message' => 'Updated',
                'data' => $result
            ], 200);
        }

        return response()->json([
            'status' => 401,
            'message' => 'Product not found',
        ], 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $productById = $this->_productRepository->findById($id);
        if ($productById) {
            $this->_productRepository->delete($id);
            return response()->json([
                'status' => 200,
                'message' => 'Deleted',
            ], 200);
        }
        return response()->json([
            'status' => 401,
            'message' => 'Product not found',
        ], 401);
    }
}