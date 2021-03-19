<form action="index.php?controller=travels&action=addBdd&idClient=<?= $idClient ?>" method="post">
    <h3>Nouveau voyage pour <?= $client->getFirstName() . ' - ' . $client->getLastName() ?></h3>
    <div class="form-group">
        <label for="departure">Départ</label>
        <input type="text" name="departure" class="form-control" placeholder="Départ">
    </div>
    <div class="form-group">
        <label for="arrival">Arrivée</label>
        <input type="text" name="arrival" class="form-control" placeholder="Arrivée">
    </div>
    <div class="form-group">
        <label for="date">Date de départ</label>
        <input type="date" name="date" class="form-control" placeholder="Date de départ">
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer le voyage</button>
</form>
