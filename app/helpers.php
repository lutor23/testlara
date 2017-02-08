<?php

use App\Datasource;

    /**
     * Gets the available options using the datasource to fill the select options
     */
    function DatasourceFieldnames($id) 
    { 
		$output=Datasource::find($id)->last_collect;

		if ($output) { 
			$jsonArray=json_decode($output, true);     
			foreach($jsonArray as $element) {
				
				foreach($element as $item) { 
					if (is_array($item)) {
						return 0;
					}
				}
				return array_keys($element);
			}

		} else {
			return array("Error returning keys");
		}   

    }

    /**
     * Gets the available fieldnames that have numeric content
     */
    function DatasourceNumericFieldnames($id) 
    { 
		$output=Datasource::find($id)->last_collect;
		if ($output) 
		{ 
			$jsonArray=json_decode($output, true);
			$ret=array();

			// $first_elem=array_shift($jsonArray);
			foreach( $jsonArray[0] as $header=>$field) {
			// foreach( $first_elem as $header=>$field) {
				if (is_numeric($field)) 	$ret[]=$header;
			}
			if (count($ret)==0) $ret[]=array("Error: No numberic fields found");
		
			return $ret;
		} else {
			return array();
		}
    }

    /**
     * Generates the chart object using ConsoleTV libs
     * @param array $req properties needed to generate the chart 
     * @return Charts object
     */
    function ChartGenerate(array $req) 
    {
        $labels_array=$values_array=$multiArray=array();

        if ($req['datasource_id']!='' && $req['labels']!='' && $req['values']!='')  {
            $data=Datasource::find($req['datasource_id'])->last_collect;
            $Array=json_decode($data, true);
            foreach($Array as $row) { 
                if ($req['category']=='single') {
                    foreach($row as $header=>$value) 
                    { 
                        if ($header==$req['labels']) { 
                            $labels_array[]=$value;
                        }
                        else if ($header==$req['values']) {
                            $values_array[]=$value;
                        }
                    }
                }
                else if ($req['category']=='multirow' && $req['dataset']!='') { 
                    $multiArray[$row[$req['labels']]][$row[$req['dataset']]]=$row[$req['values']];
                }
                else if ($req['category']=='multicolumn') { 
                    $multiArray[$row[$req['labels']]][$row[$req['dataset']]]=$row[$req['values']];
                }                
            }
        }
        else {
            $labels_array=array('First', 'Second', 'Third');
            $values_array=array(20,10,15);
        }

        //default array
        if (count($multiArray)==0) {
            $multiArray['first']=array("series1"=>1, "series2"=>3, "series3"=>3);
            $multiArray['second']=array("series1"=>2, "series2"=>2, "series3"=>4);
            $multiArray['third']=array("series1"=>3, "series2"=>1, "series3"=>1);
        }

        $title=($req['title']==''?'Chart title':$req['title']);

        if ($req['category']=='single')
        {
            $chart = Charts::create($req['type'], $req['library'])
                ->title($title)
                ->labels($labels_array)
                ->values($values_array)
                ->dimensions($req['dimensionx'],$req['dimensiony'])
                ->responsive(false);            
        }
        else if ( $req['category']=='multiple')
        {
            $labels_array=array();
            foreach($multiArray as $itemLabel=>$item)  { 
                $labels_array[]=$itemLabel;
                foreach($item as $iName=>$iVal)  {
                    $multi[$iName][]=$iVal;
                }
            }

            $chart = Charts::multi($req['type'], $req['library'])
                ->title($title)
                ->responsive(false)
                ->dimensions($req['dimensionx'],$req['dimensiony'])
                ->labels($labels_array);

            foreach($multi as $seriesLabel=>$seriesValues)  
            { 
                $chart->dataset($seriesLabel, $seriesValues);
            }

        }
        else if ($req['category']=='realtime')
        {
            $chart = Charts::realtime(url('/json'), 3000, $req['type'], $req['library'])
                ->values([50,0,100])
                ->labels(['First', 'Second', 'Third'])
                ->responsive(false)
                ->height(300)
                ->width(0)
                ->title($title)
                ->valueName('value');
        }
        else {
        	return '';
        }

        return $chart->render();
    }


    /**
     * Gets the available chart options from the request
     * @param array $req elements matching criteria
     */
    function Chartoptions($req) 
    {

        if (isset($req['category'])) {

            if ( in_array($req['category'], ['multicolumn', 'multirow'])) {
                $req['category']='multiple';
            }

            if (isset($req['type'])) {
                //Gets the library 
                $result= DB::table('chartoptions')->select('library')->distinct()
                            ->where($req['category'],1)
                            ->where('charttype', $req['type'])
                            ->orderby('library')
                            ->pluck('library')->toarray();

            } else {
                //Gets the charttypes.
                $result= DB::table('chartoptions')->select('charttype')->distinct()
                            ->where($req['category'],1)
                            ->orderby('charttype')
                            ->pluck('charttype')->toarray();
            }

            return $result;
        }
    }


    /**
     * Converts the array into <option> item for a selectbox
     */
    function array_to_options($array) 
    {
    	$ret='';

		foreach($array as $key) { 
			$ret.= "<option value='$key'>$key</option>\n";
		}
		return $ret;	
    }

    /**
     * Creates an associate array with identical keys=> values to be used as List
     */
    function array_assoc($array) 
    {
    	if (is_array(($array)))
    	{
    		return array_combine($array, $array);
    	} else {
    		return $array;
    	}
    }

?>