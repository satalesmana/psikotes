<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Dimensi;
use App\Model\MbtiSoal;
use Illuminate\Http\Request;

class MbtiController extends Controller
{
    private $op=['eq'=>'=','neq'=>'!=','startswith'=>'like','contains'=>'like'];

    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }
    
    public function index(Request $request){
        $soal=MbtiSoal::selectRaw('*');
        
        if(isset($request->filter)){
            foreach($request->filter as $row){
                $operator = $this->op[$row['operator']];
                switch ($row['operator']) {
                    case 'contains':
                        $soal->where($row['field'],$operator,'%'.$row['value'].'%');
                        break;
                    
                    case 'startswith':
                        $soal->where($row['field'],$operator,$row['value'].'%');
                        break;
                    
                    default:
                        $soal->where($row['field'],$operator,$row['value']);
                        break;
                }
            }
        }

        $data= $soal->get();

        $dimensiAll = Dimensi::get();
        foreach($data as $key=>$row){
            foreach($dimensiAll as $kd=>$rowkd){
                if($row->dimensiA==$rowkd->id){
                    $data[$key]->dimensiACode = $rowkd->code;
                }
                
                if($row->dimensiB==$rowkd->id){
                    $data[$key]->dimensiBCode = $rowkd->code;
                }
            }
        }
        
        if(isset($request->callback))
            return $request->callback.'('. json_encode(['result'=>$data]).')';
        else
            return $data;
    }

    public function store(Request $request){
        
        $request->validate([
            'dimensiACode' => 'required',
            'dimensiBCode' => 'required',
            'pernyataanA' => 'required',
            'pernyataanB' => 'required',
        ]);

        $soal = new MbtiSoal([
            'dimensiA'=>$request->dimensiA,
            'pernyataanA'=>$request->pernyataanA,
            'dimensiB'=>$request->dimensiB,
            'pernyataanB'=>$request->pernyataanB,
            'groupdimensi'=>$request->groupdimensi
        ]);
        $res = $soal->save();
        
        if($res)
            return ['msg'=>"Data ".$request->label." Berhasil disimpan"];
        else
            return ['msg'=>"Data Gagal Disimpan"];
    }

    public function destroy(Request $request, $id){
        $delId = $request->delid;
        if(is_array($delId)){
            MbtiSoal::destroy($delId);
        }else{
            MbtiSoal::findOrFail($delId)->delete();
        }
        return ['msg'=>'Data succesfully deleted','data'=>[]];
    }

    public function edit($id){
        $soal = MbtiSoal::selectRaw('mbti_soal.*,dimensi_maping.id as groupdimensi,dimensi_maping.label')
        ->join('dimensi_maping','dimensi_maping.id','=','mbti_soal.groupdimensi')
        ->where('mbti_soal.id','=',$id);

        $data= $soal->get();

        $dimensiAll = Dimensi::get();
        foreach($data as $key=>$row){
            foreach($dimensiAll as $kd=>$rowkd){
                if($row->dimensiA==$rowkd->id){
                    $data[$key]->dimensiACode = $rowkd->code;
                    $data[$key]->dimensiAdesc = $rowkd->description;
                }
                
                if($row->dimensiB==$rowkd->id){
                    $data[$key]->dimensiBCode = $rowkd->code;
                    $data[$key]->dimensiBdesc = $rowkd->description;
                }
            }
        }
        return ['msg'=>'','data'=>$data];
    }

    public function update(Request $request, $id){
        $request->validate([
            'dimensiACode' => 'required',
            'dimensiBCode' => 'required',
            'pernyataanA' => 'required',
            'pernyataanB' => 'required',
        ]);

        $soal = MbtiSoal::where('id',$id)
            ->update([
                'dimensiA'=>$request->dimensiA,
                'pernyataanA'=>$request->pernyataanA,
                'dimensiB'=>$request->dimensiB,
                'pernyataanB'=>$request->pernyataanB,
                'groupdimensi'=>$request->groupdimensi
            ]);

        if($soal)
            return ['data'=>[],'msg'=>'data successfully updated'];
        else
            return ['data'=>[],'msg'=>'Nodata updated'];
    }
}
