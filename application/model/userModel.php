<?php

class userModel extends Database
{
    public static function insertData($table, $data)
    {
        foreach ($data as $key => $value)
        {
            $value = "'$value'";
            $arrayValue[] = $value;
            $arrayKey[] = $key;
        }

        $dataValues = implode(",", $arrayValue);
        $dataColumns = implode(",", $arrayKey);

        if (self::Query("INSERT INTO " . "$table ($dataColumns) values($dataValues)"))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function fetchNrData($tableName)
    {
        return self::countData($tableName);
    }

    public static function fetchAllData($tableName, $filter = array(), $params = array())
    {
        if(!empty($filter) && !isset($params['join']))
        {
            foreach ($filter as $columns => $value)
            {
                if($columns=='IN')
                {
                    foreach ($value as $variable =>$keys)
                    {
                        foreach ($keys as $key )
                        {
                            $variableToput[]=$key;
                        }
                        $querySqlVariable = implode(",",  $variableToput);
                        unset($variableToput);
                        $queryArray[]="$variable IN ($querySqlVariable)";
                    }

                }
                else
                {
                    $queryArray[] = "$columns='$value'";
                }
            }

            $querySql = implode(" AND ", $queryArray);

            self::Query("SELECT * FROM " . "$tableName " . "WHERE " . "$querySql");

            if(isset($params['fetch']))
            {
                switch($params['fetch'])
                {
                    case 'array':
                        $data = json_decode(json_encode(self::fetchData()),true);
                        return $data;

                        break;

                    case 'value':
                        $datas = json_decode(json_encode(self::singleData()),true);
                        return $datas;

                        break;
                }
            }
            
            $data = json_decode(json_encode(self::fetchData()),true);
            return $data;
        }

        if(isset($params['join']))
        {
            $querySqlJoin = array();
            for ($i = 0; $i < count($params['join']); $i++)
            {
                $querySqlJoin[] = "INNER JOIN " . $params['join'][$i]['table'] . " ON $tableName.". $params['join'][$i]['key']. " = ".$params['join'][$i]['table'].".".$params['join'][$i]['foreignKey'];
            }

            $joinSql = implode(" ", $querySqlJoin);
            self::Query("SELECT * FROM $tableName $joinSql");

            $data = json_decode(json_encode(self::fetchData()),true);
            return $data;
        }

        else if(empty($filter) && empty($params))
        {
            if (self::Query("SELECT * FROM " . "$tableName "))
            {
                return self::fetchData();
            }
        }
    }

    public static function deleteData($tableName, $filter= array())
    {
        if(!empty($filter))
        {
            foreach ($filter as $columns => $value)
            {
                $queryArray[] = "$columns='$value'";
            }

            $querySql = implode(",", $queryArray);

            if(self::Query("DELETE FROM $tableName WHERE $querySql"))
            {
                echo "Data u hoq";
            }
        }
    }

    public static function updateData($tableName, $filter= array(), $updateValues)
    {
        if(!empty($filter) && !empty($updateValues))
        {
            foreach ($filter as $columns => $value)
            {
                $queryArray[] = "$columns='$value'";
            }

            $querySql = implode(" AND ", $queryArray);

            foreach ($updateValues as $columns => $value)
            {
                $queryArrayUpdateValues[] = "$columns='$value'";
            }

            $querySqlUpdateValues = implode(",", $queryArrayUpdateValues);



            if(self::Query("UPDATE $tableName SET $querySqlUpdateValues WHERE $querySql"))
            {
                return true;
            }
        }
        else
        {
            return false;
        }
    }

    public static function fetchSession()
    {
        return self::getSession('name');
    }
}
?>