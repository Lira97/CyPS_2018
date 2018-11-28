
function addTable(){
  var capacidad = $('#capacidad').val();
  $.ajax({
            type:'POST',
            url:'php/functions.php',
            data: {function2call: 'addTable', capacidad:capacidad},
            success:function(msg){
              if(msg == 'err'){
                alert('La mesa no se pudo agregar');
              }else{
                alert("La mesa se agrego correctamente");
                location.reload();
              }

            }
    })
}

function removeTable(x){
  $.ajax({
            type:'POST',
            url:'php/functions.php',
            data: {function2call: 'removeTable', mesa:x},
            success:function(msg){
              if(msg == 'err'){
                alert('La mesa no se pudo eliminar');
              }else{
                alert("La mesa elimino");
                location.reload();
              }
            }
    })
}

function addEmployeeFunction(){
    var options = document.getElementById('options').value;
    var e = document.getElementById("typeSelect");
    var tipo = e.options[e.selectedIndex].value;
    var estado;
    if (document.getElementById('act').checked) {
  	estado = document.getElementById('act').value;
  }
    if (document.getElementById('baj').checked) {
    estado = document.getElementById('baj').value;
  }

  var nombre = $('#nombre').val();
  var sueldo = $('#sueldo').val();
  if($('#nombre').val() == '' || $('#sueldo').val() == ''){
    alert("Por favor llene todos los campos")
  }else{
    $.ajax({
              type:'POST',
              url:'php/functions.php',
              data: {function2call: 'addEmployee', nombre:nombre, tipo:tipo,sueldo:sueldo,estado:estado},
              success:function(msg){

                if(msg == 'err'){
                  alert('No se pudo agregar al Empleado');
                }else{
                  alert("Se agrego al Empleado");
                  location.reload();
                }
              }
      })
  }



}

function modFiller(id){
  var idElement = document.getElementById('id');
  var nameElement = document.getElementById('na');
  // var typeElement = document.getElementById('ty');
  var sueldoElement = document.getElementById('su');


  if(id["estado"] == 'Alta'){
    document.getElementById('act1').checked = true;
  }else{
    document.getElementById('baj1').checked = true;
  }
  var stateElement = document.getElementById('st');
  idElement.value = id["id"];
  nameElement.value = id["nombre"];
  // typeElement.value = id["tipo"];
  sueldoElement.value = id["sueldo"];
  if(id["tipo"] == "Mesero"){
    document.getElementById("typeSelect1").selectedIndex = "0";
  }else{
    document.getElementById("typeSelect1").selectedIndex = "1";
  }
}


function modifyEmployeeFunction() {
  var options = document.getElementById('options1').value;
  var estado;
  var e = document.getElementById("typeSelect1");
  var tipo = e.options[e.selectedIndex].value;
  if (document.getElementById('act1').checked) {
	estado = document.getElementById('act1').value;
}
  if (document.getElementById('baj1').checked) {
  estado = document.getElementById('baj1').value;
}
  var id = $('#id').val();
  var nombre = $('#na').val();
  var sueldo = $('#su').val();
  if(nombre == '' || sueldo == ''){
    alert("Por favor llene todos los campos")
  }else{
    $.ajax({
              type:'POST',
              url:'php/functions.php',
              data: {function2call: 'modEmployee', nombre:nombre, tipo:tipo,sueldo:sueldo,estado:estado,id:id},
              success:function(msg){

                if(msg == 'err'){
                  alert('No se pudo modificar al Empleado');
                }else{
                  alert("Se modifico al Empleado");
                  location.reload();
                }
              }
      })
  }

}

function removeEmployeeFunction(id){
  $.ajax({
            type:'POST',
            url:'php/functions.php',
            data: {function2call: 'removeEmployee', id:id},
            success:function(msg){
              if(msg == 'err'){
                alert('El empleado no se pudo eliminar');
              }else{
                alert("El empleado se elimino");
                location.reload();
              }
            }
    })
}

function removeProductFunction(id){
  $.ajax({
            type:'POST',
            url:'php/functions.php',
            data: {function2call: 'removeProduct', id:id},
            success:function(msg){
              if(msg == 'err'){
                alert('El producto no se pudo eliminar');
              }else{
                alert("El producto se elimino");
                location.reload();
              }
            }
    })
}

function setTableID(id) {
  var idElement = document.getElementById('tableID');
  idElement.value = id;
}

function setOrderData(id) {
  document.getElementById('tableID').value = id["mesa"];
  document.getElementById('billID').value = id["cuenta"];
}

function assignTableToBill() {
  var e = document.getElementById("empleadosSelect");
  var mesero = e.options[e.selectedIndex].value;
  var nombre = $('#clientName').val();
  var mesa = $('#tableID').val();
  if(nombre == ''){
    alert("Por favor introduzca el nombre del cliente")
  }else{
    $.ajax({
              type:'POST',
              url:'php/functions.php',
              data: {function2call: 'createBill', nombre:nombre, mesero:mesero, mesa:mesa},
              success:function(msg){
                if(msg == 'err'){
                  alert('No se pudo asignar la mesa');
                }else{
                  alert("La mesa se asigno");
                  location.reload();
                }
              }
      })
  }

}

  function addProductFunction(){
    var e = document.getElementById("tipoSelect");
    var tipo = e.options[e.selectedIndex].value;
    var nombre = $('#nombreDelProducto').val();
    var costo = $('#costoDelProducto').val();
    var precio = $('#precioDelProducto').val();

    if(nombre == '' || costo == '' || precio == ''){
      alert("Por favor introduzca todos los campos")
    }else{
      $.ajax({
                type:'POST',
                url:'php/functions.php',
                data: {function2call: 'addProduct', nombre:nombre, costo:costo, precio:precio, tipo:tipo},
                success:function(msg){
                  if(msg == 'err'){
                    alert('No se pudo agregar el producto');
                  }else{
                    alert("El producto se asigno");
                    location.reload();
                  }
                }
        })
    }

  }

  function addOrderFunction(){
    var e = document.getElementById('productSelect');
    var producto = e.options[e.selectedIndex].value;

    var mesa = $('#tableID').val();
    var cuenta = $('#billID').val();

    $.ajax({
              type:'POST',
              url:'php/functions.php',
              data: {function2call: 'addOrder', producto:producto, mesa:mesa, cuenta:cuenta},
              success:function(msg){
                if(msg == 'err'){
                  alert('No se pudo crear la orden');
                }else{
                  alert("Se creo la orden");
                  location.reload();
                }
              }
      })

  }

  function productModFiller(id){
    document.getElementById('idDelProducto1').value = id["id"];
    document.getElementById('nombreDelProducto1').value = id["nombre"];
    document.getElementById('costoDelProducto1').value = id["costo"];
    document.getElementById('precioDelProducto1').value = id["precio"];
    document.getElementById("tipoSelectMod1").selectedIndex = "PlatoFuerte";
    if(id["tipo"] == 'Bebida'){
      document.getElementById("tipoSelectMod1").selectedIndex = "0";
    }
    if(id["tipo"] == 'Postre'){
      document.getElementById("tipoSelectMod1").selectedIndex = "1";
    }
    if(id["tipo"] == 'PlatoFuerte'){
      document.getElementById("tipoSelectMod1").selectedIndex = "2";
    }
    if(id["tipo"] == 'Entradas'){
      document.getElementById("tipoSelectMod1").selectedIndex = "3";
    }



  }

  function modifyProductFunction() {
    var e = document.getElementById("tipoSelectMod1");
    var tipo = e.options[e.selectedIndex].value;
    var id = $('#idDelProducto1').val();
    var nombre = $('#nombreDelProducto1').val();
    var costo = $('#costoDelProducto1').val();
    var precio = $('#precioDelProducto1').val();

    if(nombre == '' || costo == '' || precio == ''){
      alert("Por favor introduzca todos los campos")
    }else{
      $.ajax({
                type:'POST',
                url:'php/functions.php',
                data: {function2call: 'modProduct', nombre:nombre, costo:costo, precio:precio, tipo:tipo, id:id},
                success:function(msg){
                  if(msg == 'err'){
                    alert("No se modifico el producto");
                  }else{
                      alert('Se modifico el producto');
                    location.reload();
                  }
                }
        })
    }

  }

  function payBillFunction(cuenta){
    $.ajax({
              type:'POST',
              url:'php/functions.php',
              data: {function2call: 'payBill', cuenta:cuenta},
              success:function(msg){
                if(msg == 'err'){
                  alert('La Cuenta no se pudo pagar');
                }else{
                  alert("La Cuenta se pago");
                  location.reload();
                }
              }
      })
  }

  function deliverOrderFunction(orden){
    var op = 'U';
    $.ajax({
              type:'POST',
              url:'php/functions.php',
              data: {function2call: 'orderOperations', orden:orden, operacion:op},
              success:function(msg){
                if(msg == 'err'){
                  alert('Ocurrio un error');
                }else{
                  alert("Se entrego la orden" + msg);
                  location.reload();
                }
              }
      })
  }

  function cancelOrderFunction(orden){
    var op = 'D';
    $.ajax({
              type:'POST',
              url:'php/functions.php',
              data: {function2call: 'orderOperations', orden:orden, operacion:op},
              success:function(msg){
                if(msg == 'err'){
                  alert('Ocurrio un error');
                }else{
                  alert("Se Cancelo la orden ");
                  location.reload();
                }
              }
      })
  }
