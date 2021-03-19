<h1>Vue détaillée du client <?= $client->getLastName() ?></h1>

<div class="card">
    <div class="card-header">
        <h3>Détails du client</h3>        
    </div>
    <div class="card-body">
    <strong>Nom : <?= $client->getLastName() ?> </strong>
    <strong>Prénom : <?= $client->getFirstName() ?> </strong>
    <p>Email : <?= $client->getEmail() ?> </p>
    <p>Age : <?= $client->getAge() ?> </p>
  </div>
  <div class="card-footer">
    <a href="index.php?controller=travels&action=addForm&idClient=<?= $client->getId() ?>">
        <button class="btn btn-primary">Ajouter un nouveau voyage</button>
    </a>
  </div>
</div>


<div class="card">
    <div class="card-header">
        <h3>Précédents voyages</h3>        
    </div>
    <div class="card-body">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Trajet</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($travelsArray as $row) {
                ?>
                <tr>
                    <td><?= $row->getDeparture() . ' - ' .   $row->getArrival()?> </td>
                    <td><?= $row->getDate()->format('d-m-Y') ?></td>
                </tr>   
                <?php
            }
        ?>
                     
        </tbody>
</table>
    </div>
</div>
