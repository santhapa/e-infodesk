<?php 
   class Form
   {
      var $values = array();  //Holds submitted form field values
      var $errors = array();  //Holds submitted form error messages
      var $success = array(); //Holds success messages
      var $num_errors;        //The number of errors in submitted form
      var $num_success;       //holds number of success
      var $num_values;

      function Form()
      {
         if(isset($_SESSION['value_array']) && isset($_SESSION['error_array']))
         {
            $this->values = $_SESSION['value_array'];
            $this->errors = $_SESSION['error_array'];
            $this->num_errors = count($this->errors);
           

            unset($_SESSION['value_array']);
            unset($_SESSION['error_array']);
         }
         
         else
         {
            $this->num_errors = 0;
         }

         if(isset($_SESSION['value_array']))
         {
            $this->values = $_SESSION['value_array'];
            $this->num_values= count($this->values);

            unset($_SESSION['value_array']);
         }
         
         if (isset($_SESSION['success_array']))
         {
            $this->success=$_SESSION['success_array'];
            $this->num_success = count($this->success);

            unset($_SESSION['success_array']);
         }
      }

      function setError($error_type, $errmsg)
      {
         $this->errors[$error_type] = $errmsg;
         $this->num_errors = count($this->errors);
      }

      function setSuccessMsg($success_type, $succmsg)
      {
         $this->success[$success_type] = $succmsg;
      }

      function value($field)
      {
         if(array_key_exists($field,$this->values))
         {
            return ($this->values[$field]);
         }
         else
         {
            return "";
         }
      }

      function error($error_type)
      {
         if(array_key_exists($error_type,$this->errors))
         {
            return $this->errors[$error_type];
         }

         else
         {
            return "";
         }
      }

      function success($success_type)
      {
         if(array_key_exists($success_type,$this->success))
         {
            return $this->success[$success_type];
         }

         else
         {
            return "";
         }
      }      

      function getErrorArray()
      {
         return $this->errors;
      }

      function getSuccessArray()
      {
         return $this->success;
      }
   };


   $formObj= new Form;
 
?>
