<?php include 'header.php'; ?>

<div class="container" style="max-width: 450px; margin-top: 4rem;">
    
    <div class="card">
        <h2 style="text-align: center; color: var(--primary); margin-bottom: 2rem;">Connexion au compte</h2>
        
        <form action="#" method="POST">
            
            <div style="margin-bottom: 1.2rem;">
                <label for="email" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Adresse e-mail</label>
                <input type="email" id="email" name="email" placeholder="etudiant@campus.edu" required 
                       style="width: 100%; padding: 0.75rem; border: 1px solid #D1D5DB; border-radius: 6px; box-sizing: border-box; font-family: inherit;">
            </div>

            <div style="margin-bottom: 2rem;">
                <label for="password" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required 
                       style="width: 100%; padding: 0.75rem; border: 1px solid #D1D5DB; border-radius: 6px; box-sizing: border-box; font-family: inherit;">
            </div>

            <button type="submit" class="btn" style="width: 100%; padding: 0.8rem; font-size: 1rem;">Se connecter</button>
        </form>

        <p style="text-align: center; margin-top: 1.5rem; font-size: 0.9rem; color: #6B7280;">
            Pas encore membre d'un club ? <br>
            <a href="#" style="color: var(--primary); text-decoration: none; font-weight: bold;">Créer un compte étudiant</a>
        </p>
    </div>

</div>

<?php include 'footer.php'; ?>