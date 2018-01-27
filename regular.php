<?php

                
        class regular{
        var $text;
        var $reg;
        
        function __construct($str,$reg_exp){
            $this->text=$str;
            $this->reg=$reg_exp;
        }   
        
        function check(){
            $p=0;
        
        $array=array();
        for($i=1;$i<=18;$i=$i+1)
        {
            if(preg_match("/COURT NO. ".$i."/",$this->text,$matches,PREG_OFFSET_CAPTURE)){
                $array[$p++]=$matches[0][1];
            }
        }

        $result=array();

        for($i=0;$i<=15;$i=$i+1)
        {
            $p=0;
            if($i==15){
                $length=strlen($this->text)-$array[$i];
            }
            else
            {
                $length=$array[$i+1]-$array[$i];
            }
            $string=substr($this->text,$array[$i],$length);
            preg_match_all($this->reg,$string,$match);
            foreach($match[1] as $mat)
            {
                $result[$i][$p++]= $mat;
            }
        }

        return json_encode($result);
            
        
        }

    }
        
        $myfile = fopen("regex-bom.html","r") or die("Unable to open file!");
        $text = fread($myfile,filesize("regex-bom.html"));
        fclose($myfile);
        
        
        $reg_exp = "/\d+\.\s*([A-Z]+\/\d+\/20\d\d)/";

        $ob = new regular($text,$reg_exp);
        echo  $ob->check();

?>
    