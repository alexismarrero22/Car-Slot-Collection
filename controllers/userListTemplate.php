<tr>
    <td>{name}</td>
    <td>{surname}</td>
    <td>{email}</td>
    <td>
        <!-- Botón para ver la colección de un usuario -->
        <form action="controllers/carController.php?action=showCollection" method="post" >
            <input type="hidden" name="id" value="{id}">
            <button type="submit">Ver Colección</button>
        </form>

    </td>
</tr><br>