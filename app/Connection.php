<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

use DB;
use Config;

class Connection extends Model
{
    
    /**
     * Enable soft delete in the model
     */
    use SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['datasource'];

    protected $dates = ['deleted_at'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'connections';

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
    protected $fillable = ['name', 'dbtype', 'host', 'username', 'password','dbname'];

    /**
     * Gets the datasource for this connection
     */
    public function datasource() { 
        return $this->HasMany('App\Datasource');
    }

    /**
    * get user for this connection
    */
    public function User()
    {
      return $this->belongsTo('App\User');
    }


    /**
     * Run the passed query on the database and returns result in json format
     */
    public function runquery(string $query) { 

        // Check if SELECT is in the query
        if (preg_match('/SELECT/', strtoupper($query)) != 0) {
            // Array with forbidden query parts
            $disAllow = array(  'INSERT','UPDATE','DELETE','RENAME','DROP','CREATE','TRUNCATE','ALTER',
                                'COMMIT','ROLLBACK','MERGE','CALL','EXPLAIN','LOCK','GRANT','REVOKE',
                                'SAVEPOINT','TRANSACTION','SET');

            $disAllow = array( 'UPDATE ','DELETE ', 'DROP ', 'TRUNCATE ', 'RENAME ');

            $disAllow = implode('|', $disAllow);

            // Check if no other harmfull statements exist
            if (preg_match('/('.$disAllow.')/', strtoupper($query)) == 0) {

              $conn=array(
                    'driver'    => $this->dbtype,
                    'host'      => $this->host,
                    'database'  => $this->dbname,
                    'username'  => $this->username,
                    'password'  => decrypt($this->password),
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => ''
                );           

                if ($this->dbtype=='oracle') {
                    $conn['database']='';
                    $conn['service_name']=$this->dbname;
                }

                Config::set('database.connections.'.$this->name, $conn);
            
                $DB=\DB::connection($this->name);

                //Connection
                try {
                    \DB::connection($this->name)->getPdo();
                } 
                catch(\PDOException $e) { 
                    return $e->getMessage();
                }
                
                //Query 
                try {
                    $ret=$DB->select($query);
                }
                catch(\PDOException $err) {
                    return $err->getMessage();   
                }
         
                return collect($ret)->toJson();

            } else {
                return 'Error: only SELECT queries area allowed. INVALID keyword included.';
            } 

        }  else {
            return 'Error: only SELECT queries area allowed.';
        }      
  
    }

} //class
