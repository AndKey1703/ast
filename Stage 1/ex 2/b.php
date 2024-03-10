<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CSV Table Viewer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1>CSV Table Viewer</h1>

    <form method="post" enctype="multipart/form-data">
        <input type="file" name="csv_file" />
        <button type="submit">Upload CSV File</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['csv_file'])) {
            $file = $_FILES['csv_file']['tmp_name'];
            $file_handle = fopen($file, "r");

            echo '<table class="table">';
            while (!feof($file_handle)) {
                $csv_data = fgetcsv($file_handle);
                echo '<tr>';
                foreach ($csv_data as $value) {
                    echo '<td>' . $value . '</td>';
                }
                echo '</tr>';
            }
            echo '</table>';

            fclose($file_handle);
        }
    }
    ?>

</div>

</body>
</html>
