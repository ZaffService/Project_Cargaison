<?php
session_start();

$username = strtolower(trim($_POST['username'] ?? ''));
$password = trim($_POST['password'] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($username) || empty($password)) {
        $error_message = "Veuillez remplir tous les champs.";
    } else {
        // URL du json-server
        $url = "http://localhost:3000/gestionnaire?username=" . urlencode($username);

        $response = @file_get_contents($url);

        if ($response === false) {
            $error_message = "Impossible de se connecter au serveur de données.";
        } else {
            $data = json_decode($response, true);

            // Vérifier si l'utilisateur existe et que le mot de passe correspond
            if (!empty($data) && isset($data[0]) && $data[0]['password'] === $password) {
                $_SESSION['gestionnaire'] = $data[0];
                header("Location: /creation-cargaison");
                exit;
            } else {
                $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
            }
        }
    }
}
?>

<section class="flex items-center justify-center min-h-screen bg-gray-900 py-16">
  <div class="max-w-md w-full bg-gray-800 rounded-3xl p-8 border border-cyan-500/20 shadow-lg shadow-cyan-500/10">
      <div class="text-center mb-8">
          <div class="inline-block p-3 bg-cyan-500/10 rounded-xl border border-cyan-500/30 mb-4">
              <i class="fas fa-user-shield text-3xl text-cyan-400"></i>
          </div>
          <h2 class="text-4xl font-bold mb-2 text-white">Connexion <span class="text-cyan-400">Gestionnaire</span></h2>
          <p class="text-gray-400 text-lg">Accédez à votre tableau de bord</p>
      </div>

      <?php if (isset($error_message)): ?>
      <div class="mb-6 p-4 bg-red-900/30 rounded-lg border border-red-500/30">
          <p class="text-red-400 text-center" id="login-error"><i class="fas fa-exclamation-triangle mr-2"></i><?php echo htmlspecialchars($error_message); ?></p>
      </div>
      <?php endif; ?>

   <form class="space-y-6" action="" method="POST" id="login-form">
    <div>
        <label for="username" class="block text-cyan-400 font-semibold mb-2">Nom d'utilisateur</label>
        <input type="text" id="username" name="username" placeholder="Votre nom d'utilisateur"
               class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-white"
               value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>">
    </div>

    <div>
        <label for="password" class="block text-cyan-400 font-semibold mb-2">Mot de passe</label>
        <input type="password" id="password" name="password" placeholder="Votre mot de passe"
               class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-white">
    </div>

    <button type="submit"
            class="w-full py-4 bg-cyan-500 hover:bg-cyan-600 rounded-xl text-white font-semibold">
        <i class="fas fa-sign-in-alt mr-2"></i> Se Connecter
    </button>
</form>

      <p class="text-center text-gray-500 text-sm mt-6">
          <a href="#" class="hover:text-cyan-400 transition-colors duration-300">Mot de passe oublié?</a>
      </p>
  </div>
</section>







