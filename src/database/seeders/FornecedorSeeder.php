<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Fornecedor;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fornecedor = new Fornecedor();
        $fornecedor->nome = 'gdsfgds';
        $fornecedor->site = 'fdsfdsad.com.br';
        $fornecedor->uf = 'dd';
        $fornecedor->email = 'dfasdfsadfdsa@fmas.com';
        $fornecedor->save();

        Fornecedor::create([
            'nome' => '2',
            'site' => '21.com',
            'uf' => 'SP',
            'email' => 'SP@gmail.com',
        ]);


    }
}
