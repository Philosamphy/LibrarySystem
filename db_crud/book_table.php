<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Library Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light p-4">
    <div class="container">
        <table class="table table-bordered table-striped bg-white shadow">
            <thead class="table-dark">
                <tr>
                    <th>Book ID</th>
                    <th>Book Title</th>
                    <th>Author Name</th>
                    <th>Book Cover</th>
                    <th>Genre</th>
                    <th>Publication Year</th>
                    <th>Quantity</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['id']) ?></td>
                        <td><?= htmlspecialchars($row['book_title']) ?></td>
                        <td><?= htmlspecialchars($row['author_name']) ?></td>
                        <td>
                            <?php if ($row['book_cover']): ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($row['book_cover']) ?>" alt="Cover" style="height:60px;">
                            <?php else: ?>
                                No Cover
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['genre']) ?></td>
                        <td><?= htmlspecialchars($row['publication_year']) ?></td>
                        <td><?= htmlspecialchars($row['quantity']) ?></td>
                        <td><a href="?edit=<?= urlencode($row['id']) ?>" class="btn btn-sm btn-warning">Edit</a></td>
                        <td><a href="?delete=<?= urlencode($row['id']) ?>" onclick="return confirm('Delete this book?')" class="btn btn-sm btn-danger">Delete</a></td>
                        <td><a href="?view=<?= urlencode($row['id']) ?>" class="btn btn-sm btn-info">View</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
