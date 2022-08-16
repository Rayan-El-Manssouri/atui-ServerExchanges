<?php 
class Database
{

    private $host = "localhost";
    private $username = "test";
    private $password = "root";
    private $db = "atui";

    function connect()
    {

        $connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
        $connection->set_charset("utf8");
        return $connection;
    }

    function read($query)
    {
        $conn = $this->connect();
        $result = mysqli_query($conn, $query);

        if (!$result) {
            return false;
        } else {
            $data = false;
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            return $data;
        }

        function save($query)
        {
            $connection = $this->connect();
            $result = mysqli_query($connection, $query);

            if (!$result) {
                return false;
            } else {
                return true;
            }
        }
    }
}
?>