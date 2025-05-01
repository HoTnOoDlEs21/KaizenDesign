-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 01-Maio-2025 às 17:00
-- Versão do servidor: 8.0.17
-- versão do PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cpkaizen_php`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcacoes`
--

CREATE TABLE `marcacoes` (
  `id` int(11) NOT NULL,
  `utilizador_id` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` time NOT NULL,
  `observacoes` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `marcacoes`
--

INSERT INTO `marcacoes` (`id`, `utilizador_id`, `data`, `hora`, `observacoes`) VALUES
(2, 6, '2025-05-16', '11:00:00', 'Criar uma loja virtual'),
(4, 5, '2025-05-05', '10:30:00', 'Sessão extra'),
(5, 4, '2025-05-07', '11:00:00', 'Novo projeto'),
(6, 3, '2025-05-05', '17:00:00', 'Nova ideia de loja online'),
(7, 2, '2025-05-16', '11:30:00', 'Ponto de situação do projeto');

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `conteudo` text,
  `imagem` varchar(255) DEFAULT NULL,
  `data_publicacao` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `noticias`
--

INSERT INTO `noticias` (`id`, `titulo`, `conteudo`, `imagem`, `data_publicacao`) VALUES
(4, ' OpenAI lança ferramentas para ajudar desenvolvedores a criarem seus próprios agentes', 'A OpenAI quer tornar mais fácil para empresas criarem agentes de IA. Com as recém-lançadas ferramentas Responses API e Agentes SDK, os desenvolvedores terão uma suíte de ferramentas integradas como pesquisa na web e em arquivos e uso do computador automático de sistemas operacionais, o que ajudará a conectar o agente ao mundo real e automatizar tarefas.', 'openai.jpg', '2025-05-01 16:16:10'),
(6, 'As Profissões do Futuro: Como Python Está a Transformar Diferentes Setores', 'A revolução digital avança a passos largos e, no centro desta transformação, uma linguagem de programação tem-se destacado pela sua versatilidade e potência: Python. Mais do que uma simples ferramenta tecnológica, Python tornou-se um catalisador para o surgimento de novas profissões e oportunidades de carreira em praticamente todos os setores da economia. De startups inovadoras a empresas centenárias, a adoção desta linguagem está a redefinir não apenas o como trabalhamos, mas também o que fazemos profissionalmente.', '2150062008.jpg', '2025-05-01 16:33:41'),
(7, 'Front-End Developer: o que é e o que faz?', 'Se já navegaste num site, interagiste com uma aplicação ou simplesmente usaste uma plataforma online, então já tiveste contacto com o trabalho de um Front-End Developer. Mas o que faz exatamente este profissional e porque é tão essencial no mundo digital? Neste artigo, vamos explorar o papel do Front-End Developer, as suas responsabilidades e a crescente procura por estes especialistas no mercado de trabalho.', 'programacao-Blog.png', '2025-05-01 16:36:31'),
(8, 'A caminho do futuro', 'Estamos a melhorar a nossa marca, sempre de mão dada com o futuro. Aguarda por novidades!', 'logo_futuro.png', '2025-05-01 16:38:05'),
(9, 'Prémios Mais a Norte', 'Foi com muito orgulho que estivemos presentes na ultima Gala de entrega dos Prémios Mais a Norte, onde fomos galardoados com o prémio \\\\\\\"Norte + Criativo\\\\\\\". Este prémio serviu para reconhecer o enorme trabalho de toda a equipa. Obrigado a todos pela confiança.', 'thumb__664_479_0_0_crop.jpg', '2025-05-01 16:44:23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projetos`
--

CREATE TABLE `projetos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `descricao` text,
  `tempo_gasto` varchar(100) DEFAULT NULL,
  `tecnologia` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `projetos`
--

INSERT INTO `projetos` (`id`, `titulo`, `imagem`, `descricao`, `tempo_gasto`, `tecnologia`) VALUES
(5, 'Booking.com', 'booking1.jpg', 'O Booking.com é uma plataforma global de reservas online que conecta viajantes com uma ampla gama de opções de hospedagem, desde hotéis e resorts até apartamentos, pousadas e acomodações únicas.', '2', 'HMTL, CSS, Javascript e PHP'),
(6, 'BookaMover', 'bookamover.jpg', 'O Bookamover.com é uma plataforma online que facilita a reserva de serviços de mudanças, conectando clientes a empresas de mudanças profissionais.', '2', 'HMTL, CSS, Javascript e PHP'),
(7, 'Zendesk', 'zendesk.jpg', 'O Zendesk é uma plataforma de software focada em melhorar a experiência do cliente e o suporte ao cliente para empresas.', '3', '	 HTML, CSS, Bootstrap, JS, PHP'),
(8, 'Mint', 'mint-homepage-design.jpg', 'O Mint é uma plataforma gratuita de gerenciamento financeiro pessoal desenvolvida pela Intuit. É amplamente utilizada para ajudar indivíduos e famílias a monitorar, organizar e melhorar suas finanças pessoais.', '3', 'HMTL, CSS, Javascript e PHP'),
(9, 'FreshBooks', 'website-freshbooks.jpg', 'O FreshBooks é um software de contabilidade baseado na nuvem, projetado para simplificar a gestão financeira de pequenas empresas e freelancers.', '2', 'HTML, CSS, JS, PHP'),
(10, 'Superior Fireplaces', 'superiorfireplaces.jpg', 'A Superior Fireplaces é uma marca líder no setor de lareiras, oferecendo uma ampla gama de produtos de alta qualidade para aquecer e embelezar residências.', '1', 'HMTL, CSS, Javascript e PHP'),
(11, 'Rippaverse', 'Rippaverse-scaled.jpg', 'A Rippaverse é uma editora independente de quadrinhos fundada por Eric D. July, com o objetivo de revitalizar a cultura dos quadrinhos americanos, oferecendo histórias envolventes e personagens cativantes.', '2', 'PHP, Wordpress e JS'),
(12, 'Wiz', 'wiz.io-1-Z1N4aFg.jpg', 'A Wiz é uma startup americana especializada em segurança de computação em nuvem.', '2', 'HTML, CSS, JS, PHP'),
(13, 'CloudPassage', 'portfolio2a.jpg', 'A CloudPassage é uma empresa especializada em segurança e conformidade para ambientes de computação em nuvem, oferecendo soluções que abrangem servidores, containers e recursos de Infraestrutura como Serviço (IaaS) em ambientes públicos, privados, híbridos e multi-nuvem.', '3', '	 HTML, CSS, Bootstrap, JS, PHP'),
(14, 'Prezi', 'portfolio1a.jpg', 'O Prezi é uma plataforma inovadora de design de apresentações que se destaca por seu formato não linear, permitindo a criação de apresentações dinâmicas e interativas.', '1', 'HTML, CSS, JS, PHP'),
(15, 'Airbnb', 'portfolio3a.jpg', 'O Airbnb é uma plataforma online de hospedagem que conecta viajantes a anfitriões que oferecem acomodações únicas em mais de 220 países e regiões.', '3', 'HTML, CSS, JS, PHP'),
(16, 'Gleamin', 'website-gleamin.jpg', 'A Gleamin é uma marca de cuidados com a pele que se destaca por oferecer soluções naturais e eficazes para tratar hiperpigmentação, manchas escuras e promover uma pele radiante.', '2', '	 HTML, CSS, Bootstrap, JS, PHP');

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `apelido` varchar(100) NOT NULL,
  `dataNascimento` varchar(200) NOT NULL,
  `email` varchar(150) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `tipo` enum('admin','cliente') DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `utilizadores`
--

INSERT INTO `utilizadores` (`id`, `nome`, `apelido`, `dataNascimento`, `email`, `senha`, `telefone`, `tipo`) VALUES
(1, 'José', 'Gonçalves', '1987-08-24', 'jose@mail.pt', '$2y$10$JSYhtGpQFA1J5EtXcr3MCuocYfBGM0a87hFOsmd.YNALvD5MdI04m', '916659632', 'admin'),
(2, 'John', 'Doe', '2010-01-01', 'johnd@mail.pt', '$2y$10$DxKQhbGeSF4/pzyEcvKKj.iK8H.3nbBEKSfCE1Hjoza87nx242XxW', '919919911', 'cliente'),
(3, 'Maria', 'Pereira', '1966-12-12', 'maria@mail.pt', '$2y$10$EQa8vPSgLzCsUrxmuHTLGuViT3Ks.N9H1PlknEjRsX8LJczPNMmti', '911222222', 'cliente'),
(4, 'Manuel', 'Silva', '2003-03-23', 'manel@mail.pt', '$2y$10$ePjaEEuX6BtpXBe61ffWzeOV4sdgF6dkgUFfkDSvjrnuSxSvehnra', '922222222', 'cliente'),
(5, 'Teste', 'Teste', '1958-06-08', 'teste@teste.pt', '$2y$10$DPK4T7rfTjmPhBTCDVpSLebyNZQL5PFgR5jZrn6YVrx2DEK2vEhyG', '911112233', 'cliente'),
(6, 'Márcia', 'Gonçalves', '1989-03-12', 'marcia@mail.pt', '$2y$10$cxwj/9.Puf6nRlUimbSIiORk1hAhMxoLNFdfH.pkdGis6XXtIOVdS', '224003762', 'cliente'),
(7, 'Teste2', 'Teste', '2011-11-18', 'teste2@mail.pt', '$2y$10$oWq3B.XQRmF43j77CInyc..hRMku5lSe5qrjieUv6UhJJ2dbEEQ3G', '911991199', 'cliente');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `marcacoes`
--
ALTER TABLE `marcacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utilizador_id` (`utilizador_id`);

--
-- Índices para tabela `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `projetos`
--
ALTER TABLE `projetos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `marcacoes`
--
ALTER TABLE `marcacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `projetos`
--
ALTER TABLE `projetos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `marcacoes`
--
ALTER TABLE `marcacoes`
  ADD CONSTRAINT `marcacoes_ibfk_1` FOREIGN KEY (`utilizador_id`) REFERENCES `utilizadores` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
