<!DOCTYPE html>
<html>

<head>
    <title>Table with database</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            color: green;
            font-family: monospace;
            font-size: 25px;
            text-align: left;
        }

        th {
            background-color: green;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th>Id</th>
            <th>Title</th>
        </tr>
        
        <?php
        $conn = oci_connect('mentorinaja', 'krisna2019', '//localhost/XE');
        // Check connection
        if (!$conn) {
            echo 'Failed to connect to oracle' . "<br>";
        }
        else {
            echo 'Connected successfully!' ."<br>";
        }

        //query to fetch data
        $query = 'SELECT Movie_id, Title FROM MOVIE';
        $stid = oci_parse($conn, $query);

        if (!$stid) {
            $m = oci_error($conn);
            trigger_error('Could not parse statement: '. $m['message'], E_USER_ERROR);
        }
        print "oci_parse executed";
        echo '<br>';
        
        $r = oci_execute($stid);
        if (!$r) {
            $m = oci_error($stid);
            trigger_error('Could not execute statement: '. $m['message'], E_USER_ERROR);
        }
        print "oci executed". "\n";
        echo '<br>';

        //retrieving data as a tuple 
        print '<table border="1">';
        while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
            print '<tr>';
            foreach ($row as $item) {
                print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
            }
            print '</tr>';
        }

        print '</table>';
                print "table end";
        oci_close($conn);

        ?>
    </table>
</body>

</html>