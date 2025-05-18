<?php
include 'config.php';

// Insert or Update book
if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $title = $_POST['book_title'];
    $author = $_POST['author_name'];
    $genre = $_POST['genre'];
    $year = $_POST['publication_year'];
    $quantity = $_POST['quantity'];

    // Handle image upload (convert to BLOB)
    $coverBlob = null;
    if (isset($_FILES['book_cover']) && $_FILES['book_cover']['error'] === 0) {
        $coverBlob = addslashes(file_get_contents($_FILES['book_cover']['tmp_name']));
    }

    if ($id) {
        // If updating and no new file uploaded, retain old cover
        if (!$coverBlob) {
            $query = "UPDATE libraryManagement SET book_title='$title', author_name='$author', genre='$genre', publication_year='$year', quantity=$quantity WHERE id=$id";
        } else {
            $query = "UPDATE libraryManagement SET book_title='$title', author_name='$author', book_cover='$coverBlob', genre='$genre', publication_year='$year', quantity=$quantity WHERE id=$id";
        }
    } else {
        $query = "INSERT INTO libraryManagement (book_title, author_name, book_cover, genre, publication_year, quantity) 
                  VALUES ('$title', '$author', '$coverBlob', '$genre', '$year', $quantity)";
    }

    $conn->query($query);
    header("Location: index.php");
    exit();
}

// Fetch all books
$result = $conn->query("SELECT * FROM libraryManagement");

// Get book for edit
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editData = $conn->query("SELECT * FROM libraryManagement WHERE id=$id")->fetch_assoc();
}

// View a book
if (isset($_GET['view'])) {
    $viewId = intval($_GET['view']);
    $viewBook = $conn->query("SELECT * FROM libraryManagement WHERE id=$viewId")->fetch_assoc();
    include 'views/book_view.php';
    exit();
}

// Delete book
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM libraryManagement WHERE id=$id");
    header("Location: index.php");
    exit();
}

// Load layout
include 'header.php';
include 'form.php'; 
include 'book_table.php';
?>
