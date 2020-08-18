<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ProductFetchController extends Controller
{
    public function fetchProduct(Request $request)
    {
		//column list in the table Prpducts
        $columns = array(
			0 => 'title',
            1 => 'content',
            2 => 'image',
			3 => 'created_at',
			4 => 'action'
		);
		
		//get the total number of data in Product table
		$totalData = Product::count();
		//total number of data that will show in the datatable default 10
		$limit = $request->input('length');
		//start number for pagination ,default 0
		$start = $request->input('start');
		//order list of the column
		$order = $columns[$request->input('order.0.column')];
		//order by ,default asc 
		$dir = $request->input('order.0.dir');
		
		//check if user search for a value in the product datatable
		if(empty($request->input('search.value'))){
			//get all the product data
			$posts = Product::offset($start)
					->limit($limit)
					->orderBy($order,$dir)
					->get();
			
			//total number of filtered data
			$totalFiltered = Product::count();
		}else{
            $search = $request->input('search.value');
            
			$posts = Product::where('title', 'like', "%{$search}%")
                            ->orWhere('content','like',"%{$search}%")
                            ->orWhere('image','like',"%{$search}%")
							->orWhere('created_at','like',"%{$search}%")
							->offset($start)
							->limit($limit)
							->orderBy($order, $dir)
							->get();

			//total number of filtered data matching the search value request in the product table	
            $totalFiltered = Product::where('title', 'like', "%{$search}%")
                            ->orWhere('content','like',"%{$search}%")
                            ->orWhere('image','like',"%{$search}%")
							->count();
		}		
					
		
		$data = array();
		
		if($posts){
			//loop posts collection to transfer in another array $nestedData
			foreach($posts as $r){
				$nestedData['id'] = $r->id;
				$nestedData['title'] = $r->title;
                $nestedData['content'] = $r->content;
                $nestedData['image'] = $r->image;
				$nestedData['created_at'] = date('d-m-Y',strtotime($r->created_at));
                $nestedData['action'] = '
                    <button name="show" id="show" data-id="'.$r->id.'" class="btn btn-primary btn-xs">Show</button>
					<button name="edit" id="edit" data-id="'.$r->id.'" class="btn btn-warning btn-xs">Edit</button>
					<button name="delete" id="delete" data-id="'.$r->id.'" class="btn btn-danger btn-xs">Delete</button>
				';
				$data[] = $nestedData;
			}
		}
		
		$json_data = array(
			"draw"			    => intval($request->input('draw')),
			"recordsTotal"	    => intval($totalData),
			"recordsFiltered"   => intval($totalFiltered),
			"data"			    => $data
		);
		
		//return the data in json response
		return response()->json($json_data);
    }
}
