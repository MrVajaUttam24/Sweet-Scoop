-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 22, 2025 at 03:01 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icecreamshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admintbl`
--

DROP TABLE IF EXISTS `admintbl`;
CREATE TABLE IF NOT EXISTS `admintbl` (
  `sr` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(12) NOT NULL,
  PRIMARY KEY (`sr`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admintbl`
--

INSERT INTO `admintbl` (`sr`, `username`, `password`) VALUES
(1, 'uttam', '1108'),
(2, 'priti', '2412'),
(3, 'vidya', '2611'),
(4, 'vidya', '2611'),
(5, 'vidya', '2611');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`name`, `email`, `description`) VALUES
('priti parmar', 'priti11@gmail.com', 'your flavors are world class please maintain your teste. I will visit again your sweet scoop thank you.');

-- --------------------------------------------------------

--
-- Table structure for table `custom_icecream_order`
--

DROP TABLE IF EXISTS `custom_icecream_order`;
CREATE TABLE IF NOT EXISTS `custom_icecream_order` (
  `sr` int(3) NOT NULL AUTO_INCREMENT,
  `customername` varchar(50) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `selected_flavor` varchar(15) NOT NULL,
  `size` varchar(10) NOT NULL,
  `toppings` varchar(350) NOT NULL,
  `quantity` int(3) NOT NULL,
  `price` int(5) NOT NULL,
  PRIMARY KEY (`sr`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custom_icecream_order`
--

INSERT INTO `custom_icecream_order` (`sr`, `customername`, `contact`, `address`, `selected_flavor`, `size`, `toppings`, `quantity`, `price`) VALUES
(1, 'priti parmar', '8723874874', 'vanand society, porbandar', 'Chocolate', '200ml', 'Almond, Candy Bar, Cashew, Choco Chips, Hot Fudge, Jems Candy, Mango, Peacan, Pistachio, Butterscotch Chips, White Chocolate Chips, Mango Puree, Chocolate Shavings, Yogurt Chips, Crushed Peanuts, Espresso Drizzle, Chocolate Rice Balls, Cookie Dough Balls', 1, 340),
(6, 'vatsal bhatti', '8237874387', 'vagheshwari road, porbandar', 'Vanilla', '200ml', 'Blueberry, Toffee Bits, Waffle Cone Pieces, Brown Sugar Crystals, Dried Cranberries, Kiwi Slices, Banana Slices, Gold Sprinkles', 1, 165),
(4, 'rushi thanki', '9832349844', 'rajivnagar, porbandar', 'Vanilla', '500ml', 'Cherries, Marshmallow, Oreo Crumbles, Toffee Bits, Waffle Cone Pieces, Brown Sugar Crystals', 3, 495),
(5, 'vidya lakhani', '8239898429', 'miranagar, porbandar', 'Chocolate', '1 Liter', 'Almond, Candy Bar, Cashew, Cherries, Choco Chips, Marshmallow, Peacan, Pistachio, Oreo Crumbles, Toffee Bits, Waffle Cone Pieces, Brown Sugar Crystals', 2, 690),
(7, 'maharshi pandya', '9832748334', 'khapat, porbandar', 'Chocolate', '200ml', 'Caramel Drizzle', 1, 70),
(8, 'utsav gohel ', '2732829382', 'kamlabag, porbandar', 'Chocolate', '200ml', 'Almond, Blueberry, Brownie', 1, 105),
(9, 'rutvik gotecha', '9238939384', 'paras nagar, porbandar', 'Vanilla', '200ml', 'Almond, Blueberry, Brownie, Cherries, Cookie, Granola', 2, 260);

-- --------------------------------------------------------

--
-- Table structure for table `flavors`
--

DROP TABLE IF EXISTS `flavors`;
CREATE TABLE IF NOT EXISTS `flavors` (
  `sr` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `image` varchar(100) NOT NULL,
  `discription` varchar(100) NOT NULL,
  `cone` int(3) NOT NULL,
  `candy` int(3) NOT NULL,
  `cup` int(3) NOT NULL,
  `familypack` int(3) NOT NULL,
  PRIMARY KEY (`sr`)
) ENGINE=MyISAM AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flavors`
--

INSERT INTO `flavors` (`sr`, `name`, `image`, `discription`, `cone`, `candy`, `cup`, `familypack`) VALUES
(1, 'Almond Avalanche', 'uploads/flavor_6837f9ee1227d.jpg', 'A nutty explosion of almond chunks in rich creamy goodness.', 70, 55, 85, 275),
(2, 'Almond Butter Scoop', 'uploads/flavor_6837fa389f06a.jpg', 'Smooth almond butter blended into a silky sweet base.\r\n', 65, 45, 80, 260),
(3, 'Apple Pie Scoop', 'uploads/flavor_6837fae124e36.jpg', 'Classic apple pie flavor with cinnamon swirls and pie crust bits.', 60, 45, 75, 245),
(4, 'Avocado Vanilla Swirl', 'uploads/flavor_6837fb5c8209c.jpg', 'Creamy avocado meets delicate vanilla for a unique fusion.', 70, 55, 85, 275),
(5, 'Banana Bonanza', 'uploads/flavor_6837fba0ace54.jpg', 'Ripe banana bliss in every velvety spoonful.', 60, 40, 80, 245),
(6, 'Berry Cheesecake Chill', 'uploads/flavor_6837fbd8707ac.jpg', 'Tangy berries and creamy cheesecake in a frozen treat.', 65, 50, 85, 270),
(7, 'Berry Nutty Bliss', 'uploads/flavor_6837fc2156e82.jpg', 'A mix of juicy berries and crunchy nuts in a smooth base.', 65, 50, 85, 285),
(8, 'Biscoff Butter Bliss', 'uploads/flavor_6837fc6441d10.jpg', 'Caramel cookie butter swirled into luscious ice cream.', 70, 50, 85, 275),
(9, 'Blackberry Breeze', 'uploads/flavor_6837fcc47d9b3.jpg', 'Refreshing blackberry flavor with a cool, fruity finish.', 65, 45, 80, 265),
(10, 'Blackberry Lavender', 'uploads/flavor_6837fd0c1e632.jpg', 'Floral lavender blends with tart blackberry for a soothing taste.', 65, 45, 75, 240),
(11, 'Blackberry Mint Dream', 'uploads/flavor_6837fda6d1df5.jpg', 'A refreshing twist of mint with bold blackberry notes.', 60, 45, 75, 250),
(12, 'Blackberry Mojito Mix', 'uploads/flavor_6837fdedbc7aa.jpg', 'Blackberry meets lime and mint in this zesty mojito-inspired delight.', 65, 50, 80, 265),
(13, 'Blue Moon Magic', 'uploads/flavor_6837fe531e1cb.jpg', 'A mysterious, fruity blue treat with a nostalgic twist.', 55, 40, 70, 225),
(14, 'Blueberry Burst', 'uploads/flavor_6838003753199.jpg', 'Bursting blueberries in a rich and creamy base.', 60, 45, 75, 265),
(15, 'Brown Sugar Bliss', 'uploads/flavor_683800654edc0.jpg', 'Warm brown sugar notes melt into rich, smooth cream.', 60, 45, 75, 260),
(16, 'Brownie Batter Bliss', 'uploads/flavor_68380097e5b27.jpg', 'Gooey brownie batter folded into decadent chocolate ice cream.', 75, 60, 90, 290),
(17, 'Bubblegum Bash', 'uploads/flavor_683800d0d0238.jpg', 'A bright, sweet celebration of classic bubblegum flavor.', 60, 40, 70, 235),
(18, 'Butterscotch Charm', 'uploads/flavor_6838015a1b41f.jpg', 'Velvety butterscotch ice cream with a buttery finish.', 50, 45, 60, 220),
(19, 'Caramel Wave', 'uploads/flavor_6838018e144e6.jpg', 'Ripples of golden caramel throughout creamy vanilla.', 65, 50, 80, 285),
(20, 'Carrot Cake Crave', 'uploads/flavor_683801eea78d8.jpg', 'Spiced carrot cake bits with swirls of cream cheese frosting.', 60, 45, 80, 255),
(21, 'Cherry Almond Dream', 'uploads/flavor_6838021cc5b88.jpg', 'Juicy cherries meet nutty almond in a dreamy blend.', 70, 50, 90, 290),
(22, 'Cherry Cheer', 'uploads/flavor_6838027102258.jpg', 'Tart and sweet cherry flavor that lifts your spirits.', 60, 40, 70, 220),
(23, 'Cherry Cola Chill', 'uploads/flavor_683802ab59fd8.jpg', 'Fizzy cherry cola flavor captured in icy cream.', 60, 40, 70, 230),
(24, 'Chili Mango Madness', 'uploads/flavor_683802d2c9d3d.jpg', 'Sweet mango with a fiery chili kick.', 70, 50, 80, 260),
(25, 'Choclate Heaven', 'uploads/flavor_683803052ef09.jpg', 'Pure indulgence in deep, rich chocolate.', 70, 55, 90, 290),
(26, 'Cinnamon Swirl', 'uploads/flavor_683843104155f.jpg', 'Sweet and spicy cinnamon ribbons in creamy bliss.', 55, 40, 70, 230),
(27, 'Choco-Hazelnut Bliss', 'uploads/flavor_68380356202c3.jpg', 'Decadent chocolate and roasted hazelnuts in every bite.', 70, 55, 85, 275),
(28, 'Chocolate Banana Rush', 'uploads/flavor_68380378698b8.jpg', 'Tart raspberry swirled into smooth chocolate cream.', 70, 60, 90, 275),
(29, 'Chocolate Raspberry', 'uploads/flavor_683803ad0bcb0.jpg', 'Bright orange flavor pairs with rich chocolate chunks.', 60, 40, 70, 235),
(30, 'Choco-Orange Zest', 'uploads/flavor_683803d7cd0af.jpg', 'Cinnamon sugar churro pieces in sweet creamy delight.', 60, 45, 75, 240),
(31, 'Churro Charm', 'uploads/flavor_6838041ba065e.jpg', 'Chocolate and mixed berries come together in a velvety mix.', 45, 35, 60, 230),
(32, 'Choco-Berry Blend', 'uploads/flavor_6838412f2abc3.jpg', 'Chocolate and mixed berries come together in a velvety mix.', 70, 45, 80, 250),
(33, 'Coconut Chill', 'uploads/flavor_6838434392ac0.jpg', 'Cool, refreshing coconut flavor with a tropical feel.', 60, 40, 70, 225),
(34, 'Coconut Raspberry Swirl', 'uploads/flavor_68384373a79bc.jpg', 'Creamy coconut ice cream with vibrant raspberry ribbons.', 60, 40, 70, 235),
(35, 'Coffee Crunch', 'uploads/flavor_683843a7353a0.jpg', 'Bold coffee ice cream with a satisfying crunchy texture.', 45, 35, 55, 270),
(36, 'Cookie Dough Crush', 'uploads/flavor_683843d3cdfe4.jpg', 'Classic vanilla loaded with chunks of raw cookie dough.', 60, 60, 90, 295),
(37, 'Cotton Candy Cloud', 'uploads/flavor_6838440831249.jpg', 'A fluffy, sugary delight that tastes like the fair.', 60, 45, 80, 265),
(38, 'Creamy Cashew', 'uploads/flavor_683844318d996.jpg', 'Silky cashew butter churned into a smooth treat.', 75, 60, 90, 300),
(39, 'Cucumber Mint Freeze', 'uploads/flavor_68384483a1d9c.jpg', 'A crisp and cooling mix of cucumber and fresh mint.', 55, 40, 75, 230),
(40, 'Dark Chocolate Drift', 'uploads/flavor_683844cb7144e.jpg', 'Deep, intense dark chocolate in a creamy flow.', 75, 60, 95, 300),
(41, 'Date Delight', 'uploads/flavor_683844f04799c.jpg', 'Naturally sweet dates blended into a rich creamy base.', 60, 45, 75, 245),
(42, 'Dragonfruit Dream', 'uploads/flavor_68384524adc39.jpg', 'Exotic dragonfruit flavor with a refreshing twist.', 65, 50, 80, 270),
(43, 'Espresso Euphoria', 'uploads/flavor_683845539edcf.jpg', 'A bold espresso burst in every creamy bite.', 70, 50, 90, 275),
(44, 'Fig & Honey Fusion', 'uploads/flavor_68384591bc465.jpg', 'Earthy figs and sweet honey in a smooth luxurious mix.', 70, 50, 85, 275),
(45, 'French Vanilla Fizz', 'uploads/flavor_683845da4de7d.jpg', 'Classic French vanilla with a fizzy hint of sparkle.', 70, 50, 90, 290),
(46, 'Fudge Fantasy', 'uploads/flavor_6838461fc75cb.jpg', 'Rich fudge ribbons swirling through velvety chocolate.', 65, 50, 80, 255),
(47, 'Ginger Snap Scoop', 'uploads/flavor_683846779f586.jpg', 'Spiced ginger snap cookies folded into creamy ice cream.', 60, 45, 80, 260),
(48, 'Grape Glacier', 'uploads/flavor_683846e416473.jpg', 'A frosty burst of bold grape flavor.', 60, 45, 80, 240),
(49, 'Hazelnut Harmony', 'uploads/flavor_683847162a999.jpg', 'Toasted hazelnuts blended into a silky sweet scoop.', 70, 50, 90, 270),
(50, 'Honeycomb Hug', 'uploads/flavor_6838473ab2902.jpg', 'Crunchy honeycomb candy in creamy vanilla.', 75, 60, 90, 280),
(51, 'Kiwi Kream', 'uploads/flavor_683847bbdc177.jpg', 'Tart kiwi meets smooth ice cream in a fruity fusion.', 65, 50, 85, 260),
(52, 'Lavender Love', 'uploads/flavor_683847e8a4b5e.jpg', 'Soft floral lavender flavor in a creamy base.', 60, 40, 75, 230),
(53, 'Lemon Cheesecake Swirl', 'uploads/flavor_6838481a71ab2.jpg', 'Zesty lemon and cheesecake ribbons swirl together.', 60, 45, 80, 255),
(54, 'Lemon Lush', 'uploads/flavor_68384850db33c.jpg', 'A bright and tangy lemon cream treat.', 55, 45, 75, 235),
(55, 'Lime Light', 'uploads/flavor_683848770dd65.jpg', 'Sharp lime flavor shines in this refreshing delight.', 60, 45, 75, 230),
(56, 'Mango Cheesecake Chill', 'uploads/flavor_683848b56b35b.jpg', 'Mango puree and cheesecake chunks create tropical indulgence.', 60, 50, 80, 265),
(57, 'Mango Magic', 'uploads/flavor_683848d859789.jpg', 'Sweet, ripe mango in a smooth tropical treat.', 65, 50, 90, 275),
(58, 'Mango Tango', 'uploads/flavor_6838492130c76.jpg', 'Mango with a zesty citrus twist for a lively flavor.', 70, 50, 90, 230),
(59, 'Maple Walnut Wonder', 'uploads/flavor_6838494188344.jpg', 'Rich maple flavor with crunchy walnut bits.', 70, 55, 90, 300),
(60, 'Marshmallow Melt', 'uploads/flavor_6838496863ce8.jpg', 'Gooey marshmallow swirls in soft vanilla cream.', 70, 55, 90, 290),
(61, 'Matcha Mousse', 'uploads/flavor_6838499229e87.jpg', 'Earthy matcha green tea folded into airy mousse-like cream.', 60, 45, 75, 240),
(62, 'Mint Bliss', 'uploads/flavor_683849b7cdceb.jpg', 'Cool mint in a refreshing, creamy scoop.', 55, 40, 80, 270),
(63, 'Mint Chocolate Storm', 'uploads/flavor_683849dfc9ed0.jpg', 'Bold mint ice cream with chocolate flakes in every bite.', 70, 60, 90, 275),
(64, 'Mocha Marvel', 'uploads/flavor_68384a0d8422c.jpg', 'A rich mocha blend of coffee and chocolate.', 70, 50, 85, 275),
(65, 'Nutella', 'uploads/flavor_68384a3e747fe.jpg', 'Creamy hazelnut Nutella spread turned into frozen decadence.', 65, 50, 70, 260),
(66, 'Nutty Nirvana', 'uploads/flavor_68384a6e288bd.jpg', 'A medley of roasted nuts in smooth, creamy bliss.', 75, 50, 80, 270),
(67, 'Orange Cream Splash', 'uploads/flavor_68384aa500452.jpg', 'Citrus orange swirled with creamy vanilla.', 65, 50, 80, 270),
(68, 'Oreo Crush', 'uploads/flavor_68384ad44373b.jpg', 'Crunchy Oreo bits crushed into vanilla goodness.', 70, 50, 80, 250),
(69, 'Papaya Punch', 'uploads/flavor_68384af81afb3.jpg', 'Sweet papaya flavor with a tropical zing.', 60, 40, 70, 225),
(70, 'Peach Lychee Love', 'uploads/flavor_68384b1db7ff1.jpg', 'Juicy peaches and fragrant lychee in perfect harmony.', 70, 50, 85, 275),
(71, 'Peach Perfection', 'uploads/flavor_68384b40e207e.jpg', 'Ripe peach flavor with a velvety smooth finish.', 70, 50, 85, 270),
(72, 'Peanut Butter Bliss', 'uploads/flavor_68384b6b8097f.jpg', 'Creamy peanut butter with a sweet, salty twist.', 70, 50, 85, 265),
(73, 'Pina Colada Cream', 'uploads/flavor_68384bd2ddbc7.jpg', 'Pineapple and coconut blended into a tropical escape.', 45, 55, 65, 245),
(74, 'Pineapple Paradise', 'uploads/flavor_68384c13e2725.jpg', 'A juicy pineapple flavor that screams summer.', 60, 45, 75, 245),
(75, 'Pink Guava Glow', 'uploads/flavor_68384c3abdf27.jpg', 'Sweet pink guava with a refreshing tropical flair.', 65, 50, 80, 255),
(76, 'Pistachio Peach', 'uploads/flavor_68384c8ead18e.jpg', 'Nutty pistachios meet sweet peach in a unique duo.', 70, 55, 90, 285),
(77, 'Pistachio Pride', 'uploads/flavor_68384ce2ea74d.jpg', 'Rich, roasted pistachio in a creamy traditional base.', 70, 55, 90, 300),
(78, 'Pistachio Rose', 'uploads/flavor_68384d0737dfc.jpg', 'Floral rose notes with earthy pistachio elegance.', 70, 55, 80, 270),
(79, 'Pistachio Strawberry', 'uploads/flavor_68384d42c66de.jpg', 'Sweet strawberries blend with creamy pistachio.', 65, 50, 85, 270),
(80, 'Pumpkin Spice Freeze', 'uploads/flavor_68384d8127251.jpg', 'Pumpkin spice latte in frozen dessert form.', 70, 50, 80, 265),
(81, 'Raspberry Ripple', 'uploads/flavor_68384dc12876b.jpg', 'Bright raspberry swirls through sweet cream.', 65, 50, 85, 245),
(82, 'Red Velvet Ice Dream', 'uploads/flavor_68384ded42200.jpg', 'Creamy red velvet cake meets rich frosting swirls.', 70, 55, 90, 290),
(83, 'Rocky Road Rush', 'uploads/flavor_68384e1baf0b4.jpg', 'Chocolate, marshmallow, and nuts in a rugged, tasty combo.', 70, 55, 90, 295),
(84, 'Rose Petal Gelato', 'uploads/flavor_68384e50c3146.jpg', 'Delicate rose flavor in an elegant, floral gelato.', 60, 45, 80, 255),
(85, 'Rum Raisin Rapture', 'uploads/flavor_68384e7e4ae60.jpg', 'Rum-infused raisins in a rich creamy scoop.', 70, 55, 90, 285),
(86, 'Saffron Cream Deluxe', 'uploads/flavor_68384ea750a77.jpg', 'Luxurious saffron flavor in a silky golden cream.', 75, 60, 95, 300),
(87, 'Salted Caramel Dream', 'uploads/flavor_68384ed18b3ce.jpg', 'Sweet and salty caramel in perfect harmony.', 70, 55, 95, 295),
(88, 'Spicy Chocolate Heat', 'uploads/flavor_68384ef5cc497.jpg', 'Rich chocolate with a spicy chili kick.', 70, 55, 90, 285),
(89, 'Strawberry Cheesecake', 'uploads/flavor_68384f2694b2c.jpg', 'Creamy cheesecake with sweet strawberry swirls.', 65, 50, 80, 265),
(90, 'Strawberry Swirl', 'uploads/flavor_68384f8b81825.jpg', 'Fresh strawberry ribbons in a smooth creamy base.', 60, 45, 75, 260),
(91, 'Sugar Cookie Surprise', 'uploads/flavor_683854f4d09ea.jpg', 'Bits of sugar cookie in vanilla cream with a sweet twist.', 55, 40, 70, 225),
(92, 'Sweet Corn Surprise', 'uploads/flavor_68385541c95cf.jpg', 'Sweet corn turned into a surprisingly creamy treat.', 60, 45, 75, 250),
(93, 'Thai Tea Swirl', 'uploads/flavor_683855b52de7c.jpg', 'Bold Thai tea flavor with creamy sweetness.', 65, 50, 85, 265),
(94, 'Tiramisu Treat', 'uploads/flavor_683855d811f3b.jpg', 'Coffee, cocoa, and mascarpone blended in a frozen take on tiramisu.', 75, 60, 95, 300),
(95, 'Toasted Coconut Crush', 'uploads/flavor_683855f7f32f4.jpg', 'Toasted coconut flakes in rich tropical cream.', 70, 55, 90, 255),
(96, 'Triple Chocolate Chunk', 'uploads/flavor_6838561cca1ef.jpg', 'Three kinds of chocolate with chunky fudge bites.', 75, 60, 95, 300),
(97, 'Tropical Tango', 'uploads/flavor_68385674ac557.jpg', 'A fruity mix of tropical flavors in a vibrant dance.', 60, 60, 75, 255),
(98, 'Tutti Frutti', 'uploads/flavor_68385695d2b43.jpg', 'A colorful blend of candied fruits in a creamy scoop.', 60, 50, 80, 260),
(99, 'vanila delight', 'uploads/flavor_683856b75742c.jpg', 'Classic vanilla flavor, smooth and satisfying.', 60, 45, 70, 230),
(100, 'Vanilla Bean Burst', 'uploads/flavor_683856d80f3fe.jpg', 'Rich vanilla with flecks of real vanilla bean.', 60, 45, 75, 250),
(104, 'Vanilla Cookie Crunch', 'uploads/flavor_683859d417e05.jpg', 'Crunchy cookies folded into creamy vanilla.', 65, 50, 85, 260),
(105, 'Chocolate Banana Rush', 'uploads/flavor_68380378698b8.jpg', 'Rich chocolate and ripe banana for a bold flavor combo.', 70, 60, 90, 275),
(106, 'Mava Malai', './uploads/3f72700803c518943b24e9420694a1fe.jpg', 'made with fresh milk cream and sweet mava.', 30, 20, 35, 140),
(107, 'Kesar Pista', './uploads/474240a737efe9a9270140ca71676ea4.jpg', 'made with flavors of fresh pistachio and flavors of saffron.', 40, 25, 50, 250);

-- --------------------------------------------------------

--
-- Table structure for table `simple_order`
--

DROP TABLE IF EXISTS `simple_order`;
CREATE TABLE IF NOT EXISTS `simple_order` (
  `sr` int(4) NOT NULL AUTO_INCREMENT,
  `customername` varchar(50) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `flavorname` varchar(100) NOT NULL,
  `content` varchar(15) NOT NULL,
  `quantity` int(3) NOT NULL,
  `price` int(5) NOT NULL,
  `billamount` int(5) NOT NULL,
  PRIMARY KEY (`sr`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `simple_order`
--

INSERT INTO `simple_order` (`sr`, `customername`, `contact`, `address`, `flavorname`, `content`, `quantity`, `price`, `billamount`) VALUES
(1, 'priti parmar', '8238938934', 'vanand society, porbandar', 'Fudge Fantasy', 'Cup', 3, 80, 240),
(2, 'rushi thanki', '2378238744', 'rajivnagar, porbandar', 'Grape Glacier', 'Family Pack', 1, 240, 240),
(3, 'vidya lakhani', '9832372837', 'meeranagar, porbandar', 'Papaya Punch', 'Cone', 3, 60, 180),
(4, 'meet makhecha', '9092392323', 'main road, ranavav', 'Spicy Chocolate Heat', 'Cone', 1, 70, 70),
(5, 'maharshi pandya', '8273873827', 'vaghesharvari, porbandar', 'Mava Malai', 'Candy', 1, 20, 20),
(6, 'kinjal singrakhiya', '9238949348', 'sandipani, porbandar', 'Sugar Cookie Surprise', 'Candy', 1, 40, 40),
(7, 'siddhi vaja ', '9238498498', 'jalaram colony, porbandar', 'Berry Cheesecake Chill', 'Cone', 1, 65, 65);

-- --------------------------------------------------------

--
-- Table structure for table `topings`
--

DROP TABLE IF EXISTS `topings`;
CREATE TABLE IF NOT EXISTS `topings` (
  `sr` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `image` varchar(50) NOT NULL,
  `price` int(3) NOT NULL,
  PRIMARY KEY (`sr`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topings`
--

INSERT INTO `topings` (`sr`, `name`, `image`, `price`) VALUES
(1, 'Almond', 'uploads/1748444162_almond.jpg', 15),
(2, 'Blueberry', 'uploads/top_68554f289c2184.82524356.jpg', 15),
(3, 'Brownie', 'uploads/1748444229_Brownie.jpg', 15),
(4, 'Candy Bar', 'uploads/1748444258_Candy bars.jpg', 15),
(5, 'Caramel Drizzle', 'uploads/1748444314_Caramel Drizzle.jpg', 10),
(6, 'Caramel', 'uploads/1748444342_Caramel.jpg', 10),
(7, 'Cashew', 'uploads/1748444363_cashew.jpg', 20),
(8, 'Cherries', 'uploads/1748444382_Cherries.jpg', 10),
(9, 'Choco Chips', 'uploads/1748444406_choco chips.jpg', 15),
(10, 'Coconut Flakes', 'uploads/1748444467_Coconut Flakes.jpg', 10),
(11, 'Cookie', 'uploads/1748444503_Cookies.jpg', 15),
(12, 'Granola', 'uploads/1748444526_Granola.jpg', 10),
(13, 'Hot Fudge', 'uploads/1748444549_Hot Fudge.jpg', 15),
(14, 'Jems Candy', 'uploads/1748444572_Jems Candy.jpg', 10),
(15, 'Lemon Curd', 'uploads/1748444604_Lemon Curd.jpg', 20),
(16, 'Macadamia', 'uploads/1748444635_macadamia.jpg', 15),
(17, 'Mango', 'uploads/1748444652_Mangos.jpg', 15),
(18, 'Marshmallow', 'uploads/1748444682_Marshmallows.jpg', 15),
(19, 'Peacan', 'uploads/1748444705_peacans.jpg', 10),
(20, 'Peanut', 'uploads/1748444761_peanuts.jpg', 10),
(21, 'Pistachio', 'uploads/1748444785_Pistachio.jpg', 20),
(22, 'Roasted Hazelnuts', 'uploads/1748444890_Roasted Hazelnuts.jpg', 15),
(23, 'Sprinkle', 'uploads/1748444924_sprinkles.jpg', 10),
(24, 'Strawberry', 'uploads/1748444951_Strawberry.jpg', 20),
(25, 'Whipped Cream', 'uploads/1748444975_Whipped Cream.jpg', 10),
(26, 'Oreo Crumbles', 'uploads/1749095843_Oreo Crumbles.jpg', 10),
(27, 'Boba Pearls', 'uploads/1749095890_Boba Pearls.jpg', 20),
(28, 'Butterscotch Chips', 'uploads/1749095914_Butterscotch Chips.jpg', 15),
(29, 'White Chocolate Chips', 'uploads/1749096039_White Chocolate Chips.jpg', 15),
(30, 'Mocha Syrup', 'uploads/1749096063_Mocha Syrup.jpg', 20),
(31, 'Matcha Powder', 'uploads/1749096539_Matcha Powder.jpg', 10),
(32, 'Nutella Swirl', 'uploads/1749096558_Nutella Swirl.jpg', 20),
(33, 'Pineapple Chunks', 'uploads/1749096587_Pineapple Chunks.jpg', 15),
(34, 'Apple Pie Filling', 'uploads/1749096606_Apple Pie Filling.jpg', 20),
(35, 'Cinnamon Sugar', 'uploads/1749096627_Cinnamon Sugar.jpg', 15),
(36, 'Toffee Bits', 'uploads/1749096646_Toffee Bits.jpg', 15),
(37, 'Gummy Bears', 'uploads/1749096664_Gummy Bears.jpg', 10),
(38, 'Gummy Worms', 'uploads/1749096688_Gummy Worms.jpg', 10),
(39, 'Birthday Cake Crumbles', 'uploads/1749096708_Birthday Cake Crumbles.jpg', 10),
(40, 'Waffle Cone Pieces', 'uploads/1749096729_Waffle Cone Pieces.jpg', 10),
(41, 'Brown Sugar Crystals', 'uploads/1749096804_Brown Sugar Crystals.jpg', 15),
(42, 'Raisins', 'uploads/1749096828_Raisins,jpg.jpg', 15),
(43, 'Dried Cranberries', 'uploads/1749096860_Dried Cranberries.jpg', 15),
(44, 'Dried Apricots', 'uploads/1749096877_Dried Apricots.jpg', 25),
(45, 'Blueberry Compote', 'uploads/1749096895_Blueberry Compote.jpg', 15),
(46, 'Strawberry Syrup', 'uploads/1749096913_Strawberry Syrup.jpg', 20),
(47, 'Mango Puree', 'uploads/1749096932_Mango Puree.jpg', 20),
(48, 'Fig Jam', 'uploads/1749098882_Fig Jam.jpg', 15),
(49, 'Honey Drizzle', 'uploads/1749098898_Honey Drizzle.jpg', 15),
(50, 'Chocolate Shavings', 'uploads/1749098914_Chocolate Shavings.jpg', 20),
(51, 'Mocha Beans', 'uploads/1749098931_Mocha Beans.jpg', 20),
(52, 'Salted Caramel Chips', 'uploads/1749098949_Salted Caramel Chips.jpg', 20),
(53, 'Chocolate Pretzels', 'uploads/1749098967_Chocolate Pretzels.jpg', 20),
(54, 'Yogurt Chips', 'uploads/1749098985_Yogurt Chips.jpg', 15),
(55, 'Pomegranate Seeds', 'uploads/1749099006_Pomegranate Seeds.jpg', 15),
(56, 'Kiwi Slices', 'uploads/1749099024_Kiwi Slices.jpg', 20),
(57, 'Crushed Peanuts', 'uploads/1749099040_Crushed Peanuts.jpg', 15),
(58, 'Peanut Butter Cups', 'uploads/1749099057_Peanut Butter Cups.jpg', 20),
(59, 'Fudge Brownie Chunks', 'uploads/1749099073_Fudge Brownie Chunks.jpg', 20),
(60, 'Banana Slices', 'uploads/1749099087_Banana Slices.jpg', 15),
(61, 'Crushed Ice Cream Cones', 'uploads/1749099104_Crushed Ice Cream Cones.jpg', 10),
(62, 'Waffle Bits', 'uploads/1749099122_Waffle Bits.jpg', 10),
(63, 'Cereal Crunch (Froot Loops)', 'uploads/1749099140_Cereal Crunch (Froot Loops).jpg', 15),
(64, 'Cornflakes', 'uploads/1749099155_Cornflakes.jpg', 15),
(65, 'Rice Krispies', 'uploads/1749099169_Rice Krispies.jpg', 15),
(66, 'Fruity Pebbles', 'uploads/1749099187_Fruity Pebbles.jpg', 15),
(67, 'Cheesecake Bites', 'uploads/1749099205_Cheesecake Bites.jpg', 20),
(68, 'Pumpkin Spice', 'uploads/1749099229_Pumpkin Spice.jpg', 15),
(69, 'Espresso Drizzle', 'uploads/1749099250_Espresso Drizzle.jpg', 20),
(70, 'Sea Salt Flakes', 'uploads/1749099267_Sea Salt Flakes.jpg', 15),
(71, 'Molasses Swirl', 'uploads/1749099284_Molasses Swirl.jpg', 20),
(72, 'Maple Syrup', 'uploads/1749099301_Maple Syrup.jpg', 20),
(73, 'Graham Cracker Crumbs', 'uploads/1749099317_Graham Cracker Crumbs.jpg', 15),
(74, 'Lava Cake Bits', 'uploads/1749099331_Lava Cake Bits.jpg', 20),
(75, 'Red Velvet Crumbles', 'uploads/1749099345_Red Velvet Crumbles.jpg', 20),
(76, 'Mini Donut Pieces', 'uploads/1749099360_Mini Donut Pieces.jpg', 20),
(77, 'Crushed Candy Canes', 'uploads/1749099389_Crushed Candy Canes.jpg', 15),
(78, 'Licorice Twists', 'uploads/1749099404_Licorice Twists.jpg', 15),
(79, 'Coconut Jelly', 'uploads/1749099418_Coconut Jelly.jpg', 15),
(80, 'Jelly Beans', 'uploads/1749099436_Jelly Beans.jpg', 15),
(81, 'Marshmallow Cream', 'uploads/1749099451_Marshmallow Cream.jpg', 20),
(82, 'Apple Chips', 'uploads/1749099470_Apple Chips.jpg', 15),
(83, 'Basil Sugar', 'uploads/1749099486_Basil Sugar.jpg', 15),
(84, 'Lemon Zest', 'uploads/1749099504_Lemon Zest.jpg', 10),
(85, 'Orange Peel', 'uploads/1749099520_Orange Peel.jpg', 10),
(86, 'Crushed Meringue', 'uploads/1749099535_Crushed Meringue.jpg', 15),
(87, 'Cherry Syrup', 'uploads/1749099550_Cherry Syrup.jpg', 15),
(88, 'Rose Syrup', 'uploads/1749099568_Rose Syrup.jpg', 15),
(89, 'Lavender Sugar', 'uploads/1749099583_Lavender Sugar.jpg', 15),
(90, 'Almond Butter Swirl', 'uploads/1749099603_Almond Butter Swirl.jpg', 20),
(91, 'Candied Ginger', 'uploads/1749099626_Candied Ginger.jpg', 10),
(92, 'Chocolate Rice Balls', 'uploads/1749099641_Chocolate Rice Balls.jpg', 10),
(93, 'Edible Glitter', 'uploads/1749099657_Edible Glitter.jpg', 10),
(94, 'Gold Sprinkles', 'uploads/1749099676_Gold Sprinkles.jpg', 10),
(95, 'Pocky Sticks', 'uploads/1749099693_Pocky Sticks.jpg', 15),
(101, 'S\'mores Pieces', 'uploads/1749100004_S\'mores Pieces.jpg', 15),
(97, 'Cookie Dough Balls', 'uploads/1749099727_Cookie Dough Balls.jpg', 20),
(98, 'Salted Pistachio Cream', 'uploads/1749099740_Salted Pistachio Cream.jpg', 20),
(99, 'Dulce de Leche', 'uploads/1749099755_Dulce de Leche.jpg', 15),
(100, 'Strawberry Cheesecake Bites', 'uploads/1749099771_Strawberry Cheesecake Bites.jpg', 15);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
