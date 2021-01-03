<?php
    function filtrado($datos){
        $datos = trim($datos); // Elimina espacios antes y después de los datos
        $datos = stripslashes($datos); // Elimina backslashes \
        $datos = htmlspecialchars($datos); // Traduce caracteres especiales en entidades HTML
        return $datos;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Panel Admin</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <meta charset="utf-8">
    </head>
    <body>
        <header>
            <div class="container">
                <h1>UnirShopping</h1>
                <h2>Administración<h2>
            </div>
        </header>
        <div class="container">
        <?php if (isset($strResult) && $strResult != '') {echo "<div class=\"alert alert-info\">$strResult</div>";}?>
        <br>
        <h1>Panel Administrador</h1> <br><br>
        <h1>Productos existentes</h1> <br>
        <div>
            <table class="table">
                <thead class="thead-dark">
                    <td><h4>ID PRODUCTO</h4></td>
                    <td><h4>NOMBRE<h4></td>
                    <td><h4><h4></td>
                </thead>
                <tbody>
                    <?php
                        foreach ($result as $product)
                    //while($fila = mysqli_fetch_array($result))
                    {
                    ?>
                                <tr>
                                    <td><?php echo filtrado($product->getId());?></td>
                                    <td><?php echo filtrado($product->getNombre());?></td>
                                    <td><a href="index.php?controlador=ControladorAdmin&accion=delete&args=<?php echo $product->getId();?>">Eliminar producto</a></td>                                    
                                </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

            <br><br>
            <h1>Añadir nuevo producto</h1>
                <form action="index.php?controlador=ControladorAdmin&&accion=subir" class="formulario" id="formulario" name="formulario" method="POST">

                    <div class="form-group">
                        <h4><label for="exampleFormControlInput1">Tipo de producto</label></h4>
                        <input type="text" class="form-control" id="productname" name="nombre" placeholder="Ex: Pantalón" required>
                    </div>

                    <div class="form-group">
                        <h4><label for="exampleFormControlInput1">Descripción del producto</label></h4>
                        <textarea class="form-control" id="description"  name="descripcion" placeholder="Ex: Pantalón última tendencia para moda 2021" rows="2" required></textarea>
                    </div>

                    <div class="form-group">
                        <h4><label for="exampleFormControlInput1">Selecciona las tallas disponibles si la prenda tiene tallas numéricas</label></h4>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox"  name="tallasnum[]" value="38">
                        <label class="form-check-label" for="inlineCheckbox1" >38</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tallasnum[]" value="40">
                        <label class="form-check-label" for="inlineCheckbox2" >40</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tallasnum[]" value="42">
                        <label class="form-check-label" for="inlineCheckbox2" >42</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox"  name="tallasnum[]" value="44">
                        <label class="form-check-label" for="inlineCheckbox2" >44</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tallasnum[]"  value="48">
                        <label class="form-check-label" for="inlineCheckbox2">48</label>
                    </div>
                    <br><br><br>

                    <div class="form-group">
                        <h4><label for="exampleFormControlInput1">Selecciona las tallas disponibles si la prenda tiene tallas NO numéricas</label></h4>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tallasnum[]" value="XS">
                        <label class="form-check-label" for="inlineCheckbox1">XS</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tallasnum[]" value="S">
                        <label class="form-check-label" for="inlineCheckbox2">S</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tallasnum[]" value="M">
                        <label class="form-check-label" for="inlineCheckbox2">M</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tallasnum[]"  value="L">
                        <label class="form-check-label" for="inlineCheckbox2">L</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="tallasnum[]"  value="XL">
                        <label class="form-check-label" for="inlineCheckbox2">XL</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox"  name="tallasnum[]" value="XXL">
                        <label class="form-check-label" for="inlineCheckbox2">XXL</label>
                    </div>

                    <br><br><br>

                    <div class="form-group">
                        <h4><label for="exampleFormControlInput1">Colores disponibles</label></h4>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="colores[]" value="azul">
                        <label class="form-check-label" for="inlineCheckbox1">azul</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="colores[]"  value="azul claro">
                        <label class="form-check-label" for="inlineCheckbox2">azul claro</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="colores[]"  value="azul oscuro">
                        <label class="form-check-label" for="inlineCheckbox2">azul oscuro</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="colores[]"  value="negro">
                        <label class="form-check-label" for="inlineCheckbox2">negro</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="colores[]"  value="gris">
                        <label class="form-check-label" for="inlineCheckbox2">gris</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="colores[]"  value="rojo">
                        <label class="form-check-label" for="inlineCheckbox2">rojo</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="colores[]"  value="verde">
                        <label class="form-check-label" for="inlineCheckbox2">verde</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="colores[]"  value="amarillo">
                        <label class="form-check-label" for="inlineCheckbox2">amarillo</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="colores[]"  value="granate">
                        <label class="form-check-label" for="inlineCheckbox2">granate</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="colores[]"  value="otros">
                        <label class="form-check-label" for="inlineCheckbox2">otros</label>
                    </div>

                    <br><br><br>

                    <div class="form-group">
                        <h4><label for="exampleFormControlInput1">Imagen del Producto</label></h4>
                    </div>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="validatedCustomFile" name="image" required>
                        <label class="custom-file-label" for="validatedCustomFile">Choose an image :)</label>
                        <div class="invalid-feedback">Invalid</div>
                    </div>
                    <br><br>
                    <button type="submit" class="btn btn-primary" name="subir">subir</button>
                </form>

        </div>    

    </body>
</html>

