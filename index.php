<?php
//curs_soap.php
    $client = new SoapClient("http://www.cbr.ru/dailyinfowebserv/dailyinfo.asmx?wsdl");
    try 
    {
        $current_date = date('d/m/Y');
        $current_date_yandex = date('Y-m-d', strtotime(date('Y-m-d')) + 24*60*60);
        $param["On_date"] = $current_date_yandex;

        $res = $client->GetCursOnDate($param);

        $xml = new SimpleXMLElement($res->GetCursOnDateResult->any);

        foreach ($xml->ValuteData[0] as $curs_item) 
        {
            $b = json_decode(json_encode($curs_item));
            echo "Обозначение: " . $b->VchCode . " Название: " . $b->Vname . " Номинал: " . $b->Vnom . " Курс: " . $b->Vcurs . "<br>";
        }

    } 
    catch (SoapFault $e)
    {
      echo 'Операция '.$e->faultcode.' вернула ошибку: '.$e->getMessage();
    }

?>