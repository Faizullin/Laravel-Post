<?php
namespace App\Services\Tag;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class Service {
    public function store($data){
        try {
            DB::beginTransaction();
            $data['slug']=Str::slug($data['title']);
            $tag= Tag::firstOrCreate(['title'=>$data['title']],$data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            abort(500);
        }
        return $data;
    }
	public function update($data,$tag)
    {
        try{
            DB::beginTransaction();
            $tag->update($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            abort(500);
        }
        return $data;
    }
    public function multidelete($ids)
    {

        try{
            DB::beginTransaction();

            Tag::whereIn('id',$ids)->delete();
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        return 'success';
    }
}