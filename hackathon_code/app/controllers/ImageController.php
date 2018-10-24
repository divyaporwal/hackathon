<?php

use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;



class ImageController extends Controller
{
    protected function listToReviewImage() {
        $allissues = DB::table('image_raw as ir')->select('*')
                     ->where('image_status','=','unprocessed');
       
        $allissues = $allissues
            ->paginate(20);
       
        return View::make('user_dashboard', array('allissues' => $allissues, 'status' => 'review'))->render();

    }
    
    protected function listProcessedImage() {
        $allissues = DB::table('image_processed as ip')->select('*')
                     ->leftjoin('image_raw as ir', 'ir.image_id', '=', 'ip.image_raw_id')
                     ->leftjoin('worker as w', 'w.worker_id','=','ip.assigned_to')
                     ->leftjoin('validator as v', 'v.validator_id','=','ir.validated_by')
                     ->where('image_status','=','valid');

        $allissues = $allissues
            ->paginate(20);
       
        return View::make('user_dashboard', array('allissues' => $allissues, 'status' => 'processed'))->render();

    }
    
    protected function listResolvedIssues() {
        $allissues = DB::table('image_processed as ip')->select('*')
                     ->leftjoin('image_raw as ir', 'ir.image_id', '=', 'ip.image_raw_id')
                     ->leftjoin('worker as w', 'w.worker_id','=','ip.assigned_to')
                     ->leftjoin('validator as v', 'v.validator_id','=','ir.validated_by')
                     ->where('status','=','resolved');
        $allissues = $allissues
            ->paginate(20);
       
        return View::make('user_dashboard', array('allissues' => $allissues, 'status' => 'resolved'))->render();

    }
    
    protected function listUnresolvedIssues() {
      
        $allissues = DB::table('image_processed as ip')->select('*')
                     ->leftjoin('image_raw as ir', 'ir.image_id', '=', 'ip.image_raw_id')
                     ->leftjoin('worker as w', 'w.worker_id','=','ip.assigned_to')
                     ->leftjoin('validator as v', 'v.validator_id','=','ir.validated_by')
                     ->where('status','=','unresolved');
        $allissues = $allissues
            ->paginate(20);
       
        return View::make('user_dashboard', array('allissues' => $allissues, 'status' => 'unresolved'))->render();

    }
    
    protected function viewDetail($issue_id) {
        $issue_detail = DB::table('image_processed as ip')->select('*')
                        ->leftjoin('image_raw as ir', 'ir.image_id', '=', 'ip.image_raw_id')
                        ->leftjoin('worker as w', 'w.worker_id','=','ip.assigned_to')
                        ->leftjoin('validator as v', 'v.validator_id','=','ir.validated_by')
                        ->where('image_processed_id','=',$issue_id)->first();
        $workers = DB::table('worker')->select('worker_id','name')->get();
       
       return View::make('view_issue_detail',array('issue_detail' => $issue_detail,'workers'=>$workers));
    }
    
    protected function viewReviewDetail($issue_id) {
        $issue_detail = DB::table('image_raw as ir')->select('*')
                        ->where('image_id','=',$issue_id)->first();       
       return View::make('view_review_detail',array('issue_detail' => $issue_detail));
    }
    
    protected function addWorker() {
        if (Input::get('image_processed_id')) {
            $image_processed_id = Input::get('image_processed_id');
        }
        
        if (Input::get('assigned_to')) {
            $assigned_to = Input::get('assigned_to');
        }
        
        $update = DB::table('image_processed')->where('image_processed_id','=', $image_processed_id)
                ->update(
                        array(
                            'assigned_to' => $assigned_to,
                        )
                        );
        return $update;
    }
    
    protected function validateImage() {
        if (Input::get('image_id')) {
            $image_id = Input::get('image_id');
        }
        
        if (Input::get('validated_by')) {
            $validated_by = Input::get('validated_by');
        }
        
        if (Input::get('image_status')) {
            $image_status = Input::get('image_status');
        }
        DB::beginTransaction();
        $update = DB::table('image_raw')->where('image_id','=', $image_id)
                ->update(
                        array(
                            'validated_by' => $validated_by,
                            'validated_at' =>  DB::raw('now()'),
                            'image_status' => $image_status,
                        )
                        );
        try {
                $update2 = DB::table('image_processed')->insert(
                    array(
                        'status' => 'unresolved',
                        'assigned_to' => 0,
                        'image_raw_id' => $image_id,
                        'longitude' => 28.613939,
                        'latitude'  => 77.209023,
                        'date_submitted' => DB::raw('now()')
                        )                   
                );
        
                DB::commit();                       
        } catch (Exception $ex) {
                DB::rollBack();
        }
      
        
       
        return $update;
    }
    
    protected function resolveTask() {
        if (Input::get('image_processed_id')) {
            $image_processed_id = Input::get('image_processed_id');
        }
        
        
        $update = DB::table('image_processed')->where('image_processed_id','=', $image_processed_id)
                ->update(
                        array(
                            'status' => 'resolved',
                            'date_resolved' => DB::raw('now()')
                        )
                        );
        return $update;
    }
}

?>