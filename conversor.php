<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Conversor</title>
</head>
<body>

    <main>
    <h1>Valor Convertido </h1>
    <?php 
        //Cotação da API vinda do Banco Central

        $inicio = date("m-d-Y", strtotime("-7 days"));
        $fim = date("m-d-Y");
        $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''.$inicio.'\'&@dataFinalCotacao=\''.$fim.'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';
    
        $dados = json_decode(file_get_contents($url), true);
    
        //var_dump($dados);
    
        $cotacao = $dados["value"][0]["cotacaoCompra"];

        //Qual o valor em reais 
        $real = $_REQUEST["din"] ?? 0;

        //Equivalencia em Dolar
        $dolar = $real / $cotacao;


        echo "<p>Seus R\$" . number_format($real, 2, ",", ".") . " equivalem a <strong>" . number_format($dolar, 2 , ",", ".") ."</strong>" . " dolares americanos</p>";

        //$padrao = numfmt_create("pt_BR", NumberFormatter::CURRENCY);

        //echo "<p>Seus " . numfmt_format_currency($padrao, $real, "BRL") . "equivalem a <strong>". numfmt_format_currency($padrao, $dolar, "USD") . "</strong></p>";

   ?>
   <button onclick = "javascript:history.go(-1)">Voltar</button>
</main>
</body>
</html>