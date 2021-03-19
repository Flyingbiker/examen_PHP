<form action="index.php?controller=travels&action=addBdd&idClient=<?= $idClient ?>" method="post">
    <h3>Nouveau voyage pour <?= $client->getFirstName() . ' - ' . $client->getLastName() ?></h3>
    <div class="form-group">
        <label for="departure">Départ</label>
        <input type="text" name="departure" >
    </div>
    <div class="form-group">
        <label for="arrival">Arrivée</label>
        <input type="text" name="arrival" >
    </div>
    <div class="form-group">
        <label for="date">Date départ</label>
        <input type="date" name="date" >
    </div>

    <button type="submit" class="btn btn-primary">Enregistrer le voyage</button>
</form>
