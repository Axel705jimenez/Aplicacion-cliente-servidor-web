<!DOCTYPE html>
<html>
<title>Expenses</title>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link href="estilo.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="../diseñoTabla.css" rel="stylesheet">
</head>
<style>

.button-container {
    display: flex;
    gap: 5px;
}

.button-containerr {
    display: flex;
    justify-content: center;
    gap: 15px; /* Espacio entre los botones */
}

.export-button {
    margin-top: 100px;
}
</style>
<body>
<h1>Table Expenses</h1>
<div>
<?php
    require_once('../config.inc.php');

    $conn = new mysqli($servername, $username, $password, $dbname);
    $consulta = "SELECT expenses.*, expensetype.description AS nombregasto
    FROM expenses
    JOIN expenseType ON expenses.idExpenseType = ExpenseType.idExpenseType";

    $datos = $conn->query($consulta);

    echo "<table class='table table-striped table-dark'>";
    echo 
    "
    <th scope='col'>Expense Date</th>
    <th scope='col'>Amount</th>
    <th scope='col'>Expense Name</th>
    <th scope='col'>Expense Description</th>
    <th scope='col'>
    </th>";

    while ($registro = $datos->fetch_assoc())
    {
        echo "<tr>";
        echo "<td class='table-secondary'>".$registro["expenseDate"]."</td>";
        echo "<td class='table-secondary'>".$registro["amount"]."</td>";
        echo "<td class='table-secondary'>".$registro["expenseDescription"]."</td>";
        echo "<td class='table-secondary'>".$registro["nombregasto"]."</td>";
        echo "<td class='table-secondary'>

        <div class='button-container'>
        <form action='EliminarExpenses.php' method='post' onsubmit=\"return confirm('¿Estás seguro de que deseas eliminar esta Expenses?')\">
            <input type='hidden' name='idExpenses' value='".$registro["idExpenses"]."'>
            <button class='btn btn-danger' type='submit' name='eliminar_".$registro["idExpenses"]."'><i class='fas fa-trash-alt'></i> </button>        </form>
        <form action='ActualizarExpenses.php' method='post'>
            <input type='hidden' name='idExpenses' value='".$registro["idExpenses"]."'>
            <button class='btn btn-warning' type='submit' name='modificar_".$registro["idExpenses"]."'><i class='fas fa-edit'></i> </button>        </form>
        </div>
    
        </td>";
        echo "<td class='table-secondary'></td>";
        echo "<tr/>";
        echo "</div>";
    }

    echo "</table>";
    $conn->close();
?>

<div class="button-containerr">
  <form action="RegistrarExpenses.php" method="get">
    <input class="btn btn-primary" type="submit" value="Insertar">
  </form>
  <form action="../menu/menu.html" method="post" class="export-button">
    <input class="btn btn-primary" type="submit" value="Regresar al menú">
  </form>
  <!--
<form action="pdf.php" method="post" class="export-button">
  <input class="btn btn-danger" type="submit" value="Exportar PDF">
</form>

<form action="excel.php" method="post" class="export-button">
  <input class="btn btn-success" type="submit" value="Exportar Excel">
</form>

<form action="xml.php" method="post" class="export-button">
  <input class="btn btn-warning" type="submit" value="Exportar XML">
</form>

<form action="json.php" method="post" class="export-button">
  <input class="btn btn-info" type="submit" value="Exportar JSON">
</form>
-->
</div>
</body>
</html>