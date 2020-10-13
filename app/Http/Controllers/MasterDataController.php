<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterDataController extends Controller
{
    public function job() {
        $jobs = config('masterdata.job');
        $allJobs = array();
        $index = 0;
        foreach($jobs as $key=>$job) {
            if(!in_array($job[1],$allJobs)) {
                $allJobs[$index++] = $job[1]; 
            }
            if(!in_array($job[0],$allJobs)) {
                $allJobs[$index++] = $job[0]; 
            }
        }
        return response()->json($allJobs);
    }
}
