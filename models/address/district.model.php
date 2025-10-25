<?php
class District {
	

	public static function getAll() {
       global $db;
	   $sql = $db->query("select * from districts");
	   return $sql->fetch_all(MYSQLI_ASSOC);
	}
}
?>
