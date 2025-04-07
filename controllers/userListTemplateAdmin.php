<tr>
    <td>{name}</td>
    <td>{surname}</td>
    <td>{email}</td>
    <td>{rol}</td>
    <td>{estado}</td>
    <td>
        <!-- Botón bloquear/desbloquear -->
        <form action= "../controllers/adminController.php?action=change" method="post" style="display:inline;" onsubmit="return confirm('¿Cambiar el estado de este usuario?');">
            <input type="hidden" name="id" value="{id}">
            <button type="submit" >Bloquear/Desbloquear</button>
        </form>
        <!-- Botón eliminar -->
        <form action= "../controllers/adminController.php?action=delete" method="post" style="display:inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">
            <input type="hidden" name="id" value="{id}">
            <button type="submit">Eliminar</button>
        </form>
    </td>
</tr>