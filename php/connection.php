        <?php
        $conn = oci_connect('mentorinaja', 'krisna2019', '//localhost/XE');
      
        if (!$conn) {
            echo 'Failed to connect to oracle' . "<br>";
            
        }
        else {
            echo 'Connected successfully!' ."<br>";
        }
        ?>
