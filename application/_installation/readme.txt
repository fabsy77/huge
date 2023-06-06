primeiro,  criar um novo banco huge_algum_nome
no arquivo application\config\config.development.php
alterar o valor da chave   linha 70,  'DB_NAME' => 'huge_algum_nome',

no phpmyadmin, seleconar o novo banco e importar o arquivo huge.sql que esta na pasta application\_installation


para subir no git comece pelos arquivos

na pasta model com os arquivos productAdmModel, productCartModel
na pasta controller os arquivos productAdmCotroller e productCartController
na pasta view com as pastas productAdm e productCart


mande para o git , primeiro os productAdmModel, productAdmCotroller e por ultimo os arquivos da pasta view/productAdm
mande para o git , segundo os productCartModel, productCartCotroller e por ultimo os arquivos da pasta view/productCart
mande para o git , productModel, productController e os arquivos da pasta view/product .(houve alteração neles para funcionar o botao de add cart)

mande para o git o arquivo header.php que esta em application\view\_templates\ ele tem o link acesso ao cart 