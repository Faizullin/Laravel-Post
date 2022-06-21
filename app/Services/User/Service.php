<?php
namespace App\Services\User;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;

class Service {
    public function store($data){
        try {
            DB::beginTransaction();
            $user= User::firstOrCreate(['name'=>$data['name'],'email'=>$data['email']],$data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            abort(500);
        }
        return $user;
    }
	public function update($data,$user)
    {
        try{
            DB::beginTransaction();
            $user->update($data);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            abort(500);
        }
        return $user;
    }
    public function multidelete($ids)
    {

        try{
            DB::beginTransaction();
            User::whereIn('id',$ids)->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            abort(500);
        }
        return 'success';
    }
}