<?php

$conn = oci_pconnect('APWEB_INT', 'Ev6RMao95#_', '186.10.119.218', 'PDBPNLNPRoD.stacks.cl');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}