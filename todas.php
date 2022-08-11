<?php
        include('verifica_login.php');
        if(!$_SESSION['usuario']) {
            header('Location: index.php');
            exit();
        }
		require('connect.php');
		//conectando com o localhost - mysql
		$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
		if (!$conn)
		echo ("Erro de conexão com localhost, o seguinte erro ocorreu -> ");

        $resultado = mysqli_query($conn, "SELECT sum(valor) FROM movimentos");
        $linhas = mysqli_num_rows($resultado);

        $pegardatas = "SELECT * FROM movimentos where data BETWEEN CURRENT_DATE()-7 AND CURDATE()";
        $result3 = $conn->query($pegardatas);

		$sql = "SELECT * FROM `movimentos` WHERE `tipo` = '1' ORDER BY data DESC";
		$result = $conn->query($sql);

        $sql2 = "SELECT * FROM `movimentos` WHERE `tipo` = '2' ORDER BY data DESC";
        $result2 = $conn->query($sql2);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Over Money - Home</title>
</head>
<body id="app">
    <header>
        <nav class="navbar navbar-expand bg-white">
            <div class="container-fluid">
              <a class="navbar-brand" href="home.php">
                <img src="./assets/images/over-money-small.jpg" alt="image pocket" class="img-fluid" srcset="">
              </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                  <div class="d-flex menu">
                      <a href="home.php"><button class="btn btn-link" type="button"><i class="bi bi-house-door-fill fs-4 color-black"></i></button></a>
                      <a href="todas.php"><button class="btn btn-link" type="button"><i class="fs-4 bi bi-currency-exchange color-secundary"></i></button></a>

                      <div class="dropdown">
                        <button class="btn btn-link" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fs-4 bi bi-person-circle color-black"></i>
                        </button>
                        <ul class="dropdown-menu logout" aria-labelledby="dropdownMenuButton1">
                          <li><button class="dropdown-item" id="button-logout"><a href="logout.php">Sair</a></button></li>
                        </ul>
                      </div>
                  </div>
              </div>
            </div>
          </nav>
    </header>
    <main>
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-4 col-md-12 d-flex mt-4 justify-content-center align-items-center">
                    <i class="bi bi-cash-coin color-primary icon-detail"></i>
                    <span class="fs-2 shadow-lg" id="total">
                        <?php
                            while($linhas = mysqli_fetch_array($resultado)){
                                echo 'Total R$ '. $linhas['sum(valor)'];} 
                         ?>
                    </span>
                </div>
                <div class="col-lg-4 col-md-12 d-flex mt-4 justify-content-center align-items-center">
                    <i class="bi bi-cash-coin text-primary icon-detail"></i>
                    <span class="fs-2 shadow-lg" id="periodo">
                        <?php
                            if ($result3->num_rows > 0) {
                                // output data of each row
                                $totalPontos = 0;
                                while($row = $result3->fetch_assoc()) {
                                        
                                        $totalPontos += $row["valor"];
                                    }
                                    echo "Últimos 7 dias R$ ";
                                    echo $totalPontos;
                                } 
                         ?>
                    </span>
                </div>
                <div class="col-lg-4 d-flex mt-4 justify-content-center">
                    <div>
                        <img src="./assets/images/coins-small.png" class="img-fluid" alt="" srcset="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 info shadow-lg">
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                               <span class="fs-4">Entradas <i class="bi bi-arrow-down-circle fs-2 align-middle"></i></span>
                            </div>
                            <div class="col-6">
                                <span class="fs-4">Saídas <i class="bi bi-arrow-up-circle fs-2 align-middle"></i></span>
                            </div>
                            <div class="col-12 my-2">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="container p-0" id="cash-in-list">
                                    
                                <?php
						if ($result->num_rows > 0) {
							// output data of each row
							while($row = $result->fetch_assoc()) {
									echo
									'
                                    <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between mb-3">
                                        <h3 class="fs-2">R$ '. $row["valor"]. '</h3>
                                        <button class="btn btn-danger btn-excluir"><a class="link-light" href="excluir.php?id='. $row["id"]. '">Excluir</a></button>
                                        </div>
                                        <div class="container p-0">
                                            <div class="row">
                                                <div class="col-12 col-md-8">
                                                    <p>'. $row["descricao"]. '</p> 
                                                </div>
                                                <div class="col-12 col-md-3 d-flex justify-content-end">
                                                '. $row["data"]. '
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>';
								}
								
							}
		?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="container p-0" id="cash-out-list">
                                <?php
                                    if ($result2->num_rows > 0) {
                                        // output data of each row
                                        while($row2 = $result2->fetch_assoc()) {
                                                echo
                                                '
                                                <div class="row mb-4">
                                                <div class="col-12">
                                                <div class="d-flex justify-content-between mb-3">
                                                <h3 class="fs-2">R$ '. $row2["valor"]. '</h3>
                                                <button class="btn btn-danger btn-excluir"><a class="link-light" href="excluir.php?id='. $row2["id"]. '">Excluir</a></button>
                                                </div>
                                                    <div class="container p-0">
                                                        <div class="row">
                                                            <div class="col-12 col-md-8">
                                                                <p>'. $row2["descricao"]. '</p> 
                                                            </div>
                                                            <div class="col-12 col-md-3 d-flex justify-content-end">
                                                            '. $row2["data"]. '
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>';
                                            }
                                            
                                        }
                                    $conn->close();
		                        ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" data-bs-toggle="modal" data-bs-target="#data-modal" class="btn button-float-data"><i class="bi bi-calendar3"></i></button>
            <button data-bs-toggle="modal" data-bs-target="#transaction-modal" class="btn button-float"><i class="bi bi-plus"></i></button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="data-modal" tabindex="-1" aria-labelledby="data-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="data-modal">Buscar data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="periodo.php" method="get" id="data-form">
                        <div class="modal-body"> 
                            <form action="cadastro.php" method="post" id="data-form">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="date-imput" class="form-label fs-6">BUSCAR POR PERÍODO</label>
                                        <input type="date" class="form-control" name="inicio" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date-imput" class="form-label">Data final</label>
                                        <input type="date" class="form-control" name="fim" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary button-cancel" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn button-default">Buscar</button>
                                </div>
                            </form>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="transaction-modal" tabindex="-1" aria-labelledby="transaction-modal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="transaction-modal">Adicionar Lançamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="cadastro.php" method="post" id="transaction-form">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="value-input" class="form-label">Valor</label>
                                <input type="number" step="any" class="form-control" name="valor" required>
                            </div>
                            <div class="mb-3">
                                <label for="description-input" class="form-label">Descrição</label>
                                <input type="text" class="form-control" name="descricao" required>
                            </div>
                            <div class="mb-3">
                                <label for="date-imput" class="form-label">Data</label>
                                <input type="date" class="form-control" name="data" required>
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input checked class="form-check-input" type="radio" name="tipo" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Entrada</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="tipo" id="inlineRadio2" value="2">
                                    <label class="form-check-label" for="inlineRadio2">Saída</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary button-cancel" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn button-default">Adicionar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>