<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Dimensi;

class DimensiController extends Controller
{
    private $op=['eq'=>'=','neq'=>'!=','startswith'=>'like','contains'=>'like'];

    public function index(Request $request){
        $dimensi=Dimensi::selectRaw('*');
        
        if(isset($request->filter)){
            foreach($request->filter as $row){
                $operator = $this->op[$row['operator']];
                switch ($row['operator']) {
                    case 'contains':
                        $dimensi->where($row['field'],$operator,'%'.$row['value'].'%');
                        break;
                    
                    case 'startswith':
                        $dimensi->where($row['field'],$operator,$row['value'].'%');
                        break;
                    
                    default:
                        $dimensi->where($row['field'],$operator,$row['value']);
                        break;
                }
            }
        }

        $data= $dimensi->get();
        
        if(isset($request->callback))
            return $request->callback.'('. json_encode(['result'=>$data]).')';
        else
            return $data;
    }

    public function store(Request $request){
        $request->validate([
            'code' => 'required|unique:dimensi|max:1',
            'description' => 'required',
        ]);
        
        $dimensi = new Dimensi($request->all());
        $res = $dimensi->save();

        if($res)
            return ['msg'=>"Data ".$request->description." Berhasil disimpan"];
        else
            return ['msg'=>"Data Gagal Disimpan"];
    }

    public function destroy(Request $request, $id){
        $delId = $request->delid;
        if(is_array($delId)){
            Dimensi::destroy($delId);
        }else{
            Dimensi::findOrFail($delId)->delete();
        }
        return ['msg'=>'Data succesfully deleted','data'=>[]];
    }

    public function edit(Request $request, $id){
        $dimensi = Dimensi::find($id);
        return ['msg'=>'','data'=>$dimensi];
    }

    public function update(Request $request, $id){
        $dimensi = Dimensi::where('id',$id)
            ->update($request->all());

        if($dimensi)
            return ['data'=>[],'msg'=>'data successfully updated'];
        else
            return ['data'=>[],'msg'=>'Nodata updated'];
    }
}
