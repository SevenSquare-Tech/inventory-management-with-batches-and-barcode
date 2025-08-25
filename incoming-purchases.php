<?php

use phpGrid\C_DataGrid;

include_once("phpGrid/conf.php");
include_once('inc/head.php');
?>

<h1>My Inventory Manager</h1>

<?php
$_GET['currentPage'] = 'incoming';
include_once('inc/menu.php');
?>

<button class="add-new-row">Add New Purchase</button>

<?php
$agPur = new C_DataGrid('SELECT id, PurchaseDate, ProductId, NumberReceived, SupplierId FROM purchases', 'id', 'purchases');
$agPur->set_col_hidden('id', false);

$agPur->set_col_title('PurchaseDate', 'Date of Purchase');
$agPur->set_col_title('ProductId', 'Product');
$agPur->set_col_title('NumberReceived', 'Number Received');
$agPur->set_col_title('SupplierId', 'Supplier');

$agPur->set_col_edittype('ProductId', 'autocomplete', "select id, concat(lpad(id, 8, '0'), ' | ', ProductLabel) from products");
$agPur->set_col_edittype('SupplierId', 'autocomplete', "select id, supplier from suppliers");

$agPur->set_pagesize(100);

$agPur->set_col_width('PurchaseDate', '50px');
$agPur->set_col_width('NumberReceived', '35px');

$agPur->set_group_properties('ProductId', false, true, true, false);
$agPur->set_group_summary('NumberReceived', 'sum');

$agPur->enable_autowidth(true);

$agPur->enable_edit('FORM');
$agPur->display();
?>

Incoming orders increase inventory.

<script>
	$(function() {
		$(".add-new-row").on("click", function() {
			$("#add_purchases").click();
		});
	});
</script>

<?php
include_once('inc/footer.php');
?>