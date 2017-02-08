<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\CacheDatasourceStats;
use DB;
use App\Widget;
use App\Datasource;

class CacheDatasourceStatsController extends Controller
{
	
	/**
	* Expands json output and runs aggregation on last collect.
	*/
	public function showagg(Request $request) 
	{ 
		$req=$request->all();
		$datasource_id=$req['datasource_id'];
		$field=$req['groupby_field'];
		$operator=$req['groupby_operator'];
		$sumfield=$req['groupby_sumfield'];

		if ($operator=='sum') { 
			$sum_extract_field=",json_extract_path_text(elements, '$sumfield') as sumfield ";
			$count="sum(sumfield::integer)";
			$tag="($sumfield)";
		}
		elseif ($operator=='avg') { 
			$sum_extract_field=",json_extract_path_text(elements, '$sumfield') as sumfield ";
			$count="round(avg(sumfield::integer),2)";
			$tag="($sumfield)";
		} else {
			$sum_extract_field='';
			$count="count(*)";
			$tag='';
		}

		$query="
		select field, $count as fieldvalue from 
			( 	select 	json_extract_path_text(elements, '$field') as field  $sum_extract_field
						from  
						(	
							select json_array_elements(output) as elements 	from 
								( 	select output from cache_datasource_stats 
									where datasource_id = $datasource_id 
									order by created_at desc limit 1
								) as q0
						) as q1
			) as q2 
		group by field order by $count desc";

        $ret=DB::select($query);

        $return='';
        foreach ($ret as $item) { 
        	$return.="<li><a href='#'>".(is_null($item['field'])?'count':$item['field'])."<span class='pull-right badge bg-blue'>".$item['fieldvalue']."</span></a></li>";
        }
		return $return;
	}


	/**
	 * Returns the numeric fields from the passed datasource_id
	 * @param  datasource_id , request
	 * @return string     option list to be added to option list or JSON format if 
	 * passed in the GET request
	 * 
	 */
	public function showsumfield($id, Request $request) 
	{ 
		$req=$request->all();

		if ( isset($req['format']) ) {
			//this is supposed to be json :(
			return collect(DatasourceNumericFieldnames($id))->toJson();
		}
		else {
			return array_to_options( DatasourceNumericFieldnames($id) );
		}
		 	
	}


    /**
     * Gets the available options using the datasource to fill the select options
     * @param  id datasourceid 
     * @return string <option> list           
     */
    public function getFieldNames($id, Request $request) 
    { 
    	$req=$request->all();

    	if ($req['widgettype']=='infobox' || $req['widgettype']=='infobox_moreinfo')
    	{
    		//Gets fieldname in dotted format, on each element
			$output=Datasource::find($id)->last_collect;

			if ($output) { 
				$jsonArray=json_decode($output, true);
				return  getchildren($jsonArray);
			} else {
				return ['error'=>'Nothing found'];      	
			}    		

    	} else {
    		//Gets fieldname from first element.
			return array_to_options( DatasourceFieldnames($id) );
    	}

    }


	/**
	* Outputs the option values for the respective (last) datasource_id
	*/
	public function show($id, Request $request) 
	{ 
		//DELETE - REFACTOR.
		//this is not used anymore-
		$req=$request->all();

		$latest=$this->getLastCollect($id);

		if ($latest['output']) { 
			$jsonArray=json_decode($latest['output'], true);
			return  getchildren($jsonArray);
		} else {
			return ['error'=>'Nothing found'];      	
		}
	}


	/**
	* Outputs the option values for the respective (last) datasource_id
	*/
	public function showraw($id) 
	{ 

		$latest=$this->getLastCollect($id);

		if ($latest['output']) { 
			return $latest['output'];
		} else {
			return ['error'=>'Nothing found'];      	
		}
	}


	/**
	 * Gets the value of a JSON field, using header dotted format.
	 * given id of datasource 
	 */
	public function getJsonField($id, $header) { 

		$row=$this->getLastCollect($id);
		$json=$row['output'];
		$array_lastCollect = json_decode($json,true);
			
		return getJsonValue($array_lastCollect, $header);
	}


	/**
	* Outputs the option values for the respective (last) datasource_id
	*/
	public function showlast($id) 
	{ 

		$latest=$this->getLastCollect($id);

		if ($latest['created_at']) { 
			return $latest['created_at'];
		} else {
			return ['error'=>'Nothing found'];      	
		}

	}


	/**
	 * Gets the array record of the last collect for given datasource_id
	 */
	public function getLastCollect($id) 
	{ 

		//REFACTOR--delete 
		$latest=CacheDatasourceStats::where('datasource_id', $id)->orderby('created_at', 'desc')->first()->toArray();
		return $latest;
	}


} 
//end of class


/********************* Helper functions *********************/


	/**
	 * returns all path from JSON as <option> for a select box
	 */
	 function getchildren($array, $father='') 
	 {

		foreach ($array as $key=>$value) {
			$fullpath=(strlen($father)?$father.".".$key:$key);

			if (is_array($value)) {
				getchildren($value, $fullpath);
			} else {
				print "<option value='$fullpath'>$fullpath</option>\n";
			}
		}
	}


	/**
	 * returns json value from the array item.
	 */
	function  getJsonValue($array, $item) {

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