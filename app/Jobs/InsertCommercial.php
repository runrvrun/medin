<?php

namespace App\Jobs;

use App\Commercial;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class InsertCommercial implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    var $upload_path,$upload_filename = '';
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($upload_path,$upload_filename)
    {
        $this->upload_path = $upload_path;
        $this->upload_filename = $upload_filename;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // import to database
        $imp = (new FastExcel)->configureCsv(';', '}', '\n', 'gbk')->import($this->upload_path.'/'.$this->upload_filename, function ($line) {
            $insertData = [];
            foreach($line as $key=>$val){
                $colname = strtolower($key);
                $colname = str_replace(' ','_',$colname);
                $colname = str_replace('.','',$colname);
                switch($colname){
                    case 'date':
                        // $date = Carbon::createFromFormat('d/m/Y H:i:s',$val.' 00:00:00')->toDateTimeString();
                        $date = Carbon::createFromFormat('Y-m-d H:i:s',$val.' 00:00:00')->toDateTimeString();
                        $insertData[$colname] = str_replace('�',' ',$val);
                        $insertData['isodate'] = new \MongoDB\BSON\UTCDateTime(new \DateTime($date));
                        break;
                    case 'start_time':
                        $timestamp = Carbon::createFromFormat('Y-m-d H:i:s','1970-01-01'.$val)->timestamp;
                        $insertData[$colname] = str_replace('�',' ',$val);
                        $insertData['start_timestamp'] = $timestamp;
                        break;
                    case 'count':
                        $insertData[$colname] = str_replace('�',' ',$val);
                        break;
                    default:
                        $insertData[$colname] = str_replace('�',' ',$val);
                }
            }
            return Commercial::create($insertData);
        });

        $data['rowCount'] = $imp->count();
        
        unlink($upload_path.'/'.$upload_filename);
    }
}
