-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 15 2022 г., 13:27
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `myfirstbase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `text` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(16) NOT NULL,
  `authors_id` int NOT NULL,
  `news_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `text`, `date`, `username`, `authors_id`, `news_id`) VALUES
(25, 'Нинтендо', '2022-11-11 14:24:48', 'Владислав', 29, 8),
(26, 'Соник', '2022-11-11 14:24:54', 'Владислав', 29, 9),
(27, 'Стим', '2022-11-11 14:25:04', 'Владислав', 29, 10),
(28, 'Ударная', '2022-11-11 14:25:17', 'Владислав', 29, 11),
(29, 'и я тебя!', '2022-11-11 14:25:48', 'Владислав', 29, 38),
(30, 'Стим', '2022-11-11 14:29:23', 'admin', 89, 10),
(32, 'Соник', '2022-11-11 14:31:34', 'Vlad', 32, 9),
(37, 'Нинтендоооо', '2022-11-13 22:42:10', 'Владислав', 29, 8),
(38, 'СТИМ', '2022-11-13 22:42:42', 'Владислав', 29, 10),
(39, 'СТИМ', '2022-11-13 22:43:08', 'admin', 89, 10),
(40, '123', '2022-11-13 22:50:48', 'admin', 89, 8),
(43, '123', '2022-11-14 17:08:47', 'Владислав', 29, 8),
(48, 'Привет, это комментарий для проверки комментариев. Если ты меня читаешь, то все хорошо. Может быть не все, но я отрисовываюсь.', '2022-11-14 23:35:30', 'Владислав', 29, 11),
(49, 'Люблю 2D игры', '2022-11-15 13:26:26', 'Владислав', 29, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `publication_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `header` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(10000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `publication_date`, `header`, `text`, `author`) VALUES
(8, '2022-08-22 18:27:00', 'На Nintendo Switch стали доступны еще три игры с 16-битной SEGA Mega Drive по подписке', 'Подборку 16-битных игр с SEGA Mega Drive в расширенном плане подписки Nintendo Switch Online пополнили еще три проекта.\r\n\r\nСегодня к сервису присоединились рельсовый шутер Space Harrier II, тактическая RPG Shining Force II и симулятор пинбола Sonic the Hedgehog Spinball. Владельцы Switch с активным доступом к NSO + Expansion Pack уже могут загрузить их.\r\n\r\nРасширенный план Nintendo Switch Online был запущен в октябре прошлого года и отличается от стандартного библиотеками классики с SEGA Mega Drive и Nintendo 64 в дополнение к играм для NES и SNES, доступным в рамках обычного членства.', 'Левенчук Владислав'),
(9, '2022-08-22 18:29:00', 'Sonic Triple Trouble 16-bit — полноценная новая 2D-игра про Соника выпущена силами фаната', 'В этом году Соник всё-таки получил отличную игру. И нет, речь не о позорно выглядящей «новой основе для серии» Sonic Frontiers, вроде как выходящей 15 ноября. И даже не о сборнике культовых 2D-игр Sonic Origins, с которым Sega умудрилась-таки сесть в лужу. Речь о фанатском ремейке игры с Game Gear, добравшемся до релиза после пяти лет разработки.\r\n\r\nSonic Triple Trouble 16-bit — вольный ремейк Sonic the Hedgehog: Triple Trouble из далёкого 1994 года, превращённый в сиквел Sonic 3 & Knuckles и порядком перерабатывающий дизайн уровней (оригинал был слишком лёгким из-за практически полного отсутствия врагов). В новинке Сонику и Тэйлзу (между которыми можно свободно переключаться) предстоит пройти 6 зон по 3 уровня в каждом, по возможности собрать изумруды хаоса и, само собой, в очередной раз накостылять Роботнику.\r\n\r\nНа данный момент Sonic Triple Trouble 16-bit выпущена исключительно на PC (качать тут), но со дня на день должен состоятся релиз Android-порта.', 'Левенчук Владислав'),
(10, '2022-08-22 18:38:00', 'В Steam выпустили футбольный симулятор 1988 года', 'Хорошая новость для тех, кто на дух не переносит современные игры серии FIFA и считает, что \"раньше было лучше\". В Steam внезапно вышел 8-битный футбольный симулятор MicroProse Soccer, разработанный в далеком 1988 году.\r\n\r\nКупить его можно за 175 рублей.\r\n\r\n\r\nСудя по описанию, в Steam-версии MicroProse Soccer доступны 29 различных футбольных команд, а также локальный мультиплеер.\r\n\r\nОригинальная игра разрабатывалась для Commodore 64, но со временем ее портировали на ZX Spectrum, Amiga и Atari ST. В Steam симулятор вышел благодаря издательству Ziggurat.', 'Левенчук Владислав'),
(11, '2022-08-22 18:39:00', 'Ударная доза олдскула в трейлере 8-битной метроидвании B.I.O.T.A.', 'Студия Retrovibe опубликовала геймплейный трейлер 8-битной метроидвании B.I.O.T.A. Ролик целиком и полностью посвящен одной из главных \"фишек\" игры — возможности выбрать любую палитру на свой вкус. Всего доступно 54 варианта расцветок для игры.\r\n\r\nhttps://www.youtube.com/watch?v=EAtXod6mBtg&feature=emb_imp_woyt&ab_channel=Retrovibe\r\n\r\nСинопсис:\r\n\r\nB.I.O.T.A. — это 2D-метроидвания, в которой вы управляете отрядом наемников, зачищающих шахтерскую колонию от инопланетной заразы. Исследуйте пиксельный мир, полный мутантов и смертельных ловушек. Используйте большой арсенал оружия и техники, включая меха-костюм, субмарину и звездолет.\r\n\r\nВозглавьте отряд из 8 матерых наемников. Переключайтесь между персонажами, используйте их уникальное оружие и навыки. Расследуйте происшествие в шахтерской колонии, охваченной инопланетной заразой. Истребляйте более 40 видов отвратных монстров, мутировавших из несчастных шахтеров. Спасите ученых и раскройте грязные секреты корпорации V-corp.\r\n\r\nB.I.O.T.A. выйдет 12 апреля на PC.', 'Левенчук Владислав'),
(37, '2022-10-19 18:03:44', 'Новость дня', 'Мы болеем, но не сдаемся', 'Владислав Левенчук'),
(38, '2022-10-19 20:13:55', 'Новость вечера ', 'Люблю тебя мышка ', 'Кобец Юлия '),
(39, '2022-10-29 20:49:11', 'Мы хотим мазду 3 bk', 'Я и Артем подумываем взять эту крутую тачку.', 'Владислав и Артем'),
(43, '2022-11-12 20:28:23', 'Алина приехала к нам в гости!)', 'Проводим вечерочек, все уютно и прекрасно.', 'Алина Качур');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(16) NOT NULL,
  `age` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(16) NOT NULL,
  `user_type` enum('user','admin') NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `age`, `phone`, `password`, `user_type`, `email`) VALUES
(7, 'Andrey', '', '', '123', 'user', ''),
(29, 'Владислав', '24', '+375 (25) 123-45-67', '12345', 'user', 'v.levenchuk@mail.ru'),
(32, 'Vlad', '', '', '123', 'user', 'v.levenchuk@mail.ru'),
(36, 'Soyund', '', '', '1Q2W3E4R5T6Y', 'user', 'greg-cobaka@mail.ru'),
(78, 'Люля', '23', '+375 (25) 123-45-67', '27031999', 'user', 'ju.kobets@mail.ru'),
(89, 'admin', '', '', '123', 'admin', 'v.levenchuk@mail.ru'),
(90, 'Julia', '', '', '123', 'user', 'julchuk@yandex.ru'),
(91, 'Artem', '     25  ', '+375 (25) 123-45-67', '111111', 'user', 'artem_buevich@bk.ru'),
(93, 'kobets', '', '', '11051969', 'user', 'kobets-30@tut.bu'),
(95, 'Анастасия', '', '', '123456789', 'user', 'buevich.nastya2011@yandex.ru'),
(96, 'Kathrine', '', '', '11111', 'user', 'katiaklimuk@gmail.com');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
