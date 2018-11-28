<?php
require __DIR__ . "/../php/DbOperations.php";
class Generic_Tests_DatabaseTestCase extends PHPUnit_Extensions_Database_TestCase
{
    // only instantiate pdo once for test clean-up/fixture load
    static private $pdo = null;
    // only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test
    private $conn = null;
    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO( $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'] );
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_DBNAME']);
        }
        return $this->conn;
    }
		//function setUp() { echo "setup\n";$this->getConnection()->createQueryTable(NULL, "START TRANSACTION"); }
		//function tearDown() { echo "teardown\n";$this->getConnection()->createQueryTable(NULL, "ROLLBACK"); }
		// Return data set for initial DB configuration
    public function getDataSet() {
      return new PHPUnit_Extensions_Database_DataSet_YamlDataSet(
        dirname(__FILE__)."/../_files/db_fixture.yml"
      );
    }
		// Return data set for expected DB configuration
		public function getExpectedDataSet() {
			return new PHPUnit_Extensions_Database_DataSet_YamlDataSet(
				dirname(__FILE__)."/../_files/db_expected.yml"
			);
		}
		// Creates the initial dataset
    /*public function testCreateDataSet() {
      $dataSet = $this->getConnection()->createDataSet();
    }*/
		// Tests that we can create a table (as in table/chair)
    public function testCreateTable() {
			$operations = new DbOperations();
			$count = $operations->getRowCount("Mesa");
      $operations->createTable(10);
			$count++;
      $this->assertEquals($count, $this->getConnection()->getRowCount('Mesa'));
    }
		// Tests that we can add an employee
    public function testAddEmployee() {
      $operations = new DbOperations();
			$count = $operations->getRowCount("Empleado");
      $operations->addEmployee("Chris", "Mesero", 22, "Alta");
			$count++;
      $this->assertEquals($count, $this->getConnection()->getRowCount('Empleado'));
		}
		
		// Tests that we can create a new product
		public function testAddProduct() {
      $operations = new DbOperations();
			$count = $operations->getRowCount("Productos");
      $operations->addProduct("Jumex", "Bebida", 100, 101);
			$count++;
      $this->assertEquals($count, $this->getConnection()->getRowCount('Productos'));
		}
		// Tests that we can create a bill using specific table and waiter
		// Tests that the table gets properly updated
		public function testCreateBill() {
			$operations = new DbOperations();
			$mesero = $operations->getMaxId("Empleado");
			$mesa = $operations->getMaxId("Mesa");
			$this->assertTrue($operations->createBill("Ariel", $mesero, $mesa));
			$queryBill = $this->getConnection()->createQueryTable(
				'Cuenta', 'SELECT total, nombreDelCliente, estado FROM Cuenta ORDER BY idCuenta DESC LIMIT 1'
			);
			$expectedBill = $this->getExpectedDataSet()->getTable("Cuenta");
			$queryTable = $this->getConnection()->createQueryTable(
				'Mesa', 'SELECT capacidad, estado FROM Mesa ORDER BY idMesa DESC LIMIT 1'
			);
			$expectedTable = $this->getExpectedDataSet()->getTable("Mesa");
			$this->assertTablesEqual($expectedBill, $queryBill);
			$this->assertTablesEqual($expectedTable, $queryTable);
		}
		// Tests that we can add an order to previously created bill
		// Checks that total is correctly updated
		public function testAddOrder() {
			$operations = new DbOperations();
			$producto = $operations->getMaxId("Productos");
			$mesa = $operations->getMaxId("Mesa");
			$cuenta = $operations->getMaxId("Cuenta");
			$this->assertTrue($operations->addOrder($producto, $mesa, $cuenta));
			$queryTable = $this->getConnection()->createQueryTable(
				'Cuenta', 'SELECT nombreDelCliente, total, estado FROM Cuenta'
			);
			$expectedTable = $this->getExpectedDataSet()->getTable("Cuenta");
			$this->assertTablesEqual($expectedTable, $queryTable);
		}
		// Tests that we can get all the tables available with proper formatting
    public function testGetMesas() {
      $operations = new DbOperations();
      $result = "
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
										<h3 class='font-weight-medium text-right mb-0'>1</h3>
									</div>
								</div>
							</div>
							<p class=' mt-3 mb-0'>
								<i class='mdi mdi-alert-octagon mr-1' aria-hidden='true'></i>Capacidad 10			
								<a href='#' id='1' onclick='removeTable(1)' class='fa fa-trash-o'></a>
							</p>
							<button id='assignTable' name='assignModal' type='button' data-toggle='modal' data-target='#assignModal' onclick='setTableID(1)' class='btn btn-success btn-fw'>Asignar</button></div></div></div>";
      $this->expectOutputString($result);
			$operations->getMesas();
		}
		
		// Tests that we can get every active waiter
		public function testGetEmployeesForBill() {
			$operations = new DbOperations();
			$result = "
					<option value='1'>Semy</option>
					";
			$this->expectOutputString($result);
			$operations->getEmployeesForBill();
		}
		// Tests that we can get all the products properly formatted
		public function testGetProductsForBill() {
			$operations = new DbOperations();
			$result = "
					<option value='1'>dulce</option>
					";
			$this->expectOutputString($result);
			$operations->getProductsForBill();
		}
		public function testModEmployee() {
			$operations = new DbOperations();
			$id = $operations->getMaxId("Empleado");
			$this->assertTrue($operations->ModEmployee($id, "Semy Levy", "Chef", 20000, "Alta"));
			$queryTable = $this->getConnection()->createQueryTable(
				'Empleado', 'SELECT * FROM Empleado'
			);
			$expectedTable = $this->getExpectedDataSet()->getTable("Empleado");
			$this->assertTablesEqual($expectedTable, $queryTable);
		}
		public function testDeleteOrder() {
			$operations = new DbOperations();
			$id = $operations->getMaxId("Orden");
			$count = $operations->getRowCount("Orden");
			$operations->genericDelete($id, "Orden");
			$count--;
      $this->assertEquals($count, $this->getConnection()->getRowCount('Orden'));
		}
		public function testDeleteBill() {
			$operations = new DbOperations();
			$id = $operations->getMaxId("Cuenta");
			$count = $operations->getRowCount("Cuenta");
			$operations->genericDelete($id, "Cuenta");
			$count--;
      $this->assertEquals($count, $this->getConnection()->getRowCount('Cuenta'));
		}
		
		// Tests that we can delete a table (previously created)
		public function testDeleteTable() {
      $operations = new DbOperations();
			$id = $operations->getMaxId("Mesa");
			$count = $operations->getRowCount("Mesa");
			$operations->deleteTable($id);
			$count--;
      $this->assertEquals($count, $this->getConnection()->getRowCount('Mesa'));
    }
		// Tests that we can delete such employee ^^^
		public function testGenericDeleteEmployee() {
      $operations = new DbOperations();
			$id = $operations->getMaxId("Empleado");
			$count = $operations->getRowCount("Empleado");
			$operations->genericDelete($id, "Empleado");
			$count--;
      $this->assertEquals($count, $this->getConnection()->getRowCount('Empleado'));
		}
		// Tests that we can delete a product using generic delete
		public function testGenericDeleteProduct() {
      $operations = new DbOperations();
			$id = $operations->getMaxId("Productos");
			$count = $operations->getRowCount("Productos");
			$operations->genericDelete($id, "Productos");
			$count--;
      $this->assertEquals($count, $this->getConnection()->getRowCount('Productos'));
    }
}
?>