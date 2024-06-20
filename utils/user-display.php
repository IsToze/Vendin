<?php

require_once './utils/database.php';

if (isset($_POST['role']) && isset($_POST['id'])) {

    $role = $_POST['role'];
    $id = $_POST['id'];

    change_role($id, $role);

    header('Location: ./admin.php');

}

if (isset($_POST['delete-user'])) {

    $id = $_POST['delete-user'];

    delete_user($id);

    header('Location: ./admin.php');

}

display_users();

function display_users()
{

    echo "<h2>Liste des utilisateurs avec un rôle.</h2>";

    $users = get_all_users();

    echo "<table>";

    echo "<tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Modifier</th>
        </tr>";

    for ($i = 0; $i < count($users); $i++) {

        $fonction = $users[$i]['fonction'];
        $id = $users[$i]['id'];

        if ($fonction === "user")
            continue;

        echo "<tr>";
        echo "<td>" . $users[$i]['lastname'] . "</td>";
        echo "<td>" . $users[$i]['firstname'] . "</td>";
        echo "<td>" . $users[$i]['email'] . "</td>";
        echo "<td class='role'>" . $fonction . "</td>";
        echo "<td><button class='$id $fonction' id='role-modifier'>Modifier</button>";
        echo "</tr>";

    }

    echo "</table>";

    echo "<h2>Liste des utilisateurs sans rôle.</h2>";

    echo "<table>";

    echo "<tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>";

    for ($i = 0; $i < count($users); $i++) {

        $fonction = $users[$i]['fonction'];
        $id = $users[$i]['id'];

        if ($fonction !== "user")
            continue;

        echo "<tr>";
        echo "<td>" . $users[$i]['lastname'] . "</td>";
        echo "<td>" . $users[$i]['firstname'] . "</td>";
        echo "<td>" . $users[$i]['email'] . "</td>";
        echo "<td>" . $fonction . "</td>";
        echo "<td><button class='$id $fonction' id='user-modifier'>Modifier</button>";
        echo "<td><button class='$id' id='user-delete'>Supprimer</button>";
        echo "</tr>";

    }

    echo "</table>";

    echo "<script>
   
    addClickEvent(document.getElementById('role-modifier'));
    addClickEvent(document.getElementById('user-modifier'));
    
    function addClickEvent(element) {
   
        element.addEventListener('click', function() {
      
        const currentRole = this.className.split(' ')[1];
        
        if(currentRole === 'admin'){
            alert('Impossible de modifier le rôle de l\'administrateur.');
            return;
        }
        
        const id = this.className.split(' ')[0];
        const role = prompt('Entrez le rôle de l\'utilisateur');
        
        if(role === null)
            return;
        
        const form = document.createElement('form');
        form.method = 'post';
        form.action = 'admin.php';
        
        const param1Input = document.createElement('input');
        param1Input.name = 'role';
        param1Input.value = role;
        
        const param2Input = document.createElement('input');
        param2Input.name = 'id';
        param2Input.value = id;
        
        form.appendChild(param1Input);
        form.appendChild(param2Input);

        document.body.appendChild(form);
        form.submit();
        
        });
        
   }
   
   document.getElementById('user-delete').addEventListener('click', function() {
   
        const id = this.className;
        
        if(!confirm('Voulez-vous vraiment supprimer cet utilisateur ?'))
            return;
        
            const form = document.createElement('form');
            form.method = 'post';
            form.action = 'admin.php';
            
            const paramInput = document.createElement('input');
            paramInput.name = 'delete-user';
            paramInput.value = id;
            
            form.appendChild(paramInput);
            
            document.body.appendChild(form);
            form.submit();
            
        });
    
    </script>";

}


