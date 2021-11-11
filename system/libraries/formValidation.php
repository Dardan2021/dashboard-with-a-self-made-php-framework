<?php

trait formValidation
{
  public static $error = array();

  public static function validation($value, $label, $rules)
  {
      if (is_array($value))
      {
          $data = $value;
      }
     else if (!empty($value))
     {
         $data = trim($value);
     }



     $pattren = "/^[a-zA-Z]+$/";
     $intPattren = "/^[0-9]+$/";
     $rules = explode("|", $rules);

     if (in_array("required", $rules))
     {
          if (empty($data))
          {
              return self::$error[$label] = $label . " is required";
          }
      }

      if (in_array("int", $rules))
      {
          if (!preg_match($intPattren, $data))
          {
              return self::$error[$label] = $label . " must have only int numbers";
          }
      }

      if (in_array("not_int", $rules))
      {
          if (!preg_match($pattren, $data))
          {
              return self::$error[$label] = $label . " must have only alphabet";
          }
      }

      if (in_array("min", $rules))
      {
          $maxLenIndex = array_search("min", $rules);
          $maxLenValue = $maxLenIndex + 1;
          $maxLenValue = $rules[$maxLenValue];

          if (strlen($data) < $maxLenValue)
          {
              return self::$error[$label] = $label . " must have more than 4 letters";
          }
      }

      else if (in_array("max", $rules))
      {
          $maxLenIndex = array_search("max", $rules);
          $maxLenValue = $maxLenIndex + 1;
          $maxLenValue = $rules[$maxLenValue];

          if (strlen($data) > $maxLenValue)
          {
              return self::$error[$label] = $label . " must have less than 10 letters";
          }
      }

      else if (in_array("confirm", $rules))
      {
          $confirmIndex = array_search("confirm", $rules);
          $passwordValue = $confirmIndex + 1;
          $passwordValue = $rules[$passwordValue];

          if ($_SERVER['REQUEST_METHOD'] == 'post' || $_SERVER['REQUEST_METHOD'] == 'POST')
          {
              $password = trim($_POST[$passwordValue]);
          }

          if ($password != $data)
          {
              return self::$error[$label] = $label . " password must be the same";
          }
      }

      else if (in_array("unique", $rules))
      {
          $uniqueIndex = array_search("unique", $rules);
          $tableIndex = $uniqueIndex + 1;
          $tableName = $rules[$tableIndex];

          if (isset($data))
          {
              if (database::countData($tableName, array('email' => $data)) > 0)
              {
                  return self::$error[$label] = " this email already exists";
              }
          }
      }

      else if (in_array("authentication", $rules))
      {
          $uniqueIndex = array_search("authentication", $rules);
          $tableIndex = $uniqueIndex + 1;
          $tableName = $rules[$tableIndex];

          if (isset($data))
          {
              if (database::countData($tableName, array('email' => $data['email'],"password"=>$data['password'])) == 0)
              {
                  return self::$error[$label] = " this email and pasword do not exists";
              }
          }
      }
  }

  public static function run()
  {
      if(empty(self::$error))
      {
          return true;
      }
      else
      {
          return false;
      }
  }

  public static function setValue($fieldName)
  {
      if ($_SERVER['REQUEST_METHOD'] == 'post' || $_SERVER['REQUEST_METHOD'] == 'POST')
      {
          return $_POST[$fieldName];
      }
  }

  public static function hash($password)
  {
      if(!empty($password))
      {
          return password_hash($password, PASSWORD_DEFAULT);
      }
  }
}

?>