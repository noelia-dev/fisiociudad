 <!-- Tabla de citas del día -->
 <table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
       
        <tr>
            <td>< ?= $key + 1 ?></td>
            <td>< ?= $user->name ?></td>
            <td>< ?= $user->email ?></td>
        </tr>

    </tbody>
</table>