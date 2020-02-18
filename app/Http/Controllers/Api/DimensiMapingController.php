<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Dimensi;
use App\Model\DimensiMaping;
use Illuminate\Http\Request;

class DimensiMapingController extends Controller
{
    private $op=['eq'=>'=','neq'=>'!=','startswith'=>'like','contains'=>'like'];

    public function index(Request $request){
        $dimensiAll = Dimensi::get();
        $maping=DimensiMaping::selectRaw('*');

        if(isset($request->filter)){
            foreach($request->filter as $row){
                $operator = $this->op[$row['operator']];
                switch ($row['operator']) {
                    case 'contains':
                        $maping->where($row['field'],$operator,'%'.$row['value'].'%');
                        break;
                    
                    case 'startswith':
                        $maping->where($row['field'],$operator,$row['value'].'%');
                        break;
                    
                    default:
                        $maping->where($row['field'],$operator,$row['value']);
                        break;
                }
            }
        }

        $data= $maping->get();
        
        foreach($data as $key=>$row){
            foreach($dimensiAll as $kd=>$rowkd){
                if($row->dimensiAid==$rowkd->id)
                    $data[$key]->dimensiA = $rowkd->description;
                
                if($row->dimensiBid==$rowkd->id)
                    $data[$key]->dimensiB = $rowkd->description;

            }
        }

        if(isset($request->callback))
            return $request->callback.'('. json_encode(['result'=>$data]).')';
        else
            return $data;
    }

    public function store(Request $request){
        $request->validate([
            'dimensiAid' => 'required',
            'dimensiBid' => 'required|different:dimensiAid',
            'label' => 'required',
        ],[
            'dimensiBid.different'=>'Dimensi A tidak boleh sama dengan Dimensi B'
        ]);
        
        $dimensi = new DimensiMaping($request->all());
        $res = $dimensi->save();
        
        if($res)
            return ['msg'=>"Data ".$request->label." Berhasil disimpan"];
        else
            return ['msg'=>"Data Gagal Disimpan"];
    }

    public function destroy(Request $request,$id){
        $delId = $request->delid;
        if(is_array($delId)){
            DimensiMaping::destroy($delId);
        }else{
            DimensiMaping::findOrFail($delId)->delete();
        }
        return ['msg'=>'Data succesfully deleted','data'=>[]];
    }

    public function edit(Request $request,$id){
        $maping     =DimensiMaping::where('id','=',$id);
        $dimensiAll = Dimensi::get();
        $data= $maping->get();

        foreach($data as $key=>$row){
            foreach($dimensiAll as $kd=>$rowkd){
                if($row->dimensiAid==$rowkd->id){
                    $data[$key]->dimensiA = $rowkd->description;
                    $data[$key]->dimensiACode = $rowkd->code;
                }
                
                if($row->dimensiBid==$rowkd->id){
                    $data[$key]->dimensiB = $rowkd->description;
                    $data[$key]->dimensiBCode = $rowkd->code;
                }
            }
        }

        return ['msg'=>'','data'=>$data];
    }
}
