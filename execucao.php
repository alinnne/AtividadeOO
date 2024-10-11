<?php

require_once("/Users/alinn/Desktop/OriObj/atividadeAssociacao/modelo/Pedido.php");
require_once("/Users/alinn/Desktop/OriObj/atividadeAssociacao/modelo/Prato.php");



$prato1 = new Prato;
$prato1->setNumero("1");
$prato1->setNome("Camarão à Milanesa");
$prato1->setValor("110,00");


$prato2 = new Prato;
$prato2->setNumero("2");
$prato2->setNome("Pizza Margherita");
$prato2->setValor("80,00");


$prato3 = new Prato;
$prato3->setNumero("3");
$prato3->setNome("Macarrão Carbonara");
$prato3->setValor("60,00");


$prato4 = new Prato;
$prato4->setNumero("4");
$prato4->setNome("Bife à Parmegiana");
$prato4->setValor("75,00");


$prato5 = new Prato;
$prato5->setNumero("5");
$prato5->setNome("Risoto ao Funghi");
$prato5->setValor("70,00");

$pratos = array($prato1, $prato2, $prato3, $prato4, $prato5);

$pedidos = array();

do {
    echo "\n\n------MENU------\n";
    echo "1- Cadastrar Pedido\n";
    echo "2- Cancelar Pedido\n";
    echo "3- Listar Pedidos\n";
    echo "4- Total de Vendas\n";
    echo "0- Sair\n";
    $opcao = readline("Informe a opção: ");

    echo "\n";

    switch ($opcao) {
        case 1:
            //cadastrar o pedido
            $pedido1 = new Pedido;
            $pedido1->setNomeCliente(readline("Nome do Cliente: \n"));
            $pedido1->setNomeGarcom(readline("Nome do Garçom: \n"));


           



            // 1- Listar os pratos
            echo "Pratos Disponíveis: \n";
            foreach ($pratos as $p) {
                echo $p->getNumero() . " - " . $p->getNome() . " (R$ " . $p->getValor() . ")\n";
            }

            
            $numPrato = intval(readline("Digite o Número do Prato: \n"));


            if ($numPrato >= 1 && $numPrato <= 5) {
                
                $prato = $pratos[$numPrato - 1]; 
                $pedido1->setPrato($prato);

                
                array_push($pedidos, $pedido1);
                echo "Pedido cadastrado com sucesso!\n";
            } else {
                echo "Número do prato inválido! Tente novamente.\n";
            }
            break;

        case 2:
            echo "Cancelar Pedido: \n";

            if (count($pedidos) > 0) {
                foreach ($pedidos as $index => $pedido) {
                    echo ($index + 1) . " - Cliente: " . $pedido->getNomeCliente() . "\n";
                }

                $pedidoCancelar = intval(readline("Digite o número do pedido que será cancelado: \n")) - 1;

                // Verifica se o índice está dentro dos limites do array
                if ($pedidoCancelar >= 0 && $pedidoCancelar < count($pedidos)) {
                    array_splice($pedidos, $pedidoCancelar, 1);
                    echo "Pedido cancelado com sucesso!\n";
                } else {
                    echo "Pedido não encontrado!\n";
                }
            } else {
                echo "Não há pedidos para cancelar!\n";
            }

            break;

        case 3:
            //Listar Pedidos
            if (count($pedidos) > 0) {
                foreach ($pedidos as $pedido) {
                    echo "O cliente " . $pedido->getNomeCliente() . ", foi atendido pelo garçom " . $pedido->getNomeGarcom() . ", pediu um prato de " . $pedido->getPrato()->getNome() . " no valor de R$ " . $pedido->getPrato()->getValor() . ".\n";
                }
            } else {
                echo "Nenhum pedido cadastrado!\n";
            }
            break;

        case 4:
            //Total de Vendas
            $totalVendas = 0;
            foreach ($pedidos as $pedido) {
                $totalVendas += $pedido->getPrato()->getValor();
            }
            echo "O total de vendas é: R$ " . $totalVendas . "\n";

        case 0:
            echo "Programa encerrado!\n";
            break;

        default:
            echo "Opção inválida!\n";
    }
} while ($opcao != 0);
