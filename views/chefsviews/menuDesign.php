
<?php
include "../../components/header.php";
include "../../API/getRecipe.php";
include '../../helpers/cURL.php';
include "../../components/meals.php";
if(!isset($_SESSION['user']) && ($_SESSION['user']['rol'] != 'Chef')){
    header("Location:../../");
}
// Se llenan las categorias
$get_data = callAPI('GET', 'https://www.themealdb.com/api/json/v1/1/categories.php', false);
$categories = json_decode($get_data, true);
$meals = ["Beef", "Chicken", "Seafood", "Dessert", "Starter", "Breakfast"];

if (isset($_GET['category'])) {
    $getMeals = callAPI('GET', 'https://www.themealdb.com/api/json/v1/1/filter.php?c=' . $_GET['category'], false);
    $showCategoryMeals = json_decode($getMeals, true);
} else {
    $showCategoryMeals = null;
}
?>

<div class="container mt-4">
    <div class="row">
        <!-- Este formulario permite elegir la categoria -->
        <aside class="col-3 bg-light   ">
            <h1>Diseña el menú</h1>
             <hr>
            <Label for="f_inicial">Fecha Inicial:</Label>
            <input type="date" name="f_inicial" id="f_inicial" onchange="limitSundays()">
            <div class = "seleccionados"></div>
            <div class="row  text-center">
            <button type="button" class=" col-6 btn btn-success btn-guardar-menu mx-auto" id="btn-guardar-menu"  >Guardar Menú</button>
            </div>
        </aside>

        <main class="col-9">
            <div class="row justify-content-center">
                <form class="col-lg-10 col-md-10 col-sm-12" action="menuDesign.php" method="get">
                    <div class="row">

                        <label class="col-lg-2" for="categorie">Selecciona una categoría</label>
                        <select id="categorie" name="category" class="col-lg-6 m-2">
                            <?php foreach ($categories["categories"] as $categorie) : ?>
                                <?php if (in_array($categorie["strCategory"], $meals)) : ?>
                                    <option value="<?= $categorie["strCategory"] ?>" <?php
                                                                                    if (isset($_GET['category']) && $_GET['category'] == $categorie["strCategory"]) {
                                                                                        echo "selected";
                                                                                    }
                                                                                    ?>>
                                        <?= $categorie["strCategory"] ?>
                                    </option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                        <input class="col-lg-2 btn btn-success" type="submit" value="Cargar Categoría">
                    </div>
                </form>

                <!-- Aquí se muestran los platillos de acuerdo a la categoría seleccionada -->
                <?php if ($showCategoryMeals != null) : ?>
                    <div class="col-12 mt-4">
                        <div class="row row-cols-12 row-cols-md-3 g-4 justify-content-center">
                            <?php foreach ($showCategoryMeals["meals"] as $meal) : ?>
                                <!-- Se llenan las card con los alimentos encontrados -->
                                <?php mostrarAlimento($meal["idMeal"], $meal["strMeal"], $meal["strMealThumb"]); ?>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </main>
    </div>
</div>

<!-- Generación de modales por cada alimento mostrado -->
<?php if ($showCategoryMeals != null) : ?>
    <?php foreach ($showCategoryMeals["meals"] as $meal) : ?>
        
        <div class="modal fade" id="myModal<?=$meal["idMeal"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row  ">
                    <h5 class="modal-title" id="exampleModalLabel"><?= $meal["strMeal"] ?></h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3 d-flex align-items-center">
                        <!-- imagen de la receta -->
                        
                        <img src=<?= $meal["strMealThumb"] ?> class="card-img-top pt-2" alt="Thumbnail">
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-6  ">
                                <p class="m-categorie"> </p>   
                                <p class="m-area"></p>
                                <p class="m-tags"></p>
                               
                            </div>
                            <div class="col-6  2">
                                <p class="m-youtube"></p>
                                <p class="m-source"></p>
                                 
                            </div>
                        </div>
                       
                    </div>
                </div>
                <div class="row mt-2 modal-instrucciones"></div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-save">Agregar a Menú Semanal</button> 
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

    <?php endforeach ?>
<?php endif ?>
<script>
function limitarADomingos() {
    // Obtener el valor seleccionado en el campo de fecha
    var fechaSeleccionada = document.getElementById("fecha").value;

    // Convertir la fecha seleccionada a un objeto Date
    var fecha = new Date(fechaSeleccionada);

    // Verificar si la fecha seleccionada es un domingo (día de la semana 0)
    if (fecha.getDay() !== 0) {
        alert("Por favor, selecciona un domingo.");
        // Restablecer el valor del campo de fecha
        document.getElementById("fecha").value = '';
    }
}
</script>
<script src="../../js/modalSupport.js"></script>
<script src="../../js/listaRecetas.js"></script>
<!-- jQuery (debe estar antes de Bootstrap JavaScript) -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Bootstrap JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<?php
include "../../components/footer.php";
?>
