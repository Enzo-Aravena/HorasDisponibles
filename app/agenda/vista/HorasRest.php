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



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sector = isset($_POST['sector']) ? $_POST['sector'] : '';

    if ($sector != '' && $sector != '0') {
        $query1 .= " AND AGE.CEN_ID = :cen_id";
        $sector = intval($sector); // Convertir a entero
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sector = isset($_POST['sector']) ? $_POST['sector'] : '';

    if ($sector != '' && $sector != '0') {
        $query2 .= " AND AGE.CEN_ID = :cen_id";
        $sector = intval($sector); // Convertir a entero
    }
}

$query1 .= " GROUP BY TRUNC(CIT.FECHAHORA), AGE.CEN_ID, AGE.DESCRIPCION ORDER BY FECHA";
$query2 .= " GROUP BY TRUNC(CIT.FECHAHORA), AGE.CEN_ID, ACT.DESCRIPCION ORDER BY FECHA";




$statement1 = oci_parse($connection, $query1);
if ($statement1 === false) {
    $error = oci_error($connection);
    die("Error en la consulta: " . $error['message']);
}

oci_bind_by_name($statement1, ':desde', $desde, null, SQLT_CHR);
oci_bind_by_name($statement1, ':hasta', $hasta, null, SQLT_CHR);
$desde = date('d-m-Y', strtotime(str_replace('/', '-', $desde)));
$hasta = date('d-m-Y', strtotime(str_replace('/', '-', $hasta)));

if ($sector != '' && $sector != '0') {
    oci_bind_by_name($statement1, ':cen_id', $sector);
}


$statement2 = oci_parse($connection, $query2);
if ($statement2 === false) {
    $error = oci_error($connection);
    die("Error en la consulta: " . $error['message']);
}

oci_bind_by_name($statement2, ':desde', $desde, null, SQLT_CHR);
oci_bind_by_name($statement2, ':hasta', $hasta, null, SQLT_CHR);
$desde = date('d-m-Y', strtotime(str_replace('/', '-', $desde)));
$hasta = date('d-m-Y', strtotime(str_replace('/', '-', $hasta)));

if ($sector != '' && $sector != '0') {
    oci_bind_by_name($statement2, ':cen_id', $sector);
}






if (!oci_execute($statement1)) {
    $error = oci_error($statement1);
    die("Error en la ejecución de la consulta: " . $error['message']);
}
if (!oci_execute($statement2)) {
    $error = oci_error($statement2);
    die("Error en la ejecución de la consulta: " . $error['message']);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Citas</title>
    <meta charset="UTF-8">
    <style>
        .table {
            display: none;
        }
        
        #Tester:target {
            display: table;
            scroll-margin-top: 200vh;
            scroll-behavior: smooth;
        }

        #Teste2:target {
            display: table;
            scroll-margin-top: 200vh;
            scroll-behavior: smooth;
        }
        
        .enlaceboton {
            font-family: verdana, arial, sans-serif;
            font-size: 10pt;
            font-weight: bold;
            padding: 4px;
            background-color: #c5e2f6;
            color: #666666;
            text-decoration: none;
        }

        .enlaceboton:link {
            border-top: 1px solid #cccccc;
            border-bottom: 2px solid #666666;
            border-left: 1px solid #cccccc;
            border-right: 2px solid #666666;
        }

        .enlaceboton:active {
            background-color: grey !important;
        }

        .enlaceboton:hover {
            border-bottom: 1px solid #cccccc;
            border-top: 2px solid #666666;
            border-right: 1px solid #cccccc;
            border-left: 2px solid #666666;
        }

        .marcado {
            background-color: grey !important;
            cursor: not-allowed;
        }

        .selected {
            font-weight: bold;
            color: red;
        }
    </style>

    <script>
        // Obtener el estado del enlace guardado en el almacenamiento local al cargar la página
        window.addEventListener('DOMContentLoaded', () => {
            const selectedLinkId = localStorage.getItem('selectedLinkId');
            if (selectedLinkId) {
                const selectedLink = document.getElementById(selectedLinkId);
                if (selectedLink) {
                    selectedLink.classList.add('marcado');
                }
            }
        });

        // Marcar el enlace seleccionado y guardar su estado en el almacenamiento local
        function marcarBoton(enlace) {
            const botones = document.getElementsByClassName('enlaceboton');
            for (let i = 0; i < botones.length; i++) {
                botones[i].classList.remove('marcado');
            }
            enlace.classList.add('marcado');
            guardarSeleccion(enlace.id);
        }

        // Guardar el estado del enlace seleccionado en el almacenamiento local
        function guardarSeleccion(selectedLinkId) {
            localStorage.setItem('selectedLinkId', selectedLinkId);
        }
    </script>
</head>
<body>
<script>
        // Agrega la función marcarBoton() a los enlaces
        const enlaces = document.getElementsByClassName('enlaceboton');
        for (let i = 0; i < enlaces.length; i++) {
            enlaces[i].addEventListener('click', () => {
                marcarBoton(enlaces[i]);
            });
        }
    </script>

    <script>
        const select = document.querySelector(".enlaceboton");
        const options = document.querySelectorAll(".enlaceboton option");
        
        select.addEventListener("change", function() {
            const url = this.options[this.selectedIndex].dataset.url;
            if (url) {
                localStorage.setItem("url", url);
                location.href = url;
            }
        });

        for (const option of options) {
            const url = option.dataset.url;
            if (url === location.href) {
                option.setAttribute("selected", "");
                break;
            }
        }
    </script>


 

    <br><br>
    <form method="post" style="margin-top: auto;">
    
        <br>
        <div class="form-horizontal"> &nbsp; </div>
        <div class="form-horizontal">
            <div class="col-md-13">
                <div class="form-group">

                    <label class="control-label col-md-1"> Seleccione Fecha :</label>
                    <div class="col-md-2">
                        <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy" id="desde">
                            <input class="form-control" type="text" onchange="this.form.submit()" id="desde" name="desde" value="<?php echo $desde; ?>" style="height: 28px !important;" autocomplete="off" />
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group date datepicker" data-date-autoclose="true" data-date-format="dd/mm/yyyy" id="hasta">
                            <input class="form-control" type="text" onchange="this.form.submit()" id="hasta" name="hasta" value="<?php echo $hasta; ?>" style="height: 28px !important;" autocomplete="off" />
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <label style="margin-left: auto;" class="control-label col-md-1">Centro :</label>
        <label class="radio-inline" style="margin-right: 1px !important;">
    <input name="sector" type="radio" onchange="this.form.submit()" value="0" checked="<?= ($sector == '0' || empty($sector)) ? 'checked' : '' ?>">
    <span style="font-size: 14px;">Todos</span>
</label>


        <label class="radio-inline">
            <input name="sector" type="radio" onchange="this.form.submit()" value="3" <?= ($sector == '3') ? 'checked' : '' ?>>
            <span style="font-size: 14px;">S.L</span>
        </label>

        <label class="radio-inline">
            <input name="sector" type="radio" onchange="this.form.submit()" value="1" <?= ($sector == '1') ? 'checked' : '' ?>>
            <span style="font-size: 14px;">C.U</span>
        </label>

        <label class="radio-inline">
            <input name="sector" type="radio" onchange="this.form.submit()" value="2" <?= ($sector == '2') ? 'checked' : '' ?>>
            <span style="font-size: 14px;">L.F</span>
        </label>

        <label class="radio-inline">
            <input name="sector" type="radio" onchange="this.form.submit()" value="4" <?= ($sector == '4') ? 'checked' : '' ?>>
            <span style="font-size: 14px;">L.H</span>
        </label>

        <label class="radio-inline">
            <input name="sector" type="radio" onchange="this.form.submit()" value="5" <?= ($sector == '5') ? 'checked' : '' ?>>
            <span style="font-size: 14px;">C.S.H</span>
        </label>

        <label class="radio-inline">
            <input name="sector" type="radio" onchange="this.form.submit()" value="12" <?= ($sector == '12') ? 'checked' : '' ?>>
            <span style="font-size: 14px;">P.G.W</span>
        </label>
        <label class="radio-inline">
            <input name="sector" type="radio" onchange="this.form.submit()" value="6" <?= ($sector == '6') ? 'checked' : '' ?>>
            <span style="font-size: 14px;">COSAM</span>
        </label>

        <label class="radio-inline">
            <input name="sector" type="radio" onchange="this.form.submit()" value="13" <?= ($sector == '13') ? 'checked' : '' ?>>
            <span value="Filtrar" style="font-size: 14px;">L.T </span>
        </label>


        <br><br>
        <div id="cuadro">
        <label style="font-weight: 600;">Seleccione Vista: </label>
        <label class="radio-inline">
            <a id="enlace1" class="enlaceboton" value="1" data-url="#Tester" href="#Tester" onclick="marcarBoton(this)">Agenda</a>
        </label>
        <label class="radio-inline">
            <a id="enlace2" class="enlaceboton" value="2" data-url="#Teste2" href="#Teste2" onclick="marcarBoton(this)">Acto</a>
        </label>
    </div>
    </form>
    

    <table id="Tester" class="table table-striped table-bordered" style="width:100%">
    
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

    <table id="Teste2" class="table table-striped table-bordered" style="width:100%">
       
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