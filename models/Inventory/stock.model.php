<?php
class Stock extends Model implements JsonSerializable
{
	public $id;
	public $product_id;
	public $qty;
	public $transaction_type_id;
	public $remark;
	public $created_at;
	public $warehouse_id;
	public $updated_at;
	public $lot_id;

	public function __construct() {}
	public function set($id, $product_id, $qty, $transaction_type_id, $remark, $created_at, $warehouse_id, $updated_at, $lot_id)
	{
		$this->id = $id;
		$this->product_id = $product_id;
		$this->qty = $qty;
		$this->transaction_type_id = $transaction_type_id;
		$this->remark = $remark;
		$this->created_at = $created_at;
		$this->warehouse_id = $warehouse_id;
		$this->updated_at = $updated_at;
		$this->updated_at = $lot_id;
	}
	public function save()
	{
		global $db, $tx;
		$db->query("insert into {$tx}stocks(product_id,qty,transaction_type_id,remark,created_at,warehouse_id,updated_at,lot_id)values('$this->product_id','$this->qty','$this->transaction_type_id','$this->remark','$this->created_at','$this->warehouse_id','$this->updated_at','$this->lot_id')");
		return $db->insert_id;
	}
	public function update()
	{
		global $db, $tx;
		$db->query("update {$tx}stocks set product_id='$this->product_id',qty='$this->qty',transaction_type_id='$this->transaction_type_id',remark='$this->remark', created_at='$this->created_at',warehouse_id='$this->warehouse_id',updated_at='$this->updated_at',lot_id='$this->lot_id', where id='$this->id'");
	}
	public static function delete($id)
	{
		global $db, $tx;
		$db->query("delete from {$tx}stocks where id={$id}");
	}
	public function jsonSerialize(): mixed
	{
		return get_object_vars($this);
	}
	public static function all()
	{
		global $db, $tx;
		$result = $db->query("select id,product_id,qty,transaction_type_id,remark,created_at,warehouse_id,updated_at,lot_id from {$tx}stocks");
		$data = [];
		while ($stock = $result->fetch_object()) {
			$data[] = $stock;
		}
		return $data;
	}
	public static function find_by_product_id($id)
	{
		global $db, $tx;
		$result = $db->query("select id,product_id,qty,transaction_type_id,remark,created_at,warehouse_id,updated_at,lot_id from {$tx}stocks where product_id=$id");
		$data = [];
		while ($stock = $result->fetch_object()) {
			$data[] = $stock;
		}
		return $data;
	}
	public static function getAllStocks()
	{
		global $db, $tx;
		$result = $db->query("select s.id,p.id product_id ,p.name as product,sum(s.qty) as quantity,tt.name as transaction_type ,s.remark,s.updated_at from {$tx}stocks s 
		JOIN {$tx}products p ON s.product_id = p.id
		JOIN {$tx}transaction_types tt ON s.transaction_type_id = tt.id
		GROUP BY s.product_id
		");
		$data = [];
		while ($stock = $result->fetch_object()) {
			$data[] = $stock;
		}
		return $data;
	}
	public static function getFilteredStocks($start_date = null, $end_date = null)
	{
		global $db, $tx;

		$sql = "
SELECT 
    p.id AS id,
    p.name AS product,
    SUM(s.qty) AS quantity,
    MAX(tt.name) AS transaction_type,
    MAX(s.remark) AS remark,
    MAX(s.updated_at) AS updated_at
FROM {$tx}stocks s
JOIN {$tx}products p 
    ON s.product_id = p.id
JOIN {$tx}transaction_types tt 
    ON s.transaction_type_id = tt.id
WHERE 1=1
";

		if ($start_date && $end_date) {
			$sql .= " AND DATE(s.updated_at) BETWEEN '{$start_date}' AND '{$end_date}'";
		}

		$sql .= "
GROUP BY p.id, p.name
ORDER BY updated_at DESC
";


		$result = $db->query($sql);
		$data = [];
		while ($stock = $result->fetch_object()) {
			$data[] = $stock;
		}
		return $data;
	}


	public static function getLowStockProducts($threshold = 5)
{
    global $db, $tx;

    $sql = "SELECT 
                p.id AS product_id,
                p.name AS product,
                SUM(s.qty) AS quantity,
                MAX(s.updated_at) AS last_updated
            FROM {$tx}stocks s
            INNER JOIN {$tx}products p ON s.product_id = p.id
            GROUP BY p.id, p.name
            HAVING SUM(s.qty) < {$threshold}
            ORDER BY quantity ASC";

    $result = $db->query($sql);

    if (!$result) {
        die('Query Error: ' . $db->error);
    }

    $data = [];
    while ($row = $result->fetch_object()) {
        $data[] = $row;
    }

    return $data;
}



//getOverStockProducts

public static function getOverStockProducts($threshold = 20)
{
    global $db, $tx;

    $sql = "SELECT 
                p.id AS product_id,
                p.name AS product,
                SUM(s.qty) AS quantity,
                MAX(s.updated_at) AS last_updated
            FROM {$tx}stocks s
            INNER JOIN {$tx}products p ON s.product_id = p.id
            GROUP BY p.id, p.name
            HAVING SUM(s.qty) > {$threshold}
            ORDER BY quantity DESC";

    $result = $db->query($sql);

    if (!$result) {
        die('Query Error: ' . $db->error);
    }

    $data = [];
    while ($row = $result->fetch_object()) {
        $data[] = $row;
    }

    return $data;
}




	public static function pagination($page = 1, $perpage = 10, $criteria = "")
	{
		global $db, $tx;
		$top = ($page - 1) * $perpage;
		$result = $db->query("select id,product_id,qty,transaction_type_id,remark,created_at,warehouse_id,updated_at,lot_id from {$tx}stocks $criteria limit $top,$perpage");
		$data = [];
		while ($stock = $result->fetch_object()) {
			$data[] = $stock;
		}
		return $data;
	}
	public static function count($criteria = "")
	{
		global $db, $tx;
		$result = $db->query("select count(*) from {$tx}stocks $criteria");
		list($count) = $result->fetch_row();
		return $count;
	}
	public static function find($id)
	{
		global $db, $tx;
		$result = $db->query("select id,product_id,qty,transaction_type_id,remark,created_at,warehouse_id,updated_at,lot_id from {$tx}stocks where id='$id'");
		$stock = $result->fetch_object();
		return $stock;
	}
	static function get_last_id()
	{
		global $db, $tx;
		$result = $db->query("select max(id) last_id from {$tx}stocks");
		$stock = $result->fetch_object();
		return $stock->last_id;
	}
	public function json()
	{
		return json_encode($this);
	}
	public function __toString()
	{
		return "		Id:$this->id<br> 
		Product Id:$this->product_id<br> 
		Qty:$this->qty<br> 
		Transaction Type Id:$this->transaction_type_id<br> 
		Remark:$this->remark<br> 
		Created At:$this->created_at<br> 
		Warehouse Id:$this->warehouse_id<br> 
		Updated At:$this->updated_at<br>
		Lot ID:$this->lot_id<br>  
";
	}

	//-------------HTML----------//

	static function html_select($name = "cmbStock")
	{
		global $db, $tx;
		$html = "<select id='$name' name='$name'> ";
		$result = $db->query("select id,name from {$tx}stocks");
		while ($stock = $result->fetch_object()) {
			$html .= "<option value ='$stock->id'>$stock->name</option>";
		}
		$html .= "</select>";
		return $html;
	}
	static function html_table($page = 1, $perpage = 10, $criteria = "", $action = true)
	{
		global $db, $tx, $base_url;
		$count_result = $db->query("select count(*) total from {$tx}stocks $criteria ");
		list($total_rows) = $count_result->fetch_row();
		$total_pages = ceil($total_rows / $perpage);
		$top = ($page - 1) * $perpage;
		$result = $db->query("select id,product_id,qty,transaction_type_id,remark,created_at,warehouse_id,updated_at,lot_id from {$tx}stocks $criteria limit $top,$perpage");
		$html = "<table class='table'>";
		$html .= "<tr><th colspan='3'>" . Html::link(["class" => "btn btn-success", "route" => "stock/create", "text" => "New Stock"]) . "</th></tr>";
		if ($action) {
			$html .= "<tr><th>Id</th><th>Product Id</th><th>Qty</th><th>Transaction Type Id</th><th>Remark</th><th>Created At</th><th>Warehouse Id</th><th>Updated At</th><th>Lot ID</th><th>Action</th></tr>";
		} else {
			$html .= "<tr><th>Id</th><th>Product Id</th><th>Qty</th><th>Transaction Type Id</th><th>Remark</th><th>Created At</th><th>Warehouse Id</th><th>Updated At</th><th>Lot ID</th></tr>";
		}
		while ($stock = $result->fetch_object()) {
			$action_buttons = "";
			if ($action) {
				$action_buttons = "<td><div class='btn-group' style='display:flex;'>";
				$action_buttons .= Event::button(["name" => "show", "value" => "Show", "class" => "btn btn-info", "route" => "stock/show/$stock->id"]);
				$action_buttons .= Event::button(["name" => "edit", "value" => "Edit", "class" => "btn btn-primary", "route" => "stock/edit/$stock->id"]);
				$action_buttons .= Event::button(["name" => "delete", "value" => "Delete", "class" => "btn btn-danger", "route" => "stock/confirm/$stock->id"]);
				$action_buttons .= "</div></td>";
			}
			$html .= "<tr><td>$stock->id</td><td>$stock->product_id</td><td>$stock->qty</td><td>$stock->date</td><td>$stock->transaction_type_id</td><td>$stock->warehouse_id</td><td>$stock->created_at</td><td>$stock->updated_at</td> $action_buttons</tr>";
		}
		$html .= "</table>";
		$html .= pagination($page, $total_pages);
		return $html;
	}
	static function html_row_details($id)
	{
		global $db, $tx, $base_url;
		$result = $db->query("select id,product_id,qty,transaction_type_id,remark,created_at,warehouse_id,updated_at,lot_id from {$tx}stocks where id={$id}");
		$stock = $result->fetch_object();
		$html = "<table class='table'>";
		$html .= "<tr><th colspan=\"2\">Stock Show</th></tr>";
		$html .= "<tr><th>Id</th><td>$stock->id</td></tr>";
		$html .= "<tr><th>Product Id</th><td>$stock->product_id</td></tr>";
		$html .= "<tr><th>Qty</th><td>$stock->qty</td></tr>";
		$html .= "<tr><th>Transaction Type Id</th><td>$stock->transaction_type_id</td></tr>";
		$html .= "<tr><th>Remark</th><td>$stock->remark</td></tr>";
		$html .= "<tr><th>Created At</th><td>$stock->created_at</td></tr>";
		$html .= "<tr><th>Warehouse Id</th><td>$stock->warehouse_id</td></tr>";
		$html .= "<tr><th>Updated At</th><td>$stock->updated_at</td></tr>";
		$html .= "<tr><th>Lot ID</th><td>$stock->lot_id</td></tr>";

		$html .= "</table>";
		return $html;
	}
}
