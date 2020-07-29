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
}

?>