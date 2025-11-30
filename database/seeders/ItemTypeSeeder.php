<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            // 📚 Materiais de Estudo
            'Caderno',
            'Livro',
            'Apostila',
            'Calculadora',
            'Estojo',
            'Folhas avulsas',
            'Agenda',

            // 🎒 Itens Pessoais
            'Mochila',
            'Bolsa',
            'Carteira',
            'Chave',
            'Óculos',
            'Guarda-chuva',
            'Garrafa de água',

            // 📱 Eletrônicos
            'Celular',
            'Notebook',
            'Tablet',
            'Carregador de celular',
            'Carregador de notebook',
            'Fones de ouvido',
            'Powerbank',

            // 🧥 Roupas / Acessórios
            'Casaco / Jaqueta',
            'Blusa',
            'Boné',
            'Touca',
            'Luvas',

            // 🧾 Documentos
            'RG',
            'CPF',
            'Carteirinha da universidade',
            'Carteira de motorista',
            'Título de eleitor',

            // 💳 Cartões
            'Cartão de crédito/débito',
            'Cartão de transporte',
            'Cartão de acesso',

            // ⚙️ Outros
            'Pen drive',
            'Chapéu de EPI',
            'Ferramenta (chave de fenda, alicate)',
            'Material de laboratório'
        ];

        foreach ($types as $type) {
            DB::table('item_types')->insert([
                'name' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
