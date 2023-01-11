<?php

    $con = new mysqli('localhost','root','','abocad');

    // para usar la funcion sql2csv hay que evitar campos con nombre duplicado en el sql, usando alias
    $sql_query = "select 
                    eventos.id,coberturas.nombre as cobertura,
                    eventos.dni,eventos.title,eventos.description as descripcion,eventos.start as desde,eventos.end as hasta,
                    tratamientos.descTratamiento as tratamiento,profesionales.nombre as profesional
                    from eventos
                    inner join profesionales ON
                    eventos.profesional = profesionales.id
                    inner join coberturas ON
                    eventos.cobertura = coberturas.id
                    inner join tratamientos ON
                    eventos.tratamiento = tratamientos.idTratamiento
                    ";
    
    sql2csv ($con, $sql_query, 'client.csv', 1);  



    function sql2csv($con, $sql, $filename='', $headings=1)
            /**
            * Parameters
            * $con      -   connection
            * $sql      -   the sql query to be executed
            * $filename -   name of download file (default "download_yymmddhhii.csv")
            * $headings -   1 if fieldname headings required (default), 0 if not required
            */
        {
        if (!$filename)
            $f = 'download_' . date('ymdhi') . '.csv';
        else 
            $f = $filename;
        $fp = fopen('php://output', 'w');        // so you can fputcsv to STDOUT
        if ($fp) {
            $res = $con->query($sql);
            if ($res) {
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="'.$f.'"');
                header('Pragma: no-cache');
                header('Expires: 0');
                $row = $res->fetch_assoc();
                if ($headings) {
                    fputcsv($fp, array_keys($row));
                }
                do {
                    fputcsv($fp, $row);
                } while ($row = $res->fetch_assoc());
                
            }
            else echo "Error in query";
            fclose($fp);
        }

        }



?>