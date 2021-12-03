<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // tipo de users
        DB::table('tiposdeusers')->insert( ['descricao' => 'aluno'] );
        DB::table('tiposdeusers')->insert( ['descricao' => 'administrador'] );

        // info do campus
        DB::table('campuses')->insert( ['nome' => 'Natal-Central'] );
        DB::table('diretorias')->insert( ['nome' => 'DIAREN', 'campus_id' => 1] );
        DB::table('cursos')->insert( ['nome' => 'Tecnologia em Gestão Ambiental', 'diretoria_id' => 1] );
        DB::table('turmas')->insert( ['nome' => '20192.1.01304.1N', 'curso_id' => 1] );

        // eixos
        DB::table('eixos')->insert( ['nome' => 'Individual'] );
        DB::table('eixos')->insert( ['nome' => 'Familiar'] );
        DB::table('eixos')->insert( ['nome' => 'Intraescolar'] );
        DB::table('eixos')->insert( ['nome' => 'Carreira Profissional'] );
        DB::table('eixos')->insert( ['nome' => 'Área de Formação'] );
        DB::table('eixos')->insert( ['nome' => 'Institucional'] );

        // questionarios
        DB::table('questionarios')->insert( ['titulo' => 'Início do Semestre', 'disponivel' => 1] );

        // DB::table('questionarios')->insert( ['titulo' => 'Familiar', 'disponivel' => 1, 'eixo_id' => 2] );
        // DB::table('questionarios')->insert( ['titulo' => 'Intraescolar', 'disponivel' => 1, 'eixo_id' => 3] );
        // DB::table('questionarios')->insert( ['titulo' => 'Carreira Profissional', 'disponivel' => 1, 'eixo_id' => 4] );
        // DB::table('questionarios')->insert( ['titulo' => 'Área de Formação', 'disponivel' => 1, 'eixo_id' => 5] );
        // DB::table('questionarios')->insert( ['titulo' => 'Institucional', 'disponivel' => 1, 'eixo_id' => 6] );

        // questões
        DB::table('questaos')->insert(['titulo' => 'Sobre a escolha do curso, qual das seguintes opções foi mais decisiva?', 'eixo_id' => 1, 'questionario_id' => 1]);
        DB::table('questaos')->insert(['titulo' => 'Qual das seguintes opções mais representa a influência da sua família no seu curso?', 'eixo_id' => 2, 'questionario_id' => 1]);
        DB::table('questaos')->insert(['titulo' => 'Sobre suas relações na instituição, qual mais se encaixa com você?', 'eixo_id' => 3, 'questionario_id' => 1]);
        DB::table('questaos')->insert(['titulo' => 'Sobre o âmbito profissional, qual das seguintes opções mais representa sua concepção de carreira?', 'eixo_id' => 4, 'questionario_id' => 1]);
        DB::table('questaos')->insert(['titulo' => 'Qual das seguintes opções mais caracteriza sua relação com o seu curso?', 'eixo_id' => 5, 'questionario_id' => 1]);
        DB::table('questaos')->insert(['titulo' => 'Acerca das dependências do campus, qual das alternativas abaixo mais se identifica com você?', 'eixo_id' => 6, 'questionario_id' => 1]);

        // alternativas
        DB::table('alternativas')->insert(['alternativa' => 'Sempre quis fazer o curso escolhido', 'letra' => 'A', 'peso' => 1, 'questao_id' => 1]);
        DB::table('alternativas')->insert(['alternativa' => 'Tenho afinidade com o assunto', 'letra' => 'B', 'peso' => 2, 'questao_id' => 1]);
        DB::table('alternativas')->insert(['alternativa' => 'A nota influenciou na escolha do curso', 'letra' => 'C', 'peso' => 3, 'questao_id' => 1]);
        DB::table('alternativas')->insert(['alternativa' => 'Houve influência familiar na escolha do curso', 'letra' => 'D', 'peso' => 4, 'questao_id' => 1]);

        DB::table('alternativas')->insert(['alternativa' => 'Pergunta sobre meu curso e faz elogios e comentários de motivação.', 'letra' => 'A', 'peso' => 1, 'questao_id' => 2]);
        DB::table('alternativas')->insert(['alternativa' => 'Fala que deveria escolher um curso melhor', 'letra' => 'B', 'peso' => 2, 'questao_id' => 2]);
        DB::table('alternativas')->insert(['alternativa' => 'Precisa do meu apoio financeiro', 'letra' => 'C', 'peso' => 3, 'questao_id' => 2]);
        DB::table('alternativas')->insert(['alternativa' => 'São indiferentes', 'letra' => 'D', 'peso' => 4, 'questao_id' => 2]);

        DB::table('alternativas')->insert(['alternativa' => 'Costumo interagir com os colegas', 'letra' => 'A', 'peso' => 1, 'questao_id' => 3]);
        DB::table('alternativas')->insert(['alternativa' => 'Costumo interagir com os professores', 'letra' => 'B', 'peso' => 2, 'questao_id' => 3]);
        DB::table('alternativas')->insert(['alternativa' => 'Gostaria de interagir mais', 'letra' => 'C', 'peso' => 3, 'questao_id' => 3]);
        DB::table('alternativas')->insert(['alternativa' => 'Sinto-me excluído nos grupos', 'letra' => 'D', 'peso' => 4, 'questao_id' => 3]);

        DB::table('alternativas')->insert(['alternativa' => 'Penso que meu curso conseguirá casar satisfação intelectual e satisfação financeira', 'letra' => 'A', 'peso' => 1, 'questao_id' => 4]);
        DB::table('alternativas')->insert(['alternativa' => 'Penso que estudar é necessariamente o caminho para ser bem sucedido e quero ser o melhor na minha área', 'letra' => 'B', 'peso' => 2, 'questao_id' => 4]);
        DB::table('alternativas')->insert(['alternativa' => 'Estou nesse curso porque foi o que conseguir entrar, o que importa é ter uma profissão', 'letra' => 'C', 'peso' => 3, 'questao_id' => 4]);
        DB::table('alternativas')->insert(['alternativa' => 'Estou nesse curso porque existe uma pressão social, mas não acho que estudar é o melhor caminho para o sucesso profissional.', 'letra' => 'D', 'peso' => 4, 'questao_id' => 4]);

        DB::table('alternativas')->insert(['alternativa' => 'Sinto-me bastante estimulado com meu curso e busco complementar tudo que aprendo com leituras extras e pesquisando outras fontes', 'letra' => 'A', 'peso' => 1, 'questao_id' => 5]);
        DB::table('alternativas')->insert(['alternativa' => 'Boa e estou preocupado em manter boas notas', 'letra' => 'B', 'peso' => 2, 'questao_id' => 5]);
        DB::table('alternativas')->insert(['alternativa' => 'Mais ou menos, estou preocupado em me manter na média', 'letra' => 'C', 'peso' => 3, 'questao_id' => 5]);
        DB::table('alternativas')->insert(['alternativa' => 'Ruim, estou preocupado em me manter na média', 'letra' => 'D', 'peso' => 4, 'questao_id' => 5]);

        DB::table('alternativas')->insert(['alternativa' => 'Os ambientes da instituição são acessíveis e de boa estrutura.', 'letra' => 'A', 'peso' => 1, 'questao_id' => 6]);
        DB::table('alternativas')->insert(['alternativa' => 'Poderia ser bem melhor', 'letra' => 'B', 'peso' => 2, 'questao_id' => 6]);
        DB::table('alternativas')->insert(['alternativa' => 'Os ambientes da instituição não são acessíveis e nem possuem boa estrutura.', 'letra' => 'C', 'peso' => 3, 'questao_id' => 6]);
        DB::table('alternativas')->insert(['alternativa' => 'Falta atenção por parte da a administração', 'letra' => 'D', 'peso' => 4, 'questao_id' => 6]);

        // usuário admnistrador (tipo_id = 2)
        DB::table('users')->insert([
            'name' => 'Matheus Vinícius da Silva',
            'email' => 'matheus@simea.ifrn.local',
            'password' => bcrypt('123'),
            'tipo_id' => 2

        ]);

        // DB::table('users')->insert([
        //     'name' => 'Samir Cristino Souza',
        //     'email' => 'samir.souza@ifrn.edu.br',
        //     'password' => bcrypt('123'),
        //     'tipo_id' => 2
        // ]);

        // DB::table('users')->insert([
        //     'name' => 'Leonardo Ataide Minora',
        //     'email' => 'leonardo.minora@ifrn.edu.br',
        //     'password' => bcrypt('123'),
        //     'tipo_id' => 2
        // ]);

        // usuário aluno (tipo_id = 1)
        DB::table('users')->insert([
            'name' => 'Aluno Matheus',
            'email' => 'matheus10xy@gmail.com',
            'password' => bcrypt('123'),
            'tipo_id' => 1
        ]);
        DB::table('pessoas')->insert([
            'nome' => 'Aluno Matheus',
            'rg' => '000000000',
            'cpf' => '11111111111',
            'sexo' => 'Masculino',
            'telefone' => '888888888',
            'matricula' => '20191010040001',
            'dataNascimento' => '1972-10-10',
            'estadoCivil' => 'Casado',
            'raca' => 'Indígena',
            'renda' => 'Mais de quartro salários mínimos',
            'vinculo' => true,
            'turma_id' => 1,
            'user_id' => 2
        ]);

        DB::table('users')->insert([
            'name' => 'Ana Paula',
            'email' => 'ana.paula1997@hotmail.com',
            'password' => bcrypt('123'),
            'tipo_id' => 1
        ]);
        DB::table('pessoas')->insert([
            'nome' => 'Ana Paula',
            'rg' => '123213233233',
            'cpf' => '12111121112',
            'sexo' => 'Feminino',
            'telefone' => '888888888',
            'matricula' => '20191010040002',
            'dataNascimento' => '1997-10-10',
            'estadoCivil' => 'Solteiro',
            'raca' => 'Pardo',
            'renda' => 'Mais de quartro salários mínimos',
            'vinculo' => true,
            'turma_id' => 1,
            'user_id' => 3
        ]);

    }
}
