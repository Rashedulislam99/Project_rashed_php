<?php
//  print_r($status);
?>
<style>
body {
    background-color: #f8f9fa;
    font-family: "Segoe UI", sans-serif;
}
.form-container {
    max-width: 600px;
    margin: 50px auto;
    background: #fff;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.form-container h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #333;
}
.form-label {
    font-weight: 600;
    color: #555;
}
.btn-primary {
    width: 100%;
    background: #007bff;
    border: none;
    transition: all 0.2s ease;
}
.btn-primary:hover {
    background: #0056b3;
    transform: scale(1.03);
}
.back-link {
    display: inline-block;
    margin-top: 15px;
    text-decoration: none;
    color: #6c757d;
    font-size: 14px;
}
.back-link:hover {
    text-decoration: underline;
}
</style>

<div class="form-container">
    <h2>Add New Supplier</h2>
    <form action="<?= $base_url ?>/suppliers/save" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Supplier Name </label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter supplier name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email address">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter phone number">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" class="form-control" id="address" rows="3" placeholder="Enter supplier address"></textarea>
        </div>

        <button type="submit" name="create" value="create" class="btn btn-primary">Submit</button>
        
    </form>
    <a href="<?= $base_url ?>/suppliers" class="back-link">← Back to list</a>
</div>
