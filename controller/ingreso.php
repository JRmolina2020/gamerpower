    <?php 
    require_once "../model/Ingreso.php";
    $ingreso=new Ingreso();

    $idingreso=isset($_POST["idingreso"])? limpiarCadena($_POST["idingreso"]):"";
    $idproveedor=isset($_POST["idproveedor"])? limpiarCadena($_POST["idproveedor"]):"";
    $fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
    $idusuario=$_SESSION["idusuario"];
    $num_comprobante=isset($_POST["num_comprobante"])? limpiarCadena($_POST["num_comprobante"]):"";
    $total_compra=isset($_POST["total_compra"])? limpiarCadena($_POST["total_compra"]):"";
    $neto=isset($_POST["total_neto"])? limpiarCadena($_POST["total_neto"]):"";
    $iva=isset($_POST["total_iva"])? limpiarCadena($_POST["total_iva"]):"";
    $total_final=isset($_POST["total_cfinal"])? limpiarCadena($_POST["total_cfinal"]):"";

    switch ($_GET["op"]){
        case 'guardaryeditar':
        if (empty($idingreso)){
            $rspta=$ingreso->insertar($idproveedor,$idusuario,$num_comprobante,$fecha_hora,$total_compra,$neto,
                $iva,$total_final,
                $_POST["idarticulo"],$_POST["cantidad"],$_POST["precio_compra"],$_POST["precio_venta"]);
            echo $rspta ? "Ingreso registrado" : "No se pudieron registrar todos los datos del ingreso";
        }
        else {
        }
        break;

        case 'anular':
        $rspta=$ingreso->anular($idingreso);
        echo $rspta ? "Ingreso anulado" : "Ingreso no se puede anular";
        break;

        case 'mostrar':
        $rspta=$ingreso->mostrar($idingreso);
        //Codificar el resultado utilizando json
        echo json_encode($rspta);
        break;

        case 'listarDetalle':
        //Recibimos el idingreso
        $id=$_GET['id'];

        $rspta = $ingreso->listarDetalle($id);
        $total=0;
        echo '<thead>


        <th>Opciones</th>
        <th>Artículo</th>
        <th>Cantidad</th>
        <th>Precio Compra</th>
        <th>Precio Venta</th>
        <th>Subtotal</th>
        </thead>';

        while ($reg = $rspta->fetch_object())
        {
            echo '<tr class="filas"><td></td><td>'.$reg->nombre.'</td><td>'.$reg->cantidad.'</td><td>'.$reg->precio_compra.'</td><td>'.$reg->precio_venta.'</td><td>'.$reg->precio_compra*$reg->cantidad.'</td></tr>';
            $total=$total+($reg->precio_compra*$reg->cantidad);
            $neto = $total;
            $ivar =$reg->iva;
            $tot =$reg->total_final;

        }
        echo '<tfoot>
         <th>
         TOTAL
        <br>
        $NETO<br>
        IVA 18%<br>
        TOTAL COMPRA</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th>
        <h5 id="total">S/.'.$total.'</h4><input type="hidden" name="total_compra" id="total_compra">
        <h5 id="neto">S/.'.$neto.'</h4><input type="hidden" name="total_neto" id="total_neto">
        <h5 id="iva">S/.'.$ivar.'</h4><input type="hidden" name="total_iva" id="total_iva">
        <h5 id="totalfinal">S/.'.$tot.'</h4><input type="hidden" name="total_cfinal" id="total_cfinal">
        </th> 
        </tfoot>';
        break;

        case 'listar':
        $rspta=$ingreso->listar();
        //Vamos a declarar un array
        $data= Array();

        while ($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>($reg->estado=='Aceptado')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idingreso.')"><i class="fa fa-eye"></i></button>'.
                ' <button class="btn btn-danger btn-xs " onclick="anular('.$reg->idingreso.')"><i class="fa fa-close"></i></button>':
                '<button class="btn btn-warning btn-xs " onclick="mostrar('.$reg->idingreso.')"><i class="fa fa-eye"></i></button>',
                "1"=>$reg->fecha,
                "2"=>$reg->proveedor.'  '.$reg->apellido,
                "3"=>$reg->usuario .' '. $reg->apellido_u,
                "4"=>$reg->num_comprobante,
                "5"=>$reg->total_compra,
                "6"=>$reg->neto,
                "7"=>$reg->iva,
                "8"=>$reg->total_final,
                "9"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':
                '<span class="label bg-red">Anulado</span>'
            );
        }
        $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
        echo json_encode($results);

        break;

        case 'selectProveedor':
        require_once "../model/Persona.php";
        $persona = new Persona();

        $rspta = $persona->listarP();

        while ($reg = $rspta->fetch_object())
        {
            echo '<option value=' . $reg->idpersona . '>' . $reg->nombre.'  ' . $reg->apellido.  '</option>';
        }
        break;

        case 'listarArticulos':
        require_once "../model/Articulo.php";
        $articulo=new Articulo();

        $rspta=$articulo->listarActivos();
        //Vamos a declarar un array
        $data= Array();

        while ($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->idarticulo.',\''.$reg->nombre.'\')"><span class="fa fa-plus"></span></button>',
                "1"=>$reg->nombre,
                "2"=>$reg->categoria,
                "3"=>$reg->codigo,
                "4"=>$reg->stock,
                "5"=>"<img src='../files/articulo/".$reg->imagen."' height='50px' width='50px' >"
            );
        }
        $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
        echo json_encode($results);
        break;
    }
    ?>