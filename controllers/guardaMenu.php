<?php
// Get the data sent from the client-side
if (isset($_POST['localStorageData'])) {
    $localStorageData = $_POST['localStorageData'];

    // Process or save the data as needed
    // For example, you can save it to a file or a database
    // $result = saveData($localStorageData);

    // Respond with a success message or any other response
    echo 'Data received successfully';
} else {
    // Handle the case when data is not sent
    echo 'No data received';
}
?>
