<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Over Money</title>
</head>
<body id="login">
    <main>
        <div class="container">
            <div class="row vh-100">
                <div class="col d-flex justify-content-center my-5 flex-column">
                    <div class="text-login">
                        <p>Organize suas finâncias de uma forma fácil.</p>
                        <p>Controle seus gastos e investimentos.</p>
                        <p>Organize-se e atinja seus objetivos.</p>
                    </div>
                    <div class="text-center">
                        <img src="./assets/images/over-money.png" alt="image pocket" class="img-fluid" srcset="">
                    </div>
                </div>
                <div class="col  d-flex justify-content-center my-5 flex-column">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <div class="text-center mb-3">
                                    <img src="./assets/images/coins-small.png" alt="over money logo" class="img-fluid" srcset="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <?php
                                if(isset($_SESSION['nao_autenticado'])):
                                ?>
                                <div class="notification is-danger">
                                <p>ERRO: Usuário ou senha inválidos.</p>
                                </div>
                                <?php
                                endif;
                                unset($_SESSION['nao_autenticado']);
                                ?>
                                <form id="login-form" action="login.php" method="POST">
                                    <div class="mb-3">
                                      <label for="email-input" class="form-label">E-mail</label>
                                      <input type="text" class="form-control" id="email-input" name="usuario" aria-describedby="emailHelp">
                                      <div id="emailHelp" class="form-text">Utilze seu e-mail para realizar o login.</div>
                                    </div>
                                    <div class="mb-3">
                                      <label for="password-input" class="form-label">Senha</label>
                                      <input type="password" class="form-control" name="senha" id="password-input">
                                    </div>
                                    <button type="submit" class="btn button-login">Entrar</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="register-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crie sua conta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>