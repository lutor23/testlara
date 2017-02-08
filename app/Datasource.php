<?php

namespace App;
use DB;
use Carbon;
use Carbon\CarbonInterval;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;


class Datasource extends Model
{

    /**
     * Enable soft delete in the model
     */
    use SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['widgets'];

    protected $dates = ['deleted_at'];
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'datasources';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'param', 'refresh', 'ds_type', 'connection_id', 'timeout', 'email'];

    /**
    * get the user who created this Datasource
    */
    public function User()
    {
      return $this->belongsTo('App\User');
    }



    /**
     * get the widgets linked to this datasource
     */     
    public function widgets() {

        return $this->hasMany('App\Widget');
    }

    /**
     * get the cache stats from the datasource
     */
    public function CacheDatasourceStats() {
        return $this->hasMany('App\CacheDatasourceStats');
    }

    /**
     * gets the connection of this datasource
     */
    public function connection() { 
        return $this->belongsTo('App\Connection');
    }


    /**
     * Gets the last sync entry in the cache table
     */
    public function getLastCollectAttribute() {
        if (count($this->CacheDatasourceStats)>0) { 
            return $this->CacheDatasourceStats->last()->output;
        } else {
            return '{"error":"empty"}';
        }
    }

    /**
     * Gets the date of the last sync entry in the cache table
     */
    public function getLastRefreshAttribute() {
        if (count($this->CacheDatasourceStats)>0) {             
            return $this->CacheDatasourceStats->last()->created_at->diffForHumans();
        } else {
            return 'not collected yet';
        }
    }


    /**
     * collects the info from the datasource into the cache table 
     */
    public function sync() { 

        if ($this->ds_type=='json') 
        { 

            $ch = curl_init($this->param);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_TIMEOUT,$this->timeout);
            $json = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            $error_msg=curl_error($ch);

            if ($httpcode!=200) { 
                $jsonerror="HTTP_code: $httpcode. Error: $error_msg.";
            }

            curl_close($ch); 
            
        } 
        else if ( $this->ds_type=='dbconnection' ) 
        { 
            $conn = Connection::findOrFail($this->connection_id);
            $json = $conn->runquery($this->param);
        }

        //clean up special characters in json
        $json=str_replace(array("\n","\r","\t","  "), "", $json);

        if (json_decode($json)) {
            return $json;
        } else {
            http_response_code(500);
            if ($this->ds_type=='json') { 
                if ($json=='[]') {
                    $jsonerror='Empty dataset []';
                }                
                return Response($jsonerror,500);
            } else {
                return Response($json,500);
            }
        }

    }

    /**
     * Runs the collect when the schedule is due.
     * @return boolean if the schedule runs it will add new entry in cache table 
     * if not will return false
     */
    public function syncschedule() {

        $timesql=DB::select('select now() as now');
        $now=$timesql[0]['now'];

        $last=$this->CacheDatasourceStats->last();
        $diff=round((strtotime($now)-strtotime($last->created_at))/60,2);

        if ($diff>=$this->refresh) { 
            $json=$this->sync();

            if (json_decode($json)) {
                $jsonresponse=$json;
            }
            else 
            {
                $jsonresponse[0]['message']='No records found or an error collecting with the datasource.';
                $jsonresponse=collect($jsonresponse)->toJson();
            }

            $cache=new CacheDatasourceStats(['output'=>$jsonresponse, 'datasource_id'=>$this->id]);
            $cache->save();
            return $jsonresponse;
        } else {
            return false;
        }
    }




    /**
     * Syncs up the datasource inmediately.
     * @return jsonresponse of the run
     * if not will return false
     */
    public function syncnow() {

        $json=$this->sync();

        if (json_decode($json)) {
            $jsonresponse=$json;
        }
        else 
        {
            $jsonresponse[0]['error']='There was an error collecting with the datasource.';
            $jsonresponse=collect($jsonresponse)->toJson();
        }

        $cache=new CacheDatasourceStats(['output'=>$jsonresponse, 'datasource_id'=>$this->id]);
        $cache->save();

        $del=  "DELETE FROM cache_datasource_stats 
        WHERE 
        DATASOURCE_ID=" . $this->id . " AND id NOT IN ( SELECT id FROM cache_datasource_stats  WHERE DATASOURCE_ID=" . $this->id . " ORDER BY id DESC LIMIT 50) x";
        //DB::select($del);


        return $jsonresponse;

    }


}
