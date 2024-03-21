<?php
// Include the database connection
require_once "dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the edit button is pressed
    if (isset($_POST['edit'])) {
        // Check if a resource is selected
        if (isset($_POST['resource_ids']) && !empty($_POST['resource_ids'])) {
            // Get the selected resource ID
            $resourceID = $_POST['resource_ids'][0]; // Since only one resource can be selected

            // Redirect to the edit resource page with the resource ID as a parameter
            header("Location: adminedit_resource.php?resourceID=$resourceID");
            exit();
        } else {
            // No resource selected for editing
            header("Location: adminmanageresource.php?edit_error=true");
            exit();
        }
    }

    // Check if the add button is pressed
    if (isset($_POST['add'])) {
        // Redirect to the add resource page
        header("Location: adminadd_resource.php");
        exit();
    }

    // Check if the delete button is pressed
    if (isset($_POST['delete'])) {
        // Check if a resource is selected
        if (isset($_POST['resource_ids']) && !empty($_POST['resource_ids'])) {
            // Get the selected resource ID
            $resourceID = $_POST['resource_ids'][0]; // Since only one resource can be selected

            // SQL query to delete resource data by resource ID
            $deleteSql = "DELETE FROM resourceinfo WHERE resourceID = ?";
            $stmt = $conn->prepare($deleteSql);
            $stmt->bind_param("s", $resourceID);

            // Execute the statement
            $stmt->execute();

            // Close the statement
            $stmt->close();

            // Redirect back to adminmanagecourt.php
            header("Location: adminmanageresource.php");
            exit();
        } else {
            // No resource selected for delete
            header("Location: adminmanageresource.php?delete_error=true");
            exit();
        }
    }
}
?>
