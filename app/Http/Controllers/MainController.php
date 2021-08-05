<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;

class MainController extends Controller
{
    public function passwordCrack(Request $request)
    {
        $highest_value = $request->high;
        $lowest_value = $request->low;
        $valid_password = [];
        $invalid_password = [];
        $password = $lowest_value;
        while ($password <= $highest_value) {
            if (
                $this->checkLength($password)
                && $this->checkRange($password, $lowest_value, $highest_value)
                && $this->checkSameCharacter($password)
                && $this->checkNumberIncrease($password)
            ) {
                $valid_password[] = $password;
            } else {
                $invalid_password[] = $password;
            }

            $password = (string) ($password + 1);
        }

        return count($valid_password);
    }

    public function checkLength($password)
    {
        if(strlen($password) != 6){
            return false;
        }
        return true;
    }

    public function checkRange($password, $lowest_value, $highest_value)
    {
        if($password <= $lowest_value && $password >= $highest_value){
            return false;
        }
        return true;
    }

    public function checkSameCharacter($password)
    {
        if(preg_match('/([0-9])\\1/', $password) !== 1){
            return false;
        }
        return true;
    }

    public function checkNumberIncrease($password)
    {
        $p = (string) $password;
        for($i = 1; $i < strlen(($p)); $i++){
            if($p[$i] < $p[$i - 1]){
                return false;
            }
        }
        return true;
    }
}
