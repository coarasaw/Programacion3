<!DOCTYPE html>
<html>
<head>
    <title>TP1 - Coarasa</title>
    <meta charset="UTF-8">
    <meta name="description" content="Listas de paises filtradas">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="./estilos.css" media="screen">
</head>
<body>
<?php 
require_once "./Importacones_Requeridas.php"; 
$cl = new Paises();
$allCountries = $cl->getTodos();

// ----------------------- datos para combos ---------------------------- //
$tables = new Tables();
$regions = $tables->getRegions();
$subRegions = $tables->getSubRegions(); 
$languages = $tables->getLanguages();  
$capitals = $tables->getCapitals();   


// ----------------------- funciones ---------------------------- //
function submit(){
    document.getElementById("my-form").submit();
}
function printCountryRegiones($list){
    $message = "<ul>";
    foreach ($list as $item) {
            $message .= "<li>".$item->name."</li>";
    }
    $message .= "</ul>";
    return $message;
}

?>


<div class="container">
    <div class="row">
        <div class="col col-2">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" name="myform">
                <h2>Seleccionar</h2>

                
                <label>Por continente: </label>
                <select id="idregion" name="region" onchange="myform.submit();">
                    <option value='' >none</option><?php 
                    foreach ( $regions as $value) {
                        echo "<option value='".$value."' >".$value."</option>";
                    }?>
                </select><br>

                
                <label>Por sub región: </label>
                <select id="idsubregion" name="subregion" onchange="myform.submit();">
                    <option value='' >none</option><?php 
                    foreach ($subRegions as $value) {
                        echo "<option value='".$value."' >".$value."</option>";
                    }?>
                </select><br>


                <label>Por idioma: </label>
                <select id="idlanguage" name="language" onchange="myform.submit();">
                    <option value='' >none</option><?php 
                    foreach ($languages as $value) {
                        echo "<option value='".$value."' >".$value."</option>";
                    }?>
                </select><br>


                <label>Por capital: </label>
                <select id="idcapital" name="capital" onchange="myform.submit();">
                    <option value='' >none</option><?php 
                    foreach ($capitals as $value) {
                        echo "<option value='".$value."' >".$value."</option>";
                    }?>
                </select><br>

            </form>
        </div>  
        <div class="col col-2">
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $selectRegion = $_POST['region'];
                $selectSubregion = $_POST['subregion'];
                $selectLanguage = $_POST['language'];
                $selectCapital = $_POST['capital'];
                if (!empty($selectRegion)) {
                    echo "<h2>Busqueda por continente: </h2> <h3>$selectRegion </h3>";
                    $items = $cl->getRegion($selectRegion);
                    echo printCountryRegiones($items);
                } else if (!empty($selectSubregion)) {
                    echo "<h2>Busqueda por sub region: </h2> <h3>$selectSubregion </h3>";
                    $items = $cl->getSubRegion($selectSubregion);
                    echo printCountryRegiones($items);
                } else if (!empty($selectLanguage)) {
                    echo "<h2>Busqueda por idioma: </h2> <h3>$selectLanguage </h3>";
                    $items = $cl->getLanguages($selectLanguage);
                    echo printCountryRegiones($items);
                } else if (!empty($selectCapital)) {
                    echo "<h2>Busqueda por capital: </h2> <h3>$selectCapital </h3>";
                    $items = $cl->getCapital($selectCapital);
                    echo printCountryRegiones($items);
                } else {
                    echo "No hay resultados";
                }
            }  ?>
        </div>  
    </div><!-- row -->
</div><!-- container -->


</body>
</html>