<form action="index.php?controller=clients&action=view" method="post">
    <h3>Formulaire d'ajout d'un client</h3>
    <div class="form-group">
        <label for="lastName">Nom</label>
        <input type="text" name="lastName" >
    </div>
    <div class="form-group">
        <label for="firstName">Prénom</label>
        <input type="text" name="firstName" >
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" >
    </div>
    <div class="form-group">
        <label for="age">Age</label>
        <input type="text" name="age" >
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer le client</button>
</form>
