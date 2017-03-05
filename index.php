<?php
//curs_soap.php
    $client = new SoapClient("http://www.cbr.ru/dailyinfowebserv/dailyinfo.asmx?wsdl");
    try 
    {
        $current_date = date('Y-m-d');
        
        //echo "current_date: ", $current_date, "</br>";
        
        $param["On_date"] = $current_date;

        $res = $client->GetCursOnDate($param);

        $xml = new SimpleXMLElement($res->GetCursOnDateResult->any);
        
        //var_dump($xml);

        
        /*foreach ($xml->ValuteData[0] as $curs_item) 
        {
            echo "Обозначение: " . $curs_item->VchCode . " Название: " . $curs_item->Vname . " Номинал: " . $curs_item->Vnom . " Курс: " . $curs_item->Vcurs . "</br>";
        }*/
        
        echo "<table border=1>
                <tr>
                    <th>Обозначение</th>
                    <th>Название</th>
                    <th>Номинал</th>
                    <th>Курс</th>
                </tr>";
        
        foreach ($xml->ValuteData[0] as $curs_item) 
        {
           echo "<tr>
                   <td>$curs_item->VchCode</td>
                   <td>$curs_item->Vname</td>
                   <td>$curs_item->Vnom</td>
                   <td>$curs_item->Vcurs</td>
                </tr>";
        }
        
        echo "</table>";

    } 
    catch (SoapFault $e)
    {
      echo 'Операция '.$e->faultcode.' вернула ошибку: '.$e->getMessage();
    }

?>


