<?php 
	class DbOperations{
		private $con; 
		function __construct(){
			require_once 'DbConnect.php';
			$db = new DbConnect();
			$this->con = $db->connect();
		}
		
		public function createTable($capacidad) {
			$consulta = "INSERT INTO Mesa (capacidad) VALUES ('$capacidad')";
			if($this->con->query($consulta)){
				return true; 
			}else{
				return false;
			}
		}
		
		public function addEmployee($nombre, $tipo, $sueldo, $estado) {
			if($estado = 'Alta' || $estado = 'alta'){
				$status = 1;
			}else{
				$status = 0;
			}
			$consulta = "INSERT INTO Empleado (nombreCompleto, tipo, sueldo, estado) VALUES ('$nombre', '$tipo', '$sueldo', '$status')";
			if($this->con->query($consulta)){
				return true; 
			}else{
				return false;
			}
		}
		
		public function deleteTable($mMesa) {
			$consulta = "DELETE FROM Mesa WHERE idMesa = $mMesa";
			if($this->con->query($consulta)){
				return true; 
			}else{
				return false;
			}
		}
		function getMesas() {
			$consulta = "SELECT * FROM Mesa";
			$contador = 1;
			if($result = $this->con->query($consulta)){
				while($row = mysqli_fetch_array($result)){
					echo "
					<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card'>
						<div class='card card-statistics'>
							<div class='card-body'>
								<div class='clearfix'>
									<div class='float-left'>
										<i class='mdi mdi-cube text-danger icon-lg'></i>
									</div>
								<div class='float-right'>
									<p class='mb-0 text-right'>Mesa</p>
									<div class='fluid-container'>
										<h3 class='font-weight-medium text-right mb-0'>$contador</h3>
									</div>
								</div>
							</div>
							<p class=' mt-3 mb-0'>
								<i class='mdi mdi-alert-octagon mr-1' aria-hidden='true'></i>Capacidad $row[1]			
						";
						if($row[2] == 0){
							echo "
								<a href='#' id='$row[0]' onclick='removeTable($row[0])' class='fa fa-trash-o'></a>
							</p>
							<button id='assignTable' name='assignModal' type='button' data-toggle='modal' data-target='#assignModal' onclick='setTableID($row[0])' class='btn btn-success btn-fw'>Asignar</button>";
						}else{
							echo "
								<br>
								<i class='mdi mdi-alert-octagon mr-1' aria-hidden='true'></i>OCUPADO	
							</p>
							";
						}
					echo "</div></div></div>";
					$contador = $contador + 1;
				     }
			}
		}

		
		function getCuentas($cond) {
			$consulta = "SELECT * FROM Cuenta WHERE estado = $cond";
			$contador = 1;
			if($result = $this->con->query($consulta)){
				while($row = mysqli_fetch_array($result)){
					if($row[4] == '0'){
						$state = 'En Curso';
					}else{
						$state = 'Pagada';
					}
					$response = array(); 
					$response['cuenta'] = $row[0];
					$response['mesa'] = $row[2];
					$jsonObject = json_encode($response);
					$mesero = $this->genericSelect('Empleado', 'nombreCompleto', $row[6], 'idEmpleado');
					echo "
					<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card'>
						<div class='card card-statistics'>
							<div class='card-body'>
								<div class='clearfix'>
									<div class='float-left'>
										<i class='mdi mdi-cube text-danger icon-lg'></i>
									</div>
								<div class='float-right'>
									<p class='mb-0 text-right'>Mesa</p>
									<div class='fluid-container'>
										<h3 class='font-weight-medium text-right mb-0'>$row[2]</h3>
									</div>
								</div>
							</div>
							<p class=' mt-3 mb-0'>
								<i class='mdi mdi-alert-octagon mr-1' aria-hidden='true'></i>Numero De Cuenta: $row[0]	
								<i class='mdi mdi-alert-octagon mr-1' aria-hidden='true'></i>Total: $row[1]	
								<i class='mdi mdi-alert-octagon mr-1' aria-hidden='true'></i>Nombre del cliente: $row[3]
								<i class='mdi mdi-alert-octagon mr-1' aria-hidden='true'></i>Fecha: $row[5]
								<i class='mdi mdi-alert-octagon mr-1' aria-hidden='true'></i>Mesero: $mesero
							</p>	
							<br>";
							$consultaOrdenes = "SELECT idOrden, nombre, estado FROM Orden JOIN Productos where Productos_idProductos = idProductos and Cuenta_idCuenta = $row[0]";
							if($resultOrdenes = $this->con->query($consultaOrdenes)){
								while($ordenes = mysqli_fetch_array($resultOrdenes)){
									if($ordenes[2] == '0'){
										$orderStatus = 'Preparando';
									}else if($ordenes[2] == '2'){
										$orderStatus = 'En camino';
									}
									else if($ordenes[2] == '1'){
										$orderStatus = 'Entregado';
									}
									echo"
									<p class=' mt-3 mb-0'>
										<i class='mdi mdi-alert-octagon mr-1' aria-hidden='true'></i>id Dorden: $ordenes[0]	
										<i class='mdi mdi-alert-octagon mr-1' aria-hidden='true'></i>Producto: $ordenes[1]	
										<i class='mdi mdi-alert-octagon mr-1' aria-hidden='true'></i>Estado: $orderStatus
										<br>
									</p>
									";
								}
							}
							if($row[4] == '0'){
								echo"<button id='assignTable' name='orderModal' type='button' data-toggle='modal' data-target='#orderModal' onclick='setOrderData($jsonObject)' class='btn btn-success btn-fw'>Agregar Orden</button>";
								if($orderStatus != 'Entregado'){
									echo"<button id='assignTable' name='pay' type='button' class='btn btn-danger btn-fw disabled'>Pagar</button>";
								}else{
									echo"<button id='assignTable' name='pay' type='button' onclick='payBillFunction($row[0])' class='btn btn-danger btn-fw'>Pagar</button>";
								}
							}
							echo "</div></div></div>";
					$contador = $contador + 1;
				     }
			}
		}
		
		
		
		
		
		function setData($elemento, $optCondition) {
			if($elemento == 'Orden' or $elemento == '`Ingreso/Egreso`'){
				if($elemento == 'Orden'){
					$cond = 'estado';
				}else{
					$cond = 'tipo';
				}
				$consulta = "SELECT * FROM $elemento where $cond = '$optCondition'";
			}else{
				$consulta = "SELECT * FROM $elemento";
			}
			$contador = 1;
			if($result = $this->con->query($consulta)){
				while($row = mysqli_fetch_array($result)){
					$response = array(); 
					$col = array();
					$col[0] = $row[0];
					$col[1] = $row[1];
					$col[2] = $row[2];
					$col[3] = $row[3];
					$col[4] = $row[4];
					if($elemento == 'Empleado'){
						$response['id'] = $row[0];
						$response['nombre'] = $row[1];
						$response['tipo'] = $row[2];
						$response['sueldo'] = $row[3];
						$col[0] = $row[0];
					}else if($elemento == '`Ingreso/Egreso`'){
						$response['id'] = $row[0];
						$response['fecha'] = $row[1];
						$response['monto'] = $row[2];
						$response['tipo'] = $row[3];
						$response['concepto'] = $row[4];
						
					}else{
						$response['id'] = $row[0];
						$response['nombre'] = $row[1];
						$response['costo'] = $row[2];
						$response['precio'] = $row[3];
						$response['tipo'] = $row[4];
					}
					$price ="$ $row[3]";
					if($elemento == 'Orden'){
						$price ="$row[3]";
						$col[1] = $this->genericSelect('Productos', 'nombre', $row[1], 'idProductos');
					}
					
					
					echo "
					<tr>
						<td class='py-1'>
							$col[0]
						</td>
						<td>
							$col[1]
						</td>
						<td>
							$col[2]
						</td>
						<td>
							$price
						</td>";
						if($row[4] == '0' && $elemento == 'Empleado'){
							$status = 'Baja';
							$response['estado'] = $status;
						}else if($row[4] == '1' && $elemento == 'Empleado'){
							$status = 'Alta';
							$response['estado'] = $status;
						}else{
							$status = $row[4];
						}
						$jsonObject = json_encode($response);
						if($elemento == 'Empleado'){
							echo"
								<td>
									$status
								</td>
								<td>
									<a href='#' id='$row[0]' onclick='removeEmployeeFunction($row[0])' class='fa fa-trash-o'></a>
									<a data-toggle='modal' id='modButton' href='#modifyEmployeeModal' onclick='modFiller($jsonObject)' class='fa fa-edit'></a>
								</td>
							</tr>	
							";
						}else if($elemento == 'Productos'){
							echo"
								<td>
									$status
								</td>
								<td>
									<a href='#' id='$row[0]' onclick='removeProductFunction($row[0])' class='fa fa-trash-o'></a>
									<a data-toggle='modal' id='modButton' href='#modifyProductModal' onclick='productModFiller($jsonObject)' class='fa fa-edit'></a>
								</td>
							</tr>	
							";
						}else if($elemento == 'Orden' && $optCondition == 0){
							echo"
								<td>
									<button type='button' class='btn btn-danger btn-fw' onclick='cancelOrderFunction($col[0])'>Cancelar</button>
									<button type='button' class='btn btn-success btn-fw' onclick='deliverOrderFunction($col[0])'>Entregar</button>
								</td>
							</tr>	
							";
						}else if($elemento == '`Ingreso/Egreso`'){
							echo"
								<td>
									$row[4]
								</td>
							</tr>	
							";
						}
						else{
							echo "</tr>";
						}
						
						$contador = $contador + 1;
				     }
			}
		}
		
		function getEmployeesForBill() {
			$consulta = "SELECT * FROM Empleado WHERE tipo = 'Mesero' and estado = 1";
			if($result = $this->con->query($consulta)){
				while($row = mysqli_fetch_array($result)){
					echo "
					<option value='$row[0]'>$row[1]</option>
					";
				     }
			}
		}
		function getProductsForBill() {
			$consulta = "SELECT * FROM Productos";
			if($result = $this->con->query($consulta)){
				while($row = mysqli_fetch_array($result)){
					echo "
					<option value='$row[0]'>$row[1]</option>
					";
				     }
			}
		}
		
		function modEmployee($id,$nombre, $tipo, $sueldo, $estado) {
			if($estado == 'Alta' || $estado == 'alta'){
				$status = 1;
			}else if($estado == 'Baja' || $estado == 'baja'){
				$status = 0;
			}
			$consulta = "UPDATE Empleado SET nombreCompleto='$nombre', tipo = '$tipo', sueldo = '$sueldo', estado = '$status' WHERE idEmpleado = $id";
			if($this->con->query($consulta)){
				return true; 
			}else{
				return false;
			}
		}
		function modProduct($id,$nombre, $costo, $precio, $tipo) {
			$consulta = "UPDATE Productos SET nombre='$nombre', costo = '$costo', precio = '$precio', tipo = '$tipo' WHERE idProductos = $id";
			if($this->con->query($consulta)){
				return true; 
			}else{
				return false;
			}
		}
		function createBill($nombre,$mesero, $mesa) {
			$consulta = "INSERT INTO Cuenta (Mesa_idMesa, nombreDelCliente, estado, Empleado_idEmpleado) VALUES ('$mesa', '$nombre', '0', '$mesero')";
			if($this->con->query($consulta)){
				$consulta = "UPDATE Mesa SET estado='1' WHERE idMesa =$mesa";
				if($this->con->query($consulta)){
					return true; 
				}
			}else{
				return false;
			}
		}
		function addOrder($producto,$mesa, $cuenta) {
			$consulta = "INSERT INTO Orden (Productos_idProductos, estado, Cuenta_idCuenta, Cuenta_Mesa_idMesa) VALUES ('$producto', '0', '$cuenta', '$mesa')";
			if($this->con->query($consulta)){
				$consulta = "UPDATE Mesa SET estado='1' WHERE idMesa =$mesa";
				if($this->con->query($consulta)){
					$price = $this->genericSelect('Productos', 'precio', $producto, 'idProductos');
					$consulta = "UPDATE Cuenta SET total = total + $price";
					if($this->con->query($consulta)){
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		
		public function genericSelect($table, $element, $id, $cond) {
			$consulta = "SELECT $element FROM $table WHERE $cond = $id";
			if($resultado = $this->con->query($consulta)){
				while($row = mysqli_fetch_array($resultado)){
					return $row[0];
				}
			}else{
				return '0';
			}
			
		}
		public function genericDelete($id, $entity) {
			$consulta = "DELETE FROM $entity WHERE id$entity = $id";
			if($this->con->query($consulta)){
				return true; 
			}else{
				return false;
			}
		}
		public function genericUpdate($table, $col, $id, $value) {
			$consulta = "UPDATE $table SET $col = $value WHERE id$table = $id";
			if($this->con->query($consulta)){
				return true; 
			}else{
				return false;
			}
		}
		public function genericInsert($table, $cols, $values) {
			$consulta = "INSERT INTO `$table` ($cols) VALUES ($values)";
			if($this->con->query($consulta)){
				return true; 
			}else{
				return false;
			}
		}
		
		public function addProduct($nombre, $tipo, $costo, $precio) {
			$consulta = "INSERT INTO Productos (nombre, costo, precio, tipo) VALUES ('$nombre', '$costo', '$precio', '$tipo')";
			if($this->con->query($consulta)){
				return true;
			}else{
				return false;
			}
		}
		public function payBill($cuenta) {
			if($this -> genericUpdate('Cuenta', 'estado', $cuenta, '1')){
				$total = $this->genericSelect('Cuenta', 'total', $cuenta, 'idCuenta');
				$mesa = $this->genericSelect('Cuenta', 'Mesa_idMesa', $cuenta, 'idCuenta');
				if($this-> genericInsert('Ingreso/Egreso', 'tipo, monto, concepto', '"Ingreso", '.$total.', "Pago Cuenta #'.$cuenta.'"')){
					$this->genericUpdate('Mesa', 'estado', $mesa, '0');
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		public function orderOperations($order, $operation) {
			if($operation == 'D'){
				return $this->genericDelete($order, 'Orden');
			}else if($operation == 'U'){
				$idProducto = $this -> genericSelect('Orden', 'Productos_idProductos', $order, 'idOrden');
				$precioProducto = $this -> genericSelect('Productos', 'costo', $idProducto, 'idProductos');
				if($this -> genericInsert('Ingreso/Egreso', 'tipo, monto, concepto', '"Egreso", '.$precioProducto.', "Produccion de Orden #'.$order.'"')){
					return $this->genericUpdate('Orden', 'estado', $order, '1');
				}
				
			}
		}
	}