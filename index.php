<?php
require_once 'init.php';
// abre a conexão
$PDO = db_connect();
// SQL para contar o total de registros
// A biblioteca PDO possui o método rowCount(), 
// mas ele pode ser impreciso.
// É recomendável usar a função COUNT da SQL
$sql_count = "SELECT COUNT(*) AS total FROM users ORDER BY name ASC";
// SQL para selecionar os registros
$sql = "SELECT id, name, email, gender, birthdate "
        . "FROM users ORDER BY name ASC";
// conta o toal de registros
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();
// seleciona os registros
$stmt = $PDO->prepare($sql);
$stmt->execute();
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link href="dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="style.css" rel="stylesheet" type="text/css"/>
        <title>Sistema de Cadastro</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="index.php">Home</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger" href="form-add.php">Adicionar usuário</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section id="about">
            <div class="container">
                <h1 class="jumbotron text-center">Sistema de Cadastro</h1>
                <h2 class="text-center">Lista de Usuários</h2>
                <br>
                <div class="col-md-12">
                    <h5>Total de usuários: <?php echo $total ?></h5>
                    <?php if ($total > 0): ?>
                    </div>
                    <br>
                    <table class="table table-bordered" width="50%">
                        <thead class="thead-inverse">
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Gênero</th>
                                <th>Data de Nascimento</th>
                                <th>Idade</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                <tr>
                                    <td><?php echo $user['name'] ?></td>
                                    <td><?php echo $user['email'] ?></td>
                                    <td><?php echo ($user['gender'] == 'M') ? 'Masculino' : 'Feminino' ?></td>
                                    <td><?php echo dateConvert($user['birthdate']) ?></td>
                                    <td><?php echo calculateAge($user['birthdate']) ?> anos</td>
                                    <td>
                                        <a href="form-edit.php?id=<?php echo $user['id'] ?>">Editar</a>
                                        <a href="delete.php?id=<?php echo $user['id'] ?>" 
                                           onclick="return confirm('Tem certeza de que deseja remover?');">
                                            Remover
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Nenhum usuário registrado</p>
                <?php endif; ?>
            </div>
        </section>
        <footer class="mas py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">Feito por:Thiago</p>
            </div>
        </footer>
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/popper/popper.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
     
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="js/scrolling-nav.js"></script>
    </body>
</html>
