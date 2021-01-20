<?php
class JSONConverter{
    
    function jsonEncode($result){
        $outp = array();
        if(null!=$result){
            while ($row = mysql_fetch_array($result))
            {
                $outp[]=$row;
            }
        }
        return json_encode($outp);
    }
    
    function jsonDecode($jsonObject){
        if(null!=$jsonObject){
            return json_decode($jsonObject,true);
        }
        return $jsonObject;
    }
}

?>