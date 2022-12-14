<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Controllers\User\Resources\ProductController;
use App\Http\Controllers\User\Resources\SaleoffController;
use App\Models\Product;
use App\Models\SaleOff;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
	public function gethomepage(){
		$saleoff_pro = Product::where('saleoff_id', '!=', '1')->get();
		$pro_cat_list = [];
		foreach($saleoff_pro as $item){
			if(!in_array($item->category_id, $pro_cat_list)){
				$pro_cat_list = array_merge($pro_cat_list, [$item->category_id]);
				error_log($item->category_id);
			}
				
		}
		$pro_cat = [];
		foreach ($pro_cat_list as $item) {
			$pro_cat = array_merge($pro_cat, [Category::where('id', $item)->first()]);
		}

		$data = ([
			'saleoffs' => SaleoffController::getSaleoffs(),
			'categories' => Category::get(),
			'products' => ProductController::getProducts(25),
			
			'saleoff_products' => $saleoff_pro,
			'productable_categories' => $pro_cat,
		]);
		return view('user.home', $data);
	}
	public function show($what, $id)
	{
		switch($what){
			case 'product':
				$data = ([
					'item' => ProductController::getProduct($id),
					'view' => 'user.show.product',
				]);
				return view('user.show', $data);
				break;
			case 'category':
				//
				break;
			case 'saleoff':
				//
				break;
			default:
				//
		};

		return;
	}

	public function notFound(){
		return view('user.errors.404');
	}
}

