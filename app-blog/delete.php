<?php 

require 'function.php';

// mengambil id dari url
$id = $_GET['id'];

if(delete($id) > 0 ) {
    echo "  <script>
            alert('Data berhasil dihapus');
            document.location.href = 'index.php';
            </script>";
    } else {
        echo "Data gagal dihapus";
    }

?>