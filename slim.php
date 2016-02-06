<?
class Slim {    
    static function GenerateId() {
        $id = md5(time()); 
        $f = fopen('clients.id', 'a');
        if(!$f)
        {
            $f = fopen('clients.id', 'w+');
            fwrite($f, $id.';');
            fclose($f);
        }
        else
        {
            fwrite($f, $id.';');  
            fclose($f);
        }
        return $id;    
    }
    static function CheckClient() {
        if($_POST['id'] != '' || $_GET['id'] != '') 
        {
            $f = fopen('clients.id', 'r');
            $buffer = '';
            if($_POST['id'] != '')
            {
                while(!feof($f))
                {
                    $buffer = $buffer.fgets($f);   
                }
                fclose($f);
                if(strpos($buffer, $_POST['id']) == false)
                {
                    return false;   
                }
                else
                {
                    return true;   
                }
            }
            if($_GET['id'] != '')
            {
                while(!feof($f))
                {
                    $buffer = $buffer.fgets($f);   
                }
                fclose($f);
                if(strpos($buffer, $_POST['id']) == false)
                {
                    return true;   
                }
                else
                {
                    return false;   
                }
            }
        }
    }
    static function deleteId($id) {
        $f = fopen('clients.id', 'r+');
        while(!feof($f))
        {
            $buffer = $buffer.fgets($f);   
        }
        substr($buffer, '', 0);
        file_put_contents('clients.id', '');
        fwrite($f, $buffer);
        fclose($f);
    }
}
?>