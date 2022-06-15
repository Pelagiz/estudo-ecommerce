<?php

namespace App\DataFixtures;

use App\Entity\Categoria;
use App\Entity\Produto;
use App\Entity\User;
use App\Entity\Endereco;
use App\Entity\Compra;
use App\Entity\Fornecedor;
use App\Entity\Venda;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $alimento = new Categoria();
        $fV = new Categoria();
        $limpeza = new Categoria();


        $alimento->setNome('alimentos');

        $fV->setNome('frutas e vegetais');

        $limpeza->setNome('limpeza');

        $arroz = new Produto();
        $detergente = new Produto();
        $banana = new Produto();

        $arroz->setNome('Arroz');
        $arroz->setQuantidade('20');
        $arroz->setPrecoUnitario('R$20,15');
        $arroz->setDescricao(file_get_contents('http://loripsum.net/api'));
        $arroz->setCategoria($alimento);
        $manager->persist($arroz);
        $manager->flush();


        $detergente->setNome('Detergente');
        $detergente->setQuantidade('40');
        $detergente->setPrecoUnitario('R$9,80');
        $detergente->setDescricao(file_get_contents('http://loripsum.net/api'));
        $detergente->setCategoria($limpeza);
        $manager->persist($detergente);
        $manager->flush();


        $banana->setNome('Banana');
        $banana->setQuantidade('80');
        $banana->setPrecoUnitario('R$1,50');
        $banana->setDescricao(file_get_contents('http://loripsum.net/api'));
        $banana->setCategoria($fV);
        $manager->persist($banana);

        // USER
        $user = new User();
        $user->setEmail('teste@gmail.com');
        $user->setPassword('teste');
        $user->setRoles(['ROLE_WORKER']);
        $user->setCel('(11)99876-9876');

        // ENDERECO
        $endereco = new Endereco();
        $endereco->setRua('teste');
        $endereco->setBairro('teste');
        $endereco->setCidade('teste');
        $endereco->setNumero('123');

        // connecting endereco with user
        $user->setEndereco($endereco);

        // COMPRA
        $compra = new Compra();
        $compra->setUser($user);
        $compra->setProduto($banana);
        $compra->setDataEfetuada(new \DateTime());



        // persisting data in database
        $manager->persist($compra);
        $manager->flush();

        // FORNECEDOR
        $fornecedor = new Fornecedor();
        $fornecedor->setNome('testeFornecedor');
        $fornecedor->setcnpj('4829898248');

        // ENDERECO
        $endereco = new Endereco();
        $endereco->setRua('teste2');
        $endereco->setBairro('teste2');
        $endereco->setCidade('teste2');
        $endereco->setNumero('321');

        // connecting endereco with fornecedor
        $fornecedor->setEndereco($endereco);

        // VENDA
        
        $venda = new Venda();
        $venda->setFornecedor($fornecedor);
        $venda->setProduto($detergente);
        $venda->setDataEfetuada(new \DateTime());

        // persisting data in database
        $manager->persist($venda);
        $manager->flush();
    }
}
