<?php
include "base.php";


if($_GET['info'] != "open") {
$query = mysql_query("SELECT * FROM sessions where convoID = '".$_GET['info']."' ");
$result = mysql_fetch_array($query);
$ts = $result['initiated'];
$ts = strftime("%X %P",$ts);
?>
<table>
<tr>
<th><h4><img src="images/user.png" alt="Name" title="Nombre"/> Nombre</h4></th>
<th><h4><img src="images/furthercontact.png" alt="Wants to be contacted?" title="Rut" /> Rut </h4></th>
<th><h4><img src="images/emailaddress.png" alt="Email address" title="Email" /> Email</h4></th>
<th><h4><img src="images/icons/crossb.png" width="18" alt="Terminar" title="Terminar" /> Terminar</h4></th>
</tr><tr>
<td><?php echo $result['name'];?></td>
<td><?php echo $result['rut'];?></td>
<td><?php echo $result['email'];?></td>
<td><a href="#" onclick='parent.$.fn.colorbox({href:"includes/delConvo.php?id=<?php echo $result['convoID'];?>",opacity:0.9}); return false;' class="delete_convo">Click para Terminar</a></td>
</tr>
</table>
<?php
} else {
echo '<h3>Selecciona una Conversacion</h3>';
}

?>
