<?php
require_once 'DbOperations.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['function2call']) && !empty($_POST['function2call'])) {
      $function2call = $_POST['function2call'];
      $lol = $_POST['orden'];
      switch($function2call) {
          case 'orderOperations' : orderOperations();break;
          case 'payBill' : payBill();break;
          case 'modProduct' : modProduct();break;
          case 'addOrder' : addOrder();break;
          case 'addProduct' : addProduct();break;
          case 'createBill' : createBill();break;
          case 'removeProduct' : removeProduct();break;
          case 'removeEmployee' : removeEmployee();break;
          case 'modEmployee' : modEmployee();break;
          case 'addEmployee' : addEmployee();break;
          case 'removeTable' : removeTable();break;
          case 'addTable' : addTable();break;
          case 'other' : // do something;break;
          // other cases
      }
  }
}
function orderOperations(){
  $status = "";
  if(isset($_POST['orden'], $_POST['operacion'])){
			$db = new DbOperations();
			if($db->orderOperations($_POST['orden'], $_POST['operacion'])){
				$status = 'ok';
			}else{
				$status = 'err';
			}

	}else {
		$status = 'err';
	}
unset($db);
echo $status;die;
}

function payBill(){
  $status = "";
  if(isset($_POST['cuenta'])){
  			$db = new DbOperations();
  			if($db->payBill($_POST['cuenta'])){
  				$status = 'ok';
  			}else{
  				$status = 'err';
  			}

  	}else {
  		$status = 'err';
  	}
unset($db);
echo $status;die;
}
function modProduct(){
  $status = "";
  if(isset($_POST['id'], $_POST['nombre'], $_POST['costo'],$_POST['precio'], $_POST['tipo'])){
			$db = new DbOperations();
			if($db->modProduct($_POST['id'], $_POST['nombre'], $_POST['costo'],$_POST['precio'], $_POST['tipo'])){
				$status = 'ok';
			}else{
				$status = 'err';
			}

	}else {
		$status = 'err';
	}
unset($db);
echo $status;die;
}

function addOrder(){
  $status = "";
  if(isset($_POST['producto'], $_POST['mesa'], $_POST['cuenta'])){
			$db = new DbOperations();
			if($db->addOrder($_POST['producto'], $_POST['mesa'], $_POST['cuenta'])){
				$status = 'ok';
			}else{
				$status = 'err';
			}

	}else {
		$status = 'err';
	}
unset($db);
echo $status;die;
}

function addProduct(){
  $status = "";
  if(isset($_POST['nombre'], $_POST['tipo'], $_POST['costo'], $_POST['precio'])){
			$db = new DbOperations();
			if($db->addProduct($_POST['nombre'], $_POST['tipo'],$_POST['costo'], $_POST['precio'])){
				$status = 'ok';
			}else{
				$status = 'err';
			}

	}else {
		$status = 'err';
	}
unset($db);
echo $status;die;
}

function createBill(){
  $status = "";
  if(isset($_POST['nombre'], $_POST['mesero'], $_POST['mesa'])){
  			$db = new DbOperations();
  			if($db->createBill($_POST['nombre'], $_POST['mesero'], $_POST['mesa'])){
  				$status = 'ok';
  			}else{
  				$status = 'err';
  			}

  	}else {
  		$status = 'err';
  	}
unset($db);
echo $status;die;
}

function removeProduct(){
  $status = "";
  if(isset($_POST['id'])){
  			$db = new DbOperations();
  			if($db->genericDelete($_POST['id'], "Productos")){
  				$status = 'ok';
  			}else{
  				$status = 'err';
  			}

  	}else {
  		$status = 'err';
  	}
unset($db);
echo $status;die;
}


function removeEmployee(){
  $status = "";
  if(isset($_POST['id'])){
			$db = new DbOperations();
			if($db->genericDelete($_POST['id'], "Empleado")){
				$status = 'ok';
			}else{
				$status = 'err';
			}

	}else {
		$status = 'err';
	}
unset($db);
echo $status;die;
}

function modEmployee(){
  $status = "";
  if(isset($_POST['id'], $_POST['nombre'], $_POST['tipo'],$_POST['sueldo'], $_POST['estado'])){
			$db = new DbOperations();
			if($db->modEmployee($_POST['id'], $_POST['nombre'], $_POST['tipo'],$_POST['sueldo'], $_POST['estado'])){
				$status = 'ok';
			}else{
				$status = 'err';
			}

	}else {
		$status = 'err';
	}
unset($db);
echo $status;die;
}

function addEmployee(){
  $status = "";
  if(isset($_POST['nombre'], $_POST['tipo'], $_POST['sueldo'], $_POST['estado'])){
			$db = new DbOperations();
			if($db->addEmployee($_POST['nombre'], $_POST['tipo'],$_POST['sueldo'], $_POST['estado'])){
				$status = 'ok';
			}else{
				$status = 'err';
			}

	}else {
		$status = 'err';
	}
unset($db);
echo $status;die;
}

function removeTable(){
  $status = "";
  if(isset($_POST['mesa'])){
			$db = new DbOperations();
			if($db->deleteTable($_POST['mesa'])){
				$status = 'ok';
			}else{
				$status = 'err';
			}

	}else {
		$status = 'err';
	}
unset($db);
echo $status;die;
}

function addTable(){
  $status = "";
  if(isset($_POST['capacidad'])){
			$db = new DbOperations();
			if($db->createTable($_POST['capacidad'])){
				$status = 'ok';
			}else{
				$status = 'err';
			}

	}else {
		$status = 'err';
	}
unset($db);
echo $status;die;
}

?>
