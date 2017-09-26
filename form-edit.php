<?php
require 'init.php';
// pega o ID da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
// valida o ID
if (empty($id)) {
    echo "ID para alteração não definido";
    exit;
}
// busca os dados do usuário a ser editado
$PDO = db_connect();
$sql = "SELECT name, email, gender, birthdate FROM users WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
// se o método fetch() não retornar um array, significa que o ID não corresponde 
// a um usuário válido
if (!is_array($user)) {
    echo "Nenhum usuário encontrado";
    exit;
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <title>Cadastro de Usuário</title>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
                <div class="container">
                    <a class="navbar-brand js-scroll-trigger" href="index.php">Home</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ml-auto">
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <section>
            <div class="container">
                <h1 class="jumbotron text-center">Sistema de Cadastro</h1>
                <h2 class="text-center">Edição de Usuário</h2>
                <br>
                <form action="edit.php" method="post">
                    <div class="form-group row">
                        <div class="col-3">
                            <label for="name">Nome: </label>
                            <input class="form-control input-sm" type="text" name="name" id="name" value="<?php echo $user['name'] ?>">
                        </div>
                         <div class="col-3">
                        <label for="email">Email: </label>
                        <br>
                        <input class="form-control input-sm" type="text" name="email" id="email" value="<?php echo $user['email'] ?>">
                         </div>
                         <div class="col-3">
                        Gênero:
                        <br>
                        <input type="radio" name="gender" id="gener_m" value="m" <?php if ($user['gender'] == 'M'): ?> 
                                   checked="checked" <?php endif; ?>>
                        <label class="radio control-label" for="gener_m">Masculino </label>
                        <input type="radio" name="gender" id="gener_f" value="f" <?php if ($user['gender'] == 'F'): ?> 
                                   checked="checked" <?php endif; ?>>
                        <label for="gener_f">Feminino </label>
                         </div>
                        <div class="col-3">
                        <label for="birthdate">Data de Nascimento: </label>
                        <br>
                        <input class="form-control input-sm" type="text" name="birthdate" id="birthdate" placeholder="dd/mm/YYYY" 
                               value="<?php echo dateConvert($user['birthdate']) ?>">
                         </div>
                         <div class="col-md-12">
                             <br>
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input class="btn btn-default" type="submit" value="Alterar">
                         </div>
                    </div>
                        </form>
                        </section>
                        <footer id="fon" class="py-5 bg-dark">
                            <div class="container">
                                <p class="m-0 text-center text-white">Feito por: Bruna Fernanda/Isabella/Silvio</p>
                            </div>
                        </footer>
                        <script src="vendor/jquery/jquery.min.js"></script>
                        <script src="vendor/popper/popper.min.js"></script>
                        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
                        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
                        <script src="js/scrolling-nav.js"></script>
                        </body>
                        </html>

