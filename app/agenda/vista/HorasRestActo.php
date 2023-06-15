<?php
include_once("../../../lib/seguridad.php");
include_once("../../../lib/components.php");



class ConexionOracle
{
    private $server = "186.10.119.218/PDBPNLNPRoD.stacks.cl";
    private $user = "APWEB_INT";
    private $pass = "Ev6RMao95#_";
    private $dataBase = "OMI_PRO_CLOUD";
    private $conect = null;

    public function getServer()
    {
        return $this->server;
    }

    public function setServer($server)
    {
        $this->server = $server;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    public function getDataBase()
    {
        return $this->dataBase;
    }

    public function setDataBase($dataBase)
    {
        $this->dataBase = $dataBase;
    }

    public function getConect()
    {
        return $this->conect;
    }

    public function setConect($conect)
    {
        $this->conect = $conect;
    }

    public function ConectarOracle()
    {
        $this->setConect(oci_connect($this->getUser(), $this->getPass(), $this->getServer()));

        if ($this->getConect()) {
            return $this->getConect();
        } else {
            return "No se pudo conectar";
        }
    }

    public function Desconectar()
    {
        oci_close($this->getConect());
        return "Se ha desconectado";
    }
}

$conexion = new ConexionOracle();
$connection = $conexion->ConectarOracle();

$desde = isset($_POST['desde']) ? $_POST['desde'] : '';
$hasta = isset($_POST['hasta']) ? $_POST['hasta'] : '';

$sector = isset($_POST['sector']) ? $_POST['sector'] : '';

if (empty($desde)) {
    $desde = date('d/m/Y');
}
if (empty($hasta)) {
    $hasta = date('d/m/Y');
}

$query1 = "SELECT 
    TRUNC(CIT.FECHAHORA) AS \"FECHA\",
    CEN_ID_NOMBRE(AGE.CEN_ID) AS \"CENTRO\",
    AGE.DESCRIPCION AS \"AGENDA\",
    COUNT(*) AS \"TOTAL_CUPOS\",
    NVL(
        (SELECT COUNT(*)
         FROM AGE_AGENDAS AGE1 JOIN AGE_CITAS CIT1 ON AGE1.AGE_ID = CIT1.AGE_ID
         WHERE TRUNC(CIT1.FECHAHORA) = TRUNC(CIT.FECHAHORA) AND AGE1.CEN_ID = AGE.CEN_ID AND AGE1.DESCRIPCION = AGE.DESCRIPCION
         AND CIT1.PAC_ID IS NOT NULL), 0) AS \"TOTAL_UTILIZADOS\",
    NVL(
        (SELECT COUNT(*)
         FROM AGE_AGENDAS AGE1 JOIN AGE_CITAS CIT1 ON AGE1.AGE_ID = CIT1.AGE_ID
         WHERE TRUNC(CIT1.FECHAHORA) = TRUNC(CIT.FECHAHORA) AND AGE1.CEN_ID = AGE.CEN_ID AND AGE1.DESCRIPCION = AGE.DESCRIPCION
         AND CIT1.PAC_ID IS NULL), 0) AS \"TOTAL_DISPONIBLES\"
FROM
    AGE_AGENDAS AGE JOIN AGE_CITAS CIT ON AGE.AGE_ID = CIT.AGE_ID
WHERE 
    TRUNC(CIT.FECHAHORA) BETWEEN TO_DATE(:desde, 'DD/MM/YYYY') AND TO_DATE(:hasta, 'DD/MM/YYYY')";

$query2 = "SELECT 
    TRUNC(CIT.FECHAHORA) AS \"FECHA\",
    CEN_ID_NOMBRE(AGE.CEN_ID) AS \"CENTRO\",
    ACT.DESCRIPCION AS \"ACTO\",
    COUNT(*) AS \"TOTAL_CUPOS\",
    NVL(
        (SELECT COUNT(*)
         FROM AGE_AGENDAS AGE1 JOIN AGE_CITAS CIT1 ON AGE1.AGE_ID = CIT1.AGE_ID JOIN AGE_ACTOS ACT1 ON CIT1.ACT_ID = ACT1.ACT_ID
         WHERE TRUNC(CIT1.FECHAHORA) = TRUNC(CIT.FECHAHORA) AND AGE1.CEN_ID = AGE.CEN_ID AND ACT1.DESCRIPCION = ACT.DESCRIPCION
         AND CIT1.PAC_ID IS NOT NULL), 0) AS \"TOTAL_UTILIZADOS\",
    NVL(
        (SELECT COUNT(*)
         FROM AGE_AGENDAS AGE1 JOIN AGE_CITAS CIT1 ON AGE1.AGE_ID = CIT1.AGE_ID JOIN AGE_ACTOS ACT1 ON CIT1.ACT_ID = ACT1.ACT_ID
         WHERE TRUNC(CIT1.FECHAHORA) = TRUNC(CIT.FECHAHORA) AND AGE1.CEN_ID = AGE.CEN_ID AND ACT1.DESCRIPCION = ACT.DESCRIPCION
         AND CIT1.PAC_ID IS NULL), 0) AS \"TOTAL_DISPONIBLES\"
FROM
    AGE_AGENDAS AGE JOIN AGE_CITAS CIT ON AGE.AGE_ID = CIT.AGE_ID JOIN AGE_ACTOS ACT ON CIT.ACT_ID = ACT.ACT_ID
WHERE 
    TRUNC(CIT.FECHAHORA) BETWEEN TO_DATE(:desde, 'DD/MM/YYYY') AND TO_DATE(:hasta, 'DD/MM/YYYY')";

if (!empty($sector)) {
    $query1 .= " AND AGE.CEN_ID = :sector";
    $query2 .= " AND AGE.CEN_ID = :sector";
}

$query1 .= " GROUP BY TRUNC(CIT.FECHAHORA), AGE.CEN_ID, AGE.DESCRIPCION";
$query2 .= " GROUP BY TRUNC(CIT.FECHAHORA), AGE.CEN_ID, ACT.DESCRIPCION";

$statement1 = oci_parse($connection, $query1);
$statement2 = oci_parse($connection, $query2);

oci_bind_by_name($statement1, ":desde", $desde);
oci_bind_by_name($statement1, ":hasta", $hasta);

oci_bind_by_name($statement2, ":desde", $desde);
oci_bind_by_name($statement2, ":hasta", $hasta);

if (!empty($sector)) {
    oci_bind_by_name($statement1, ":sector", $sector);
    oci_bind_by_name($statement2, ":sector", $sector);
}

oci_execute($statement1);
oci_execute($statement2);

while (($row1 = oci_fetch_assoc($statement1)) !== false) {

    $fecha = $row1['FECHA'];
    $centro = $row1['CENTRO'];
    $agenda = $row1['AGENDA'];
    $totalCupos = $row1['TOTAL_CUPOS'];
    $totalUtilizados = $row1['TOTAL_UTILIZADOS'];
    $totalDisponibles = $row1['TOTAL_DISPONIBLES'];

}

while (($row2 = oci_fetch_assoc($statement2)) !== false) {

    $fecha = $row2['FECHA'];
    $centro = $row2['CENTRO'];
    $acto = $row2['ACTO'];
    $totalCupos = $row2['TOTAL_CUPOS'];
    $totalUtilizados = $row2['TOTAL_UTILIZADOS'];
    $totalDisponibles = $row2['TOTAL_DISPONIBLES'];
}

oci_free_statement($statement1);
oci_free_statement($statement2);





?>

<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Citas</title>
    <meta charset="UTF-8">
</head>

<body>

    <script type="text/javascript">
        function ver(cual) {
            var tester = document.getElementById(cual);
            tester.style.display = 'block';
        }

        function ciego(cual) {
            var tester = document.getElementById(cual);
            tester.style.display = 'none';
        }
    </script>
    <form method="post" style="margin-top: auto;">
        <label for="desde">Desde:</label>
        <input type="text" id="desde" name="desde" value="<?php echo $desde; ?>">
        <label for="hasta">Hasta:</label>
        <input type="text" id="hasta" name="hasta" value="<?php echo $hasta; ?>">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <label class="control-label col-md-1">Centro :</label>
                    <label class="radio-inline" style="margin-right: 7px !important;">
                        <input name="sector" type="radio" value="0" <?= ($sector == '0') ? 'checked' : '' ?>>
                        <span style="font-size: 14px;">Todos</span>
                    </label>

                    <label class="radio-inline">
                        <input name="sector" type="radio" value="3" <?= ($sector == '3') ? 'checked' : '' ?>>
                        <span style="font-size: 14px;">S.L</span>
                    </label>

                    <label class="radio-inline">
                        <input name="sector" type="radio" value="1" <?= ($sector == '1') ? 'checked' : '' ?>>
                        <span style="font-size: 14px;">C.U</span>
                    </label>

                    <label class="radio-inline">
                        <input name="sector" type="radio" value="2" <?= ($sector == '2') ? 'checked' : '' ?>>
                        <span style="font-size: 14px;">L.F</span>
                    </label>

                    <label class="radio-inline">
                        <input name="sector" type="radio" value="4" <?= ($sector == '4') ? 'checked' : '' ?>>
                        <span style="font-size: 14px;">L.H</span>
                    </label>

                    <label class="radio-inline">
                        <input name="sector" type="radio" value="5" <?= ($sector == '5') ? 'checked' : '' ?>>
                        <span style="font-size: 14px;">C.S.H</span>
                    </label>

                    <label class="radio-inline">
                        <input name="sector" type="radio" value="12" <?= ($sector == '12') ? 'checked' : '' ?>>
                        <span style="font-size: 14px;">P.G.W</span>
                    </label>
                    <label class="radio-inline">
                        <input name="sector" type="radio" value="6" <?= ($sector == '6') ? 'checked' : '' ?>>
                        <span style="font-size: 14px;">COSAM</span>
                    </label>

                    <label class="radio-inline">
                        <input name="sector" type="radio" value="13" <?= ($sector == '13') ? 'checked' : '' ?>>
                        <span style="font-size: 14px;">L.T </span>
                    </label>
                </div>
                <label class="control-label col-md-1">Orden :</label>



                <label class="radio-inline">
                    <p><a href="HorasRest.php" target="iframe_a">CENTRO</a></p>
                </label>


            </div>
        </div>

        <input type="submit" value="Filtrar">
    </form>

    <table id="tabla1" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Centro</th>
                <th>Agenda</th>
                <th>Total Cupos</th>
                <th>Total Utilizados</th>
                <th>Total Disponibles</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row1 = oci_fetch_array($statement1, OCI_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row1['FECHA'] . "</td>";
                echo "<td>" . $row1['CENTRO'] . "</td>";
                echo "<td>" . $row1['AGENDA'] . "</td>";
                echo "<td>" . $row1['TOTAL_CUPOS'] . "</td>";
                echo "<td>" . $row1['TOTAL_UTILIZADOS'] . "</td>";
                echo "<td>" . $row1['TOTAL_DISPONIBLES'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Resultados Consulta 2</h2>
    <table id="tabla2" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Centro</th>
                <th>Acto</th>
                <th>Total Cupos</th>
                <th>Total Utilizados</th>
                <th>Total Disponibles</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row2 = oci_fetch_array($statement2, OCI_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row2['FECHA'] . "</td>";
                echo "<td>" . $row2['CENTRO'] . "</td>";
                echo "<td>" . $row2['ACTO'] . "</td>";
                echo "<td>" . $row2['TOTAL_CUPOS'] . "</td>";
                echo "<td>" . $row2['TOTAL_UTILIZADOS'] . "</td>";
                echo "<td>" . $row2['TOTAL_DISPONIBLES'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
    $conexion->Desconectar();
    ?>
</body>

</html>