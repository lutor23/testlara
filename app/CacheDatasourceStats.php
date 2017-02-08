<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CacheDatasourceStats extends Model
{
     
     /**
     * Enable soft delete in the model
     */
    use SoftDeletes;

    protected $dates = ['deleted_at'];

     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cache_datasource_stats';

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
    protected $fillable = ['output', 'datasource_id'];

   
    /**
     * returns the datasource record associated with this cache
     * @return App\Datasource
     */
    public function datasource()
	{
		return $this->belongsTo('App\Datasource');
	}


    /**
     * returns array of the dot notation of a JSON output
     * @return array 
     */
    public function getDatasourceDotAttribute() {
        $jsonArray=json_decode($this->output, true);
        createDotArray($jsonArray,'',$ret);
        return $ret;
    }


    public function getDotValue($dotfield) 
    {
        // $dotfield='ASG.phone_number';
        $arrayCollect=json_decode($this->output, true);    
        return getDotValueP($arrayCollect, $dotfield);
    }


} //end of class


 /**
 * creates a flat named array of each element of an array in dot format
 */
 function createDotArray($array, $father='', &$return) {

    foreach ($array as $key=>$value) {
        $fullpath=(strlen($father)?$father.".".$key:$key);

        if (is_array($value)) {
            createDotArray($value, $fullpath, $return);
        } else {
            $return[$fullpath]=$fullpath;
        }
    }
}

/**
 * gets the value of the item (dot separated format i.e 'ASG.id') from the array.  $array['ASG']['id']
 */
function  getDotValueP($array, $item) {

    $breakDetail=explode('.',$item);
    $x=$array;
    foreach($breakDetail as $sublevel) { 
        if (array_key_exists($sublevel, $x)) {
            $x=$x[$sublevel];   
        } else {
            return 'N/A';
        }
    } //foreach
    return $x;
}

