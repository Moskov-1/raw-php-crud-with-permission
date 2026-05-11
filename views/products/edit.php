<?php require_once __DIR__ . '/../layout.php'; ?>

<div class="container">
    <h1>Edit Product</h1>
    <form action="/products/edit" method="POST">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $product['name'] ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"><?= $product['description'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= $product['price'] ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
