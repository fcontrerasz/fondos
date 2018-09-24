<?php
if(!empty($_GET['id'])) {
echo '<div id="padded_box"><form method="post" action="admin.php">';
        echo '<p>¿Estas seguro de terminar la conversacion?</p>';
        echo '
        <input type="hidden" name="id" id="id" value="'.$_GET['id'].'" />
        <button type="submit" name="cancel" value="cancel">Cancelar</button>
        <button class="del" type="submit" name="delete_convo" value="delete">Si</button>
        </form></div>
';
}
?>
