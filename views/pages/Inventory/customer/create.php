<?php
echo Page::title(["title"=>"Create Customer"]);
echo Page::body_open();
echo Html::link(["class"=>"btn btn-success", "route"=>"customer", "text"=>"Manage Customer"]);
echo Page::context_open();
echo Form::open(["route"=>"customer/save"]);
	echo Form::input(["label"=>"Name","type"=>"text","name"=>"name"]);
	echo Form::input(["label"=>"Email","type"=>"text","name"=>"email"]);
	echo Form::input(["label"=>"Phone","type"=>"text","name"=>"phone"]);
	echo Form::input(["label"=>"Address","type"=>"textarea","name"=>"address"]);
	echo Form::input(["label"=>"Password","type"=>"text","name"=>"password"]);

echo Form::input(["name"=>"create","class"=>"btn btn-primary offset-2", "value"=>"Save", "type"=>"submit"]);
echo Form::close();
echo Page::context_close();
echo Page::body_close();
?>

<style>
/* ===== Professional & Clean Form Styling ===== */
.card-body form {
    background: #ffffff; /* crisp white */
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.07);
    transition: all 0.3s ease-in-out;
    border: 1px solid #e0e0e0;
}

.card-body form:hover {
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
}

.card-body form .form-group {
    margin-bottom: 20px;
}

.card-body form .form-group label {
    font-weight: 500;
    font-size: 0.95rem;
    color: #4b4b4b;
    margin-bottom: 5px;
}

.card-body form .form-control {
    border: 1px solid #ced4da;
    border-radius: 8px;
    padding: 10px 15px;
    font-size: 0.95rem;
    transition: all 0.3s ease-in-out;
    background-color: #fafafa;
}

.card-body form .form-control:focus {
    border-color: #4a90e2; /* professional blue highlight */
    background-color: #fff;
    box-shadow: 0 0 6px rgba(74, 144, 226, 0.25);
}

.card-body form textarea.form-control {
    min-height: 120px;
    resize: vertical;
}

.card-body form input[type="submit"] {
    background-color: #4a90e2;
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    color: #ffffff;
    font-weight: 600;
    font-size: 0.95rem;
    transition: all 0.3s ease-in-out;
}

.card-body form input[type="submit"]:hover {
    background-color: #357ABD;
    box-shadow: 0 4px 15px rgba(53, 122, 189, 0.4);
    cursor: pointer;
}

.card-body form input:focus,
.card-body form textarea:focus {
    outline: none;
}

.card-body form .offset-2 {
    margin-left: 0 !important; /* align button neatly */
}
</style>

