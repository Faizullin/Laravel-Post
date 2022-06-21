<?php
/**
 * 
 */
namespace App\Services\Post;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class Service {

    public function store($data){
        try {
            DB::beginTransaction();
            $tag_ids=$data['tag_ids'];
            unset($data['tag_ids']);
            
            $post = Post::firstOrCreate(['title'=>$data['title']],$data);

            $post->tags()->attach($tag_ids);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            abort(500);
        }
        return $post;
    }
	public function update($data,$post)
    {
        
        try{
            DB::beginTransaction();
            $tag_ids = $data['tag_ids'];

            unset($data['tag_ids']);
            $post->update($data);
            $post->tags()->sync($tag_ids);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            abort(500);
        }
        return $post;
    }
    public function multidelete($post_ids)
    {

        try{
            DB::beginTransaction();

            Post::whereIn('id',$post_ids)->delete();
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            abort(500);
            return $e->getMessage();
        }
        return 'success';
    }
}