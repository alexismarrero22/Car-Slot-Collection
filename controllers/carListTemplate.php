<tr>
    <td>{brand}</td>
    <td>{model}</td>
    <td>{manufacturer}</td>
    <td>{nameRally}</td>
    <td>{edition}</td>
    <td>{country}</td>
    <td>{year}</td>
    <td>
        <!--Boton ver decoracion-->
        <button type="button" onclick="mostrarDecoracion('{id_car}')">Ver decoración</button>
        <div id="decoracion-{id_car}" style="display:none;" margin-top:10px;>
        </div>
    </td>
    <td>
        <!--Boton eliminar-->
        <form action="controllers/carController.php?action=delete" method="post" style="display:inline" onsubmit="return confirm('¿Estás seguro de que quieres borrar este coche?');">
            <input type="hidden" name="id_car" value="{id_car}">
            <button type="submit">Eliminar</button>
        </form>
        <!--Boton modificar-->
        <form action="editarcoche.php" method="get" style="display:inline" onsubmit="return confirm('¿Estás seguro de que quieres modificar este coche?');">
            <input type="hidden" name="id_car" value="{id_car}">
            <button type="submit">Modificar</button>
        </form>
    </td>
</tr><br>