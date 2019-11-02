<?php

namespace App\Http\Controllers;

use App\PouroUnion;
use App\RegisterMember;
use App\Upozila;
use App\Village;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ApiDataController extends Controller
{
    public function upojila()
    {
        return Upozila::all();
    }
    public function pourosova($id)
    {
        return PouroUnion::where('upozila_id',$id)->get();
    }
    public function village($id)
    {
        return Village::where('pouro_or_union_id',$id)->get();
    }
    public function votkendro($id)
    {
        $village = Village::with('votekandros')->find($id);
        if($village!=null){
            return $village->votekandros;
        }
        return $village;

    }

    public function saveVoter(Request $request)
    {
        $input = $request->all();
        $response = ["success"=>true,"message"=>""];

        $info = RegisterMember::where('mobile_no',$input['mobile_no'])->orWhere('national_id',$input['national_id'])->first();

        if($info!=null){
            if($info->mobile_no == $input['mobile_no']){
                $response['success'] = false;
                $response['message'] = "mobile number already registered";
            }

            if($info->national_id == $input['national_id']){
                $response['success'] = false;
                $response['message'] .= "\n national id  number already registered";
            }

        }else{
            RegisterMember::create($input);
            $client = new Client();
            $res = $client->request('GET', 'https://bulksms.teletalk.com.bd/link_sms_send.php',
                ['query' => ['op' => 'SMS','user'=>'waterspeed','pass'=>'123456','mobile'=>$input['mobile_no'],'charset'=>'UTF-8','sms'=>'আপনাকে ধন্যবাদ। অধ্যাপক রফিকুল ইসলাম, সাবেক প্রতিমন্ত্রী']]);
            $response["mysms"] =  $res->getBody();
            $response["message"] = "user registered successfully";
        }
        echo json_encode($response);
    }

    public function getSearchResult(Request $request)
    {
        $response = ["success"=>false,"message"=>"no data found","info"=>""];
        $query = RegisterMember::query();
        if($request->mobile!=''){
            $query = $query->where('mobile_no', $request->mobile);
        }
        if($request->nationalId!=''){
            $query = $query->where('national_id', $request->nationalId);
        }
        if($request->upojela!=''){
            $query = $query->where('upazila', $request->upojela);
        }
        if($request->pourosova!=''){
            $query = $query->where('up_or_pouro_name', $request->pourosova);
        }
        if($request->village!=''){
            $query = $query->where('villege', $request->village);
        }
        $info = $query->get();

        if(count($info)>0){
            $response['success'] = true;
            $response['info'] = $info;

        }
        echo json_encode($response);
    }
}
