<?php 
    require './function.php';

    $id = $_GET['id'];

    if ( deleted($id) >0 ){
        echo "
                <script>
                    alert('Delete Success!');
                    document.location.href = 'index.php';
                </script>
           ";
    } else {
        echo "
                <script>
                    alert('Delete Wrong!');
                    document.location.href = 'index.php';
                </script>
           ";
    }
?>
