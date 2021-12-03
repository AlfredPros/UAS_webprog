-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2021 at 08:41 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `day_taken` (`id` INT, `start_date` DATE, `end_date` DATE) RETURNS TINYINT(1) BEGIN
    DECLARE finished INTEGER DEFAULT 0;
    declare temp1 DATE;
    declare temp2 date;
    declare ans BOOLEAN;


DEClARE curReq 
CURSOR FOR 
SELECT start_time, end_time FROM request WHERE status = 1 AND id_book = id;


DECLARE CONTINUE HANDLER 
        FOR NOT FOUND SET finished = 1;
    
    SET ans = false;

    OPEN curReq;
         check_day: LOOP
            FETCH curReq INTO temp1, temp2;
            IF finished = 1 THEN 
                LEAVE check_day;
            END IF;
            if (start_date >= temp1 AND start_date <= temp2) OR (end_date >= temp1 AND end_date <= temp2) then
              SET ans = true;
              LEAVE check_day;
            end if;
            SET temp1 = '';
            SET temp2 = '';
    END LOOP check_day;
    CLOSE curReq;

    RETURN ans;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `list_book`
--

CREATE TABLE `list_book` (
  `id_book` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `year` int(4) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `link_cover` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `list_book`
--

INSERT INTO `list_book` (`id_book`, `title`, `year`, `author`, `publisher`, `link_cover`, `description`) VALUES
(10, 'Demon Slayer: Kimetsu no Yaiba Volume 01', 2018, 'Koyoharu Gotōge', 'Viz Media', 'assets/cover/76b2c5bcd11ba181fbda44c870ac74af.png', 'In Taisho-era Japan, Tanjiro Kamado is a kindhearted boy who makes a living selling charcoal. However, his peaceful life is shattered when a Demon slaughters his entire family. His little sister Nezuko is the only survivor, but she has been transformed into a Demon herself! Tanjiro sets out on a dangerous journey to find a way to return his sister to normal and destroy the Demon who ruined his life.\r\nLearning to slay Demons won’t be easy, and Tanjiro barely knows where to start. The surprise appearance of another individual named Giyu Tomioka might provide some answers… but only if Tanjiro can stop Giyu from killing his sister first!'),
(11, 'Demon Slayer: Kimetsu no Yaiba Volume 02', 2018, 'Koyoharu Gotōge', 'Viz Media', 'assets/cover/cb32f3fd698151254c26a230949fbe69.png', 'During the Final Selection test that must be passed to join the Demon Slayer Corps, Tanjiro faces a disfigured Demon and uses the techniques taught by his master, Sakonji Urokodaki! As Tanjiro begins to walk the path of a Demon Slayer, his search for the Demon who murdered his family leads him to investigate the disappearances of young girls in a nearby town.'),
(12, 'Demon Slayer: Kimetsu no Yaiba Volume 03', 2018, 'Koyoharu Gotōge', 'Viz Media', 'assets/cover/5f8f48d9a9679ce13494e1399b235177.png', 'Tanjiro and Nezuko cross paths with two powerful Demons that fight with magical weapons. Even help from Tamayo and Yushiro may not be enough to defeat these Demons who claim to be a part of the Twelve Demon Moons that directly serve Muzan Kibutsuji, the Demon responsible for all of Tanjiro\'s woes! But, if these Demons can be defeated, what secrets can they reveal about Muzan?'),
(13, 'Demon Slayer: Kimetsu no Yaiba Volume 04', 2019, 'Koyoharu Gotōge', 'Viz Media', 'assets/cover/3dc8e7c6188888282c1bfe6cd4bf3b6e.png', 'Tanjiro and Nezuko cross paths with two powerful Demons that fight with magical weapons. Even help from Tamayo and Yushiro may not be enough to defeat these Demons who claim to be a part of the Twelve Demon Moons that directly serve Muzan Kibutsuji, the Demon responsible for all of Tanjiro\'s woes! But, if these Demons can be defeated, what secrets can they reveal about Muzan?'),
(14, 'Demon Slayer: Kimetsu no Yaiba Volume 05', 2019, 'Koyoharu Gotōge', 'Viz Media', 'assets/cover/643581495cd9dd1e87574e63777aa0ce.png', 'At Natagumo Mountain, Tanjiro, Zenitsu and Inosuke battle a terrible family of spider Demons. Taking on such powerful enemies demands all the skill and luck Tanjiro has as he and his companions fight to rescue Nezuko from the spiders\' web. The battle is drawing in other Demon Slayers but not all of them will leave Natagumo Mountain alive… or in one piece!'),
(15, 'Boredom: Death Note Volume 01', 2005, 'Tsugumi Ohba and Takeshi Obata', 'Viz Media', 'assets/cover/3c3d9e00b11ed32ba19caf35c608d660.jpg', 'Light tests the boundaries of the Death Note\'s powers as L and the police begin to close in. Luckily Light\'s father is the head of the Japanese National Police Agency and leaves vital information about the case lying around the house. With access to his father\'s files, Light can keep one step ahead of the authorities. But who is the strange man following him, and how can Light guard against enemies whose names he doesn\'t know?'),
(16, 'Confluence: Death Note Volume 02', 2005, 'Tsugumi Ohba and Takeshi Obata', 'Viz Media', 'assets/cover/2dcfb9b623d6f2983d8f189c4b7651f9.jpg', 'Light thinks he\'s put an end to his troubles with the FBI—by using the Death Note to kill off the FBI agents working the case in Japan! But one of the agents has a fiancée who used to work in the Bureau, and now she\'s uncovered information that could lead to Light\'s capture. To make matters worse, L has emerged from the shadows to work directly with the task force headed by Light\'s father. With people pursuing him from every direction, will Light get caught in the conflux?'),
(17, 'Hard Run: Death Note Volume 03', 2006, 'Tsugumi Ohba and Takeshi Obata', 'Viz Media', 'assets/cover/b6044478e213c5cbd8c0c87cefd68bb6.jpg', 'Light is chafing under L\'s extreme surveillance, but even 64 bugs and cameras hidden in his room aren\'t enough to stop Light. He steps up the game, but before the battle of wits can really begin, a family emergency distracts him. But even though Light isn\'t using the Death Note right now, someone else is! Who\'s the new \"Kira\" in town?'),
(18, 'Love: Death Note Volume 04', 2006, 'Tsugumi Ohba and Takeshi Obata', 'Viz Media', 'assets/cover/dd3f306844c0e06fb55954a4a991c9a8.jpg', 'With two Kiras on the loose, L asks Light to join the task force and pose as the real Kira in order to catch the copycat. L still suspects Light, and figures that this is the perfect excuse to get closer to his quarry. Light agrees to the plan in order to have free access to the task force resources. But when Light manages to contact the new Kira, he discovers that his rival is anything but as expected. Will Light escape from love unscathed?'),
(19, 'Whiteout: Death Note Volume 05', 2006, 'Tsugumi Ohba and Takeshi Obata', 'Viz Media', 'assets/cover/36aea8079ff98689aae33cc096aa79ba.jpg', 'After a week locked up with no one but Ryuk for company, Light is ready to give up his Death Note and all memories of it. Freed from his past actions, Light is convinced he\'s innocent. But L is ready to keep Light under lock and key forever, especially since the killings stopped once Light was incarcerated. Then a new wave of Kira crimes hits Japan. Someone else has gotten their hands on a Death Note, and these new deaths aren\'t focused on making the world a better place, they\'re focused on making money. Big business can be murder, and Kira has gone corporate!'),
(20, 'Komi Can\'t Communicate Volume 01', 2019, 'Tomohito Oda', 'Viz Media', 'assets/cover/9057c2978d9e61fe3d57aab6a6b4ec86.png', 'The journey to 100 friends begins with a single conversation.\r\nSocially anxious high school student Shoko Komi’s greatest dream is to make some friends, but everyone at school mistakes her crippling social anxiety for cool reserve! With the whole student body keeping their distance and Komi unable to utter a single word, friendship might be forever beyond her reach.\r\nTimid Tadano is a total wallflower, and that’s just the way he likes it. But all that changes when he finds himself alone in a classroom on the first day of high school with the legendary Komi. He quickly realizes she isn’t aloof—she’s just super awkward. Now he’s made it his mission to help her on her quest to make 100 friends!'),
(21, 'Komi Can\'t Communicate Volume 02', 2019, 'Tomohito Oda', 'Viz Media', 'assets/cover/75e5cde439fed71171ffb9a0e2f337da.png', 'It’s time for the national health exam at Itan High, and the excitement of eye exams and height measurements have fanned the flames of competition for plain jane Makeru Yadano. She’s determined to beat the class idol Komi in the health test, and Komi’s total obliviousness to their impassioned duel just feeds Makeru’s determination. As the epic battle heats up, how will Komi handle her first rival when she’s barely made her first friends?!'),
(22, 'Komi Can\'t Communicate Volume 03', 2019, 'Tomohito Oda', 'Viz Media', 'assets/cover/21a08806cf85d6e5529dc20274dd336d.png', 'Summer is about to begin, and Komi would love to be able to spend the long, hot vacation days hanging out with her new friends. But even though she’s made great strides in her personal quest, she still has problems communicating. For instance, making phone calls is so anxiety provoking that it keeps her up at night. Thankfully, Tadano always seems to know how to help her calm down!'),
(23, 'Komi Can\'t Communicate Volume 04', 2019, 'Tomohito Oda', 'Viz Media', 'assets/cover/0a141b943396df3b336ee9af8b184fb3.png', 'School is out for the summer, and Komi is still getting used to this strange new world of having friends. She’s discovering that friendship doesn’t automatically save you from awkward situations with people, but the more time she spends with her friends, the easier it all seems. And to her astonishment, for the first time in her life Komi isn’t anxious for summer to end.'),
(24, 'Komi Can\'t Communicate Volume 05', 2020, 'Tomohito Oda', 'Viz Media', 'assets/cover/fedb072a262f7684d6b880d910942362.png', 'Komi’s friendship quest just hit its first major obstacle—the green-eyed monster! Tadano and a girl named Onemine have been hanging out a lot lately, and Komi doesn’t know how to deal with her sudden flood of jealousy. She can’t explain what’s wrong, so she ends up spying on them from the shadows. Will her creepy peeping lose her a chance at a new friend and push Tadano away?'),
(25, 'My Hero Academia Volume 01', 2015, 'Kōhei Horikoshi', 'Viz Media', 'assets/cover/897547b690cef6bde63ed4473d70e613.png', 'Middle school student Izuku Midoriya wants to be a hero more than anything, but he hasn’t got an ounce of power in him. With no chance of ever getting into the prestigious U.A. High School for budding heroes, his life is looking more and more like a dead end. Then an encounter with All Might, the greatest hero of them all, gives him a chance to change his destiny…'),
(26, 'My Hero Academia Volume 02', 2015, 'Kōhei Horikoshi', 'Viz Media', 'assets/cover/3e7fc58050c944aaf48bea2eecdc601e.png', 'Getting into U.A. High School was difficult enough, but it was only the beginning of Izuku’s long road toward becoming a superhero. The new students all have amazing powers, and although Izuku has inherited All Might’s abilities, he can barely control them. What’s more, the first-year students are told they will have to compete just to avoid being expelled!'),
(27, 'My Hero Academia Volume 03', 2016, 'Kōhei Horikoshi', 'Viz Media', 'assets/cover/603afeb4288c8c6c7ed5c5a832023627.png', 'A sinister group of villains has attacked the first-year U.A. students, but their real target is All Might. It’s all that Midoriya and his classmates can do to hold them off until reinforcements arrive. All Might joins the battle to protect the kids, but as his power runs out, he may be forced into an extremely dangerous bluff!'),
(28, 'My Hero Academia Volume 04', 2016, 'Kōhei Horikoshi', 'Viz Media', 'assets/cover/bbdd8bd13274579b7499ccb315dc3f58.png', 'The U.A. High sports festival is a chance for the budding heroes to show their stuff and find a superhero mentor. The students have already struggled through a grueling preliminary round, but now they have to team up to prove they’re capable of moving on to the next stage. The whole country is watching, and so are the shadowy forces that attacked the academy…'),
(29, 'My Hero Academia Volume 05', 2016, 'Kōhei Horikoshi', 'Viz Media', 'assets/cover/b3e67a89574350438a1514421d7ce1ba.png', 'The final stages of the U.A. High sports festival promise to be explosive, as Ochaco takes on Katsuki in a head-to-head match! Katsuki never gives anyone a break, and the crowd holds its breath as the battle begins. The finals will push the students of Class 1-A to their limits and beyond!'),
(30, 'Blue Period Volume 01', 2020, 'Tsubasa Yamaguchi', 'Kodansha', 'assets/cover/415b20fce8f02b4c29b8374b06e8f9a5.jpg', 'Yatora is the perfect high school student, with good grades and lots of friends. It\'s an effortless performance, and, ultimately... a dull one. But he wanders into the art room one day, and a lone painting captures his eye, awakening him to a kind of beauty he never knew. Compelled and consumed, he dives in headfirst—and he\'s about to learn how savage and unforgiving art can be...'),
(31, 'Blue Period Volume 02', 2021, 'Tsubasa Yamaguchi', 'Kodansha', 'assets/cover/2bbc98eb3114a8577b214b483ece2199.jpg', 'Art has changed the course of Yatora\'s once dull life, and now he\'s aiming for Japan\'s most competitive art school. With entrance exams a year away, he\'ll need to expand his limited eye for art, and quickly. He turns to new peers and the masters to envision pieces only he can produce, and soon dives into his first competition—the same one where his Art Club role model nearly scored last place. Among geniuses and lifelong art kids, does Yatora even stand a chance...?'),
(32, 'Blue Period Volume 03', 2021, 'Tsubasa Yamaguchi', 'Kodansha', 'assets/cover/45329d491cf5467d206d01b939423737.jpg', 'Relief is short-lived for Yatora after his first competition, where his piece ranks higher than expected but is far from his dream school’s standards. He’s prepared to give Ooba-sensei’s challenges everything he’s got…but what if all he’s got is still not enough? With 100 days until university exams, Yatora must toil to produce a piece only he can.'),
(33, 'Blue Period Volume 04', 2021, 'Tsubasa Yamaguchi', 'Kodansha', 'assets/cover/edba2ed0d13c667aed0921840d3893ae.jpg', 'Yatora now has new materials in his tool box and a wider range of expression under his belt. But a week before the first exam, Ooba-sensei says he’s missing a crucial edge… With so much at stake, Yatora’s self-doubt brings him lower than ever before. Still, he has his fire, his resilience—and he might just get a lucky break, too.'),
(34, 'Blue Period Volume 05', 2021, 'Tsubasa Yamaguchi', 'Kodansha', 'assets/cover/2f056fdfcbada5d6ef7eaeefd459ac8e.jpg', 'Yatora makes the best of a bad situation during TUA\'s first exam, and he must surpass these efforts for the second. But after all he’s gone through, Yatora is feeling a little out of sorts. To get back on track, he’ll have to step out of the studio and into new lighting… With the help of an old friend, Yatora bares his soul and some skin to take on his latest challenge: the nude self-portrait.'),
(35, 'SPY x FAMILY Volume 01', 2020, 'Tatsuya Endo', 'Viz Media', 'assets/cover/cb160b15f5d655395fd9d6759f04f3e9.png', 'Master spy Twilight is unparalleled when it comes to going undercover on dangerous missions for the betterment of the world. But when he receives the ultimate assignment—to get married and have a kid—he may finally be in over his head!\r\n\r\nNot one to depend on others, Twilight has his work cut out for him procuring both a wife and a child for his mission to infiltrate an elite private school. What he doesn\'t know is that the wife he\'s chosen is an assassin and the child he\'s adopted is a telepath!'),
(36, 'SPY x FAMILY Volume 02', 2020, 'Tatsuya Endo', 'Viz Media', 'assets/cover/0499a0c4036d2d9be40301def3145177.png', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions for the betterment of the world. But when he receives the ultimate assignment—to get married and have a kid—he may finally be in over his head!\r\n\r\nTwilight must infiltrate the prestigious Eden Academy to get close to his target Donovan Desmond, but has he ruined his daughter Anya\'s chances with his outburst during the admissions interview? Perhaps the truly impossible mission this time is making sure Anya both becomes an exemplary student and befriends Donovan’s arrogant son, Damian!'),
(37, 'SPY x FAMILY Volume 02', 2020, 'Tatsuya Endo', 'Viz Media', 'assets/cover/fc37247d1b25c6a28696d14f5663c822.png', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head!\r\n\r\nTwilight has overcome many challenges in putting together the Forger family, but now all his hard work might come undone when Yor’s younger brother Yuri pops in for a surprise visit! Can Twilight outsmart Yuri, who actually works for the Ostanian secret service?!'),
(38, 'SPY x FAMILY Volume 03', 2021, 'Tatsuya Endo', 'Viz Media', 'assets/cover/0043e9eb25b696b3aef323ebbb390b4a.png', 'Master spy Twilight is the best at what he does when it comes to going undercover on dangerous missions in the name of a better world. But when he receives the ultimate impossible assignment—get married and have a kid—he may finally be in over his head!\r\n\r\nThe Forgers look into adding a dog to their family, but this is no easy task—especially when Twilight has to simultaneously foil an assassination plot against a foreign minister! The perpetrators plan to use specially trained dogs for the attack, but Twilight gets some unexpected help to stop these terrorists.'),
(39, 'SPY x FAMILY Volume 05', 2021, 'Tatsuya Endo', 'Viz Media', 'assets/cover/b9aef9b6fab26912b5f6f724e1fe3b86.png', 'Master spy Twilight is unparalleled when it comes to going undercover on dangerous missions for the betterment of the world. But when he receives the ultimate assignment—to get married and have a kid—he may finally be in over his head!\r\n\r\nAnya Forger has been trying her best to befriend Damian Desmond, the son of the powerful Ostanian political leader Donovan Desmond. But her attempts have been constantly rebuffed. Despite the setbacks, Anya is determined to gain access to the Desmonds’ inner circle and devises a new plan—acing her midterm exams! Can the academically challenged Anya pull off this feat for the sake of world peace?'),
(40, 'The Case Study of Vanitas Volume 01', 2017, 'Jun Mochizuki', 'Yen Press', 'assets/cover/f8b34883b5480fcd0ef70fa020604187.png', 'Rumors revolving around The Book of Vanitas, a clockwork grimoire of dubious reputation, draw Noé, a young vampire in search of a friend\'s salvation, to Paris. What awaits him in the City of Flowers, however, is not long hours treading the pavement or rifling through dusty bookshops in search of the tome. Instead, his quarry comes to him...in the arms of a man claiming to be a vampire doctor! Thrust into a conflict that threatens the peace between humans and vampires, will Noé cast in his lot with the curious and slightly unbalanced Vanitas and his quest to save vampirekind?'),
(41, 'The Case Study of Vanitas Volume 02', 2017, 'Jun Mochizuki', 'Yen Press', 'assets/cover/42820864ce29a410445aa4ac4912fe23.png', 'Now installed at a hotel in Paris with the help of Count Orlok, Noe and Vanitas take their awkward partnership on the road...to a vampire masquerade ball! The order of the evening may be small talk and hobnobbing with fellow guests, but the mystery of the curse-bearers is never far behind. Intrigue swirls as quickly as the dancers twirl, a blue moon ascends over the guests...and all hell breaks loose!'),
(42, 'The Case Study of Vanitas Volume 03', 2017, 'Jun Mochizuki', 'Yen Press', 'assets/cover/e5dc7041211511f27e8cec266226ef75.jpg', 'The masked ball has ended, but the music plays on. As Noe and Vanitas return disgraced from Altus, the curtain rises on a new battle. News of kidnapped curse-bearers sends the pair to the catacombs beneath the streets of Paris, where a melody of intrigue echoes and a superhuman foe awaits! Humans or vampires: Who will be the hunter, and who the hunted?'),
(43, 'The Case Study of Vanitas Volume 04', 2018, 'Jun Mochizuki', 'Yen Press', 'assets/cover/3f300d990f41e279805f51aa084382b6.jpg', 'Deep within the bowels of Paris, Noé and Vanitas race through the catacombs with an elite team of Chasseurs, the Church\'s anti-vampire unit, in hot pursuit. Their search for the missing vampires takes the pair down a path all too familiar to Vanitas, bringing them face-to-face with not only an overwhelming curse-bearer but also Vanitas\'s past. Confronted by the horrific menace, what will Noé and Vanitas fight for, and whom will they save...?'),
(44, 'The Case Study of Vanitas Volume 05', 2018, 'Jun Mochizuki', 'Yen Press', 'assets/cover/ee619beaed27d03192e6bdb1391aca12.jpg', 'The Beast of Gévaudan, which once plunged France into terror, has risen again in the nineteenth century. As Vanitas and the others investigate the relationship between the Beast and the vampires, they find their way barred by the paladin Astolfo and Jeanne, the Hellfire Witch. Who is it that laughs in a world blanketed white...?'),
(45, 'Hinata and Kageyama: Haikyuu!! Volume 01', 2016, 'Haruichi Furudate', 'Viz Media', 'assets/cover/5ce483253ca6feac18ca2505bf6ccf10.jpg', 'I can fly!! Shōyo Hinata has always been fascinated with volleyball. As such, when he was finally able to play his first official game during the end the regular season, he was excited. However, that game would turn out to be a crushing defeat against Tobio Kageyama, a genius player nicknamed the “king of the court.” Although Hinata lost, he vowed to seek revenge against Kageyama in high school. To his surprise, though, he discovered that Kageyama also enrolled in high school. Now instead of being rivals, he and Kageyama would now work together as teammates. Will they be able to put their differences aside to play volleyball?'),
(46, 'The View from the Top: Haikyuu!! Volume 02', 2016, 'Haruichi Furudate', 'Viz Media', 'assets/cover/5ba1c9eef18f965ad19a33f2ce7949d6.png', 'Ever since he saw the legendary player known as the \"Little Giant\" compete at the national volleyball finals, Shoyo Hinata has been aiming to be the best volleyball player ever! He decides to join the team at the high school the Little Giant went to-and then surpass him. Who says you need to be tall to play volleyball when you can jump higher than anyone else?\r\nAfter proving themselves to be the ultimate combination in their practice match against Kei Tsukishima, Kageyama and Hinata are finally allowed to join the club! Hinata’s true power—to perfectly time his spikes with his eyes closed—is awakened, and nothing can seem to stop this crazy setter-spiker duo. Now their skills are about to be put to the test at a practice game against one of Kageyama’s former teammates from middle school, Tohru Oikawa.'),
(47, 'Go, Team Karasuno!: Haikyuu!! Volume 03', 2016, 'Haruichi Furudate', 'Viz Media', 'assets/cover/613268bc1e068b79fe99f6398462463f.jpg', 'Karasuno has successfully defeated Tōru Oikawa and Aoba Johsai in their practice match, but the team\'s future doesn’t look so bright. The match uncovered serious holes in Karasuno’s defense, which would be fatal in a real game! What they need is a defense expert, a libero, to cover their holes for them. It turns out Karasuno does have a libero named Yu Nishinoya, but he was suspended for one week for violent behavior! And he\'s even shorter than Hinata!'),
(48, 'Rivals!: Haikyuu!! Volume 04', 2016, 'Haruichi Furudate', 'Viz Media', 'assets/cover/a97d7427807d848ee4d27e665ad87859.jpg', 'The training camp kicks off with a bang! Hinata and his teammates train their hearts out in preparation for the practice game against Nekoma, but they\'ll need to polish their receiving skills if they want to win. Then finally, after all their hard work, the moment they’ve all been waiting for arrives—the revival of the long-standing rivalry between the cats and the crows! And Nekoma’s starting setter looks vaguely familiar…'),
(49, 'Inter-High Begins!: Haikyuu!! Volume 05', 2016, 'Haruichi Furudate', 'Viz Media', 'assets/cover/68db4684adbc3ee74ff15d4c23f5c4dd.jpg', 'Having lost all of their practice games against Nekoma, the cracks in Karasuno’s teamwork are more apparent than ever! With Inter-High qualifiers looming over them, Hinata, Kageyama and the rest of the team need to work hard to stand a chance. But with two of the prefecture\'s top four schools in their qualifier block, Karasuno’s chances look slim. How will they overcome this challenge when just thinking about their second opponent, Date Tech, makes Karasuno\'s ace, Asahi, tremble in fear?'),
(50, 'Ryomen Sukuna: Jujutsu Kaisen Volume 01', 2019, 'Gege Akutami', 'Viz Media', 'assets/cover/f60d771e81dfc1e595fbb99f481eb6cc.png', 'Although Yuji Itadori looks like your average teenager, his immense physical strength is something to behold! Every sports club wants him to join, but Itadori would rather hang out with the school outcasts in the Occult Research Club.\r\nOne day, the club manages to get their hands on a sealed cursed object. Little do they know the terror they’ll unleash when they break the seal...'),
(51, 'Fearsome Womb: Jujutsu Kaisen Volume 02', 2020, 'Gege Akutami', 'Viz Media', 'assets/cover/f900c3c1df2f115c442b0454e8964403.png', 'When a cursed womb appears at a detention facility, Jujutsu High dispatches Itadori and the other first-years to handle the situation. However, the Curse they encounter is far stronger than they ever expected! Itadori and friends now have two options: run and maybe live, or fight and die. While they are distracted, powerful Curses with mysterious designs on Jujutsu High and Satoru Gojo are gathering…'),
(52, 'Young Fish and Reverse Punishment: Jujutsu Kaisen Volume 03', 2020, 'Gege Akutami', 'Viz Media', 'assets/cover/0b38f8e42c3cb9caa7bd4d730ae0363e.png', 'Tensions are high as the Kyoto Goodwill Event between the Tokyo and Kyoto campuses of Jujutsu High approaches. But before the competition can even begin, a couple of Kyoto students confront Fushiguro and Kugisaki. Meanwhile, Yuji’s training gets interrupted by a mysterious crime involving grotesque bodily alterations caused by a Cursed Spirit...'),
(53, 'I\'m Gonna Kill You!: Jujutsu Kaisen Volume 04', 2020, 'Gege Akutami', 'Viz Media', 'assets/cover/d6a75a80a7900efb61c744ac5f91c345.png', 'While investigating a strange set of mysterious deaths, Itadori meets Junpei, a troubled kid who is often bullied at school. However, Junpei is also befriended by the culprit behind the bloody incident—Mahito, a mischievous cursed spirit! Mahito sets in motion a devious plan involving Junpei, hoping to ensnare Itadori as well.'),
(54, 'Kyoto Sister School Goodwill Event: Jujutsu Kaisen Volume 05', 2020, 'Gege Akutami', 'Viz Media', 'assets/cover/a15eae7200e1b1ac0a04de896c18335d.png', 'Everyone’s surprised (and not necessarily in a good way) when they find out Itadori is still alive, but there’s no time for a heartwarming reunion when Jujutsu High is in the midst of an intense competition with their rivals from Kyoto! But good sportsmanship doesn’t seem to be in the cards once the authorities decide to eliminate the Sukuna threat once and for all...'),
(55, 'Wotakoi: Love is Hard for Otaku Wiki Volume 01', 2018, 'Fujita', 'Kodansha', 'assets/cover/0733eee9524798dd04522c5efeb2ffe2.jpg', 'Narumi Momose has had it rough: Every boyfriend she\'s had dumped her once they found out she was an otaku, so she\'s gone to great lengths to hide it. When a chance meeting at her new job with childhood friend, fellow otaku, and now coworker Hirotaka Nifuji almost gets her secret outed at work, she comes up with a plan to make sure he never speaks up. But he comes up with a counter-proposal: Why doesn\'t she just date him instead?\r\nIn love, there are no save points.'),
(56, 'Wotakoi: Love is Hard for Otaku Wiki Volume 02', 2018, 'Fujita', 'Kodansha', 'assets/cover/e21cf74f7bcd37eec138961e642a6d36.jpg', 'Frustrated at the slow pace of their relationship, Hirotaka asks Narumi on a real date, with one critical stipulation: they can’t show their otaku sides at all! Can the two find something to bond over in the absence of games, manga, and anime? Meanwhile, Hanako and Taro revisit the origins of their own tempestuous relationship back when they were in high school, and even Naoya seems to be spending more time with a new friend!'),
(57, 'Wotakoi: Love is Hard for Otaku Wiki Volume 03', 2018, 'Fujita', 'Kodansha', 'assets/cover/99cba020e3ba91e69e4e31faea448407.jpg', 'Narumi and Hirotaka\'s relationship is going swimmingly, so now the two have a new problem: the rumor mill. The couple is going to have to rely on Hirotaka\'s reputation as an undateable gamer to quash the gossip, because it\'s shaping up to be a busy summer. There\'s a double date with Hanako and Taro at a festival, Narumi\'s first try at cosplaying, and even that otaku classic: a hot springs episode. Meanwhile, when Naoya\'s incredible misunderstanding about his new friend Ko comes to a head, will their friendship survive?'),
(58, 'Wotakoi: Love is Hard for Otaku Wiki Volume 04', 2018, 'Fujita', 'Viz Media', 'assets/cover/465571298950ad011070ca43f20f5b60.jpg', 'Frustrated at the slow pace of their relationship, Hirotaka asks Narumi on a real date, with one critical stipulation: They can\'t show their otaku sides at all! Can the two find something to bond over in the absence of games, manga, and anime? Meanwhile, Hanako and Taro revisit the origins of their own tempestuous relationship back when they were in high school, and even Naoya seems to be spending more time with a new friend!'),
(59, 'Wotakoi: Love is Hard for Otaku Wiki Volume 05', 2018, 'Fujita', 'Kodansha', 'assets/cover/e2bdc04cb25519ef108673c9e3a9ad78.jpg', 'Narumi and Hirotaka\'s relationship is going swimmingly, so now the two have a new problem: the rumor mill. The couple is going to have to rely on Hirotaka\'s reputation as an undateable gamer to quash the gossip, because it\'s shaping up to be a busy summer. There\'s a double date with Hanako and Taro at a festival, Narumi\'s first try at cosplaying, and even that otaku classic: a hot springs episode. Meanwhile, when Naoya\'s incredible misunderstanding about his new friend Ko comes to a head, will their friendship survive?');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id_request` int(11) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_book` bigint(20) NOT NULL,
  `start_time` date NOT NULL DEFAULT current_timestamp(),
  `end_time` date NOT NULL,
  `status` char(1) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id_request`, `id_user`, `id_book`, `start_time`, `end_time`, `status`) VALUES
(1, 12, 35, '2021-12-03', '2021-12-04', '1'),
(2, 12, 10, '2021-12-06', '2021-12-08', '1'),
(3, 12, 17, '2021-12-09', '2021-12-11', '0'),
(4, 12, 12, '2021-12-05', '2021-12-11', '1'),
(5, 12, 11, '2021-12-19', '2021-12-23', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` bigint(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'User',
  `link_profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `password`, `name`, `role`, `link_profile`) VALUES
(10, 'admin@mangabook.co.id', '230c10966dac70e649608a79aa4e0aad9c14eabf8e2f70841bb11a4d182dc9c47ad95e0568ee9dcbc3a59a4f682f03e65af6dc28deddd8cc7b6f21db83cf21d6', 'Adhitya Bagus Wicaksono', 'Admin', 'assets/pp/a9980146bff0b6ea5466e6449dbb6657.png'),
(11, 'manager@mangabook.co.id', '426114f3fd4ce24eac84f5f246bae01a0112684c3b547b6247fa094a1efd7416703d07024f4bde0ea3f37c466c0d46b96ec6c51daa01c82740fad87c244a6184', 'Alfred Kuhlman', 'Manager', 'assets/pp/ad2a7a1a2efd80b5a3a4304afb46fe5d.jpg'),
(12, 'user@mangabook.co.id', '0f8b1233b81fc50b2e02224fe0c7d33e21c170c1f7f91b4661e524abdda044899a099c27c4b9e817ace7e74da23c57256c80f06980b77b6b2f9a855ccdbd69d4', 'Loysing Ryono Ismanto', 'User', 'assets/pp/6410b3fe38dadf79d12db2c627dd59ad.gif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list_book`
--
ALTER TABLE `list_book`
  ADD PRIMARY KEY (`id_book`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id_request`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_buku` (`id_book`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list_book`
--
ALTER TABLE `list_book`
  MODIFY `id_book` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`id_book`) REFERENCES `list_book` (`id_book`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
