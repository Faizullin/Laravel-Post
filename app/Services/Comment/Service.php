<?php
/**
 * 
 */
namespace App\Services\Comment;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class Service {
    public function store($data){
        try {
            DB::beginTransaction();
            $comment= Comment::create($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            abort(500);
        }
        return $comment;
    }
    public function update($data,$comment)
    {
        try{
            DB::beginTransaction();
            $comment->update($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            abort(500);
        }
        return $comment;
    }
    public function multidelete($ids)
    {

        try{
            DB::beginTransaction();

            Comment::whereIn('id',$ids)->delete();
            
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        return 'success';
    }
}