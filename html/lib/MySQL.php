<?php

import('Configer');

class MySQL
{
    private $mysqli;
    /**
     * @var mysqli die MySQLi-Intstanc
     */
    public static $MYSQL;
    private static $instance;
    public static $connectErrno;
    public static $connectError;

    public function __construct()
    {
/*        $this->mysqli = new mysqli("localhost",
                Configer::getProperty("mysql.user"),
                Configer::getProperty("mysql.password"),
                Configer::getProperty("mysql.database"));*/

        $mysqli = @new mysqli("localhost",
                Configer::getProperty("mysql.username"),
                Configer::getProperty("mysql.password"),
                Configer::getProperty("mysql.database"));

        self::$connectErrno = mysqli_connect_errno();
        self::$connectError = mysqli_connect_error();

/*        self::$connectErrno = $this->mysqli->connect_errno;
        self::$connectError = $this->mysqli->connect_error;

        $this->mysqli->set_charset("utf8");
        $this->mysqli->query('set character set utf8;');
        $this->mysqli->query('SET NAMES \'utf8\';');
*/


        if(!self::$connectErrno)
            $mysqli->set_charset("utf8");
        
        else
        {
            $mysqli = null;
        }

        self::$MYSQL = $mysqli;
        $this->mysqli = $mysqli;
//        self::$MYSQL->query('set character set utf8;');
//        $this->mysqli->query('SET NAMES \'utf8\';');
//        $this->mysqli->query('SET NAMES \'utf8\'');
        #self::$instance = $this;
    }

    public static function escape($str)
    {
        return self::$MYSQL->real_escape_string($str);
    }

    public function __destruct()
    {
        if(!self::$connectErrno)
            $this->mysqli->close();
    }

    public function prepare($query)
    {
        return $this->mysqli->prepare($query);
    }

    public function ownsRight()
    {

    }

    public static function getField($table, $name, $cond, $mysqli)
    {
        $x = self::getRow("SELECT $name FROM $table WHERE $cond", $mysqli);
        
        if($x == null)
            return null;

        else
            return $x[$name];
    }

    public function init()
    {
        if(self::$instance == null)
            self::$instance = new MySQL ();
    }

    /*public function assocSelect($tablename, $colnames, $check, $value, $single=false)
    {
        $sql = "SELECT ";

        for($i=0;$i<count($colnames);++$i)
        {
            $sql.=$colnames[$i];

            if($i+1!=count($colnames))
                $sql.=',';
        }

        $sql.=" FROM $tablename WHERE $check='".$this->mysqli->real_escape_string($value)."'";

        if($single)
        {
            $RS = $this->mysqli->query($sql);

            if($RS === false)
                return false;

            $row = $this->mysqli->
        }
    }*/

    /**
     *
     * @param string $sql
     * @param mysqli $mysqli
     */
    public static function exists($sql, $mysqli = null)
    {
        self::check($mysqli);

        $result = $mysqli->query('SELECT EXISTS('.$sql.') AS ex');

        if(!$result)
            MySQL::logError($mysqli, 'SELECT EXISTS('.$sql.') AS ex');

        $arr = $result->fetch_array();

        if($arr === false)
            self::logError($mysqli);

        $result->close();
        return $arr[0];
    }

    public static function getRow($sql, $mysqli=null)
    {
        return self::queryAndFetchAssoc($sql, false, $mysqli);
    }

    public static function getRows($sql, $mysqli=null)
    {
        return self::queryAndFetchAssoc($sql, true, $mysqli);
    }

    private static function check(&$mysqli)
    {
        if($mysqli == null)
            $mysqli = self::$MYSQL;

        if($mysqli == null)
            throw new Exception ("Not connected", self::$connectErrno ? self::$connectErrno : mysqli_connect_errno());
    }
    
    public static function logError($mysqli, $sql = null)
    {
        import('Log', 'core');
        Log::write(Log::ERROR, 'MySQL-Error('.$mysqli->errno.'): '.$mysqli->error.($sql ? ' SQL='.$sql : ''));
#        throw new InvalidArgumentException();
    }

    private static function queryAndFetchAssoc($sql, $mutli=false, $mysqli=null)
    {
        self::check($mysqli);

        $RS = self::$MYSQL->query($sql);

        if(is_bool($RS))
            if($mysqli->errno)throw new Exception($mysqli->error);
            else return $RS;

        if($mutli)
        {
            $arr = array();

            while($a = $RS->fetch_assoc())
                $arr[] = $a;
        }

        else{
            $arr = $RS->fetch_assoc();
            if($arr === false) $arr = null;
        }

        $RS->free_result();

        return $arr;
    }
}

MySQL::init();

?>
