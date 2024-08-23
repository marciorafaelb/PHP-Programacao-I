<?php require_once('inc/topo.php');

session_start();

$_SESSION['product-name'] = 'Placa de Vídeo Asus Dual NVIDIA GeForce RTX 2070 EVO V2 OC Edition, 8GB, GDDR6';
$_SESSION['product-price'] = 'R$ 2.949,90';
$productPriceNumeric = 2949.90;

// Inicializa o contador se necessário
if (!isset($_SESSION['contador'])) {
    $_SESSION['contador'] = 1;
}

// Calcula o subtotal
$_SESSION['product-subtotal'] = $_SESSION['contador'] * $productPriceNumeric;

// Verifica se o botão de incremento, decremento ou remoção foi clicado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['incrementar'])) {
        $_SESSION['contador']++; // Incrementa o contador
        // Calcula o subtotal
        $_SESSION['product-subtotal'] = $_SESSION['contador'] * $productPriceNumeric;
    } elseif (isset($_POST['decrementar'])) {
        if ($_SESSION['contador'] > 1) {
            $_SESSION['contador']--; // Decrementa o contador
            // Calcula o subtotal
            $_SESSION['product-subtotal'] = $_SESSION['contador'] * $productPriceNumeric;
        }
    } elseif (isset($_POST['remover'])) {
        unset($_SESSION['product-name']);
        unset($_SESSION['product-price']);
        unset($_SESSION['contador']);
        unset($_SESSION['product-subtotal']);
    } elseif (isset($_POST['aplicar_cupom'])) {
        $cupom = $_POST['cupom'];
        if ($cupom == "DESCONTO10") { // Exemplo de cupom
            $desconto = 0.10; // 10% de desconto
            $_SESSION['product-subtotal'] *= (1 - $desconto);
        }
    }
}

?>

<div class="main_content">
    <div class="section">
        <div class="container"> 
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive shop_cart_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail"></th>
                                    <th class="product-name">Produto</th>
                                    <th class="product-price">Preço</th>
                                    <th class="product-quantity">Quantidade</th>
                                    <th class="product-subtotal">Subtotal</th>
                                    <th class="product-remove">Remover</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($_SESSION['product-name'])): ?>
                                <tr>
                                    <td class="product-thumbnail"><a href=""><img src="http://localhost/ifc/trabalho/img/produto.jpg" alt="Placa de Vídeo Asus Dual NVIDIA GeForce RTX 2070 EVO V2 OC Edition, 8GB, GDDR6"></a></td>
                                    <td class="product-name" data-title="Produto"><a href=""><?=$_SESSION['product-name']?></a></td>
                                    <td class="product-price" data-title="Preço"><?=$_SESSION['product-price']?></td>
                                    <td class="product-quantity" data-title="Quantidade">
                                        <div class="quantity">
                                            <form method="post" action="" class="text-center mt-4">
                                                <button type="submit" name="incrementar" class="btn btn-success">+</button>
                                                <input type="text" disabled name="qtde_pedido_item" value="<?=$_SESSION['contador']?>" title="Quantidade" class="qty" size="4">
                                                <button type="submit" name="decrementar" class="btn btn-danger">-</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="product-subtotal" data-title="Subtotal">R$ <?=number_format($_SESSION['product-subtotal'], 2, '.', ',')?></td>
                                    <td class="product-remove" data-title="Remover">
                                        <form method="post" action="">
                                            <button type="submit" name="remover" class="btn btn-danger">X</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Nenhum produto no carrinho.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="px-0">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-lg-12 col-md-12 mb-12 mb-md-12">
                                                <div class="coupon field_form input-group">
                                                    <form method="post" action="">
                                                        <input type="text" name="cupom" class="form-control form-control-sm" placeholder="Código do cupom">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-fill-out btn-sm" type="submit" name="aplicar_cupom">Aplicar cupom</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        <a href="http://localhost/ifc/trabalho/login.php" class="btn btn-fill-out">Concluir compra</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="medium_divider"></div>
                    <div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
                    <div class="medium_divider"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
