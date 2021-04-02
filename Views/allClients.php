<h3>Liste des clients de l'agence</h3>
<table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nom</th>
        <th scope="col">Prénom</th>
        <th scope="col">Email</th>
        <th scope="col">Age</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    foreach($clientsArray as $client){
        ?>
        <tr>
            <th scope="row"><?= $client->getId() ?></th>
            <td>
                <a href="index.php?controller=clients&action=view&id=<?= $client->getId() ?>">
                    <?= $client->getFirstName() ?>
                </a>
            </td>
            <td>
                <a href="index.php?controller=clients&action=view&id=<?= $client->getId() ?>">
                    <?= $client->getLastName() ?>
                </a>
            </td>
            <td><?= $client->getEmail() ?></td>
            <td><?= $client->getAge() ?></td>
        </tr>
        <?php
    }
    ?>    
    </tbody>
</table>