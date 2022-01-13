<?php 
 
 require 'constants.php';  //xrhsimopoioume require constants etsi wste ta sensitive data na mn vriskontai ston kwdika mas se periptwsh pou ton kanoume share me alla atoma

//dhmiourgia tou connection object
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//an h sundesh apotuxei tote stamata
if($conn->connect_error){
  die('Database error:' . $conn->connect_error);
}
?>