<?php

// $error = array();




class Validation
{
    public function validate()
    {
      $price = "半角数字で入力してください";
      if (!preg_match("/^[0-9]+$/", $_POST['Price'])) {
          # 半角数字以外が含まれていた場合、false
          return $price;
      }
    }

}