<?php
/**
 * 
 */
namespace App\Services\Category;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class Service {
    public function store($data){
        try {
            DB::beginTransaction();
            $data['slug']=Str::slug($data['title']);
            $category= Category::firstOrCreate(['title'=>$data['title']],$data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            abort(500);
        }
        return $data;
    }
	public function update($data,$category)
    {
        try{
            DB::beginTransaction();
            $category->update($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            abort(500);
        }
        return $data;
    }
    public function multidelete($category_ids)
    {

        try{
            DB::beginTransaction();

            Category::whereIn('id',$category_ids)->delete();
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        return 'success';
    }
}