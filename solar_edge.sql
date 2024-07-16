-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2024 at 08:33 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `solar_edge`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `description`, `date`, `status`) VALUES
(10, 'Solar Panel', 'TEXT', '2023-06-04 16:09:35', 1),
(11, 'Solar batteries', 'TEXT', '2023-06-04 16:10:29', 1),
(12, 'Solar Lights', 'text', '2023-06-04 16:10:51', 1),
(13, 'Solar Home Products', 'text', '2023-06-04 16:11:15', 1),
(14, 'Solar Water Pumps and Heater', 'text', '2023-06-04 16:15:14', 1),
(15, 'Solar Inverters & Batteries', 'text', '2023-06-04 16:15:56', 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `feedback` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `userid`, `product_id`, `feedback`, `date`, `status`) VALUES
(1, 16, 25, 'Very Good Product', '2023-06-28 10:32:03', 1),
(2, 3, 29, 'good solar panels', '2023-06-28 10:33:31', 1),
(3, 14, 24, 'average product', '2023-06-28 10:40:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `trackid` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `orderStatus` varchar(75) NOT NULL,
  `order_remark` varchar(75) NOT NULL,
  `orderDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userid`, `trackid`, `payment_id`, `productId`, `quantity`, `orderStatus`, `order_remark`, `orderDate`) VALUES
(1, 3, 1, 0, 22, '1', 'Initiated', 'Order has been Initiated.', '2023-06-07 03:50:12'),
(2, 3, 1, 0, 23, '1', 'Initiated', 'Order has been Initiated.', '2023-06-07 03:50:12'),
(3, 1, 2, 1, 25, '2', 'Paid', 'Order has been begin', '2023-06-09 05:19:56'),
(4, 1, 3, 0, 11, '1', 'Initiated', 'Order has been Initiated.', '2023-06-09 05:33:23'),
(5, 1, 4, 0, 11, '1', 'Initiated', 'Order has been Initiated.', '2023-06-09 05:33:33'),
(6, 1, 5, 0, 11, '2', 'Initiated', 'Order has been Initiated.', '2023-06-09 05:44:01'),
(7, 3, 6, 0, 9, '1', 'Initiated', 'Order has been Initiated.', '2023-06-09 06:39:44'),
(8, 3, 6, 0, 11, '2', 'Initiated', 'Order has been Initiated.', '2023-06-09 06:39:44'),
(9, 3, 6, 0, 31, '1', 'Initiated', 'Order has been Initiated.', '2023-06-09 06:39:44'),
(10, 13, 7, 0, 16, '1', 'Initiated', 'Order has been Initiated.', '2023-06-14 02:22:06'),
(11, 3, 8, 0, 11, '1', 'Initiated', 'Order has been Initiated.', '2023-06-21 09:32:06'),
(12, 3, 9, 2, 29, '1', 'Paid', 'Order has been begin', '2023-06-22 08:52:19'),
(13, 3, 10, 0, 12, '1', 'Initiated', 'Order has been Initiated.', '2023-06-26 10:54:30'),
(14, 3, 11, 0, 12, '1', 'Initiated', 'Order has been Initiated.', '2023-06-27 10:43:37'),
(15, 3, 11, 0, 13, '1', 'Initiated', 'Order has been Initiated.', '2023-06-27 10:43:37'),
(16, 3, 11, 0, 29, '1', 'Initiated', 'Order has been Initiated.', '2023-06-27 10:43:37'),
(17, 3, 11, 0, 39, '1', 'Initiated', 'Order has been Initiated.', '2023-06-27 10:43:37'),
(18, 3, 11, 0, 49, '1', 'Initiated', 'Order has been Initiated.', '2023-06-27 10:43:37'),
(19, 3, 12, 3, 22, '1', 'Paid', 'Order has been begin', '2023-06-28 10:19:45'),
(20, 16, 13, 4, 13, '3', 'Paid', 'Order has been begin', '2023-06-28 10:27:52'),
(21, 16, 13, 4, 34, '1', 'Paid', 'Order has been begin', '2023-06-28 10:27:52'),
(22, 14, 14, 5, 24, '1', 'Paid', 'Order has been begin', '2023-06-28 10:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` varchar(25) NOT NULL,
  `descrption` text NOT NULL,
  `image` varchar(500) NOT NULL,
  `warranty` varchar(15) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `name`, `price`, `descrption`, `image`, `warranty`, `date`, `status`) VALUES
(3, 1, 'Solar Panel PWHP300', '8784', 'Buy PowerHouse 300W 30V Polycrystalline Solar Panel PWHP300 online in India at wholesale rates. If you have been looking for PowerHouse 300W 30V', 'product/SO.PO.377533_1548400950926__1_-removebg-preview.png', '10 Year', '2021-05-20 17:28:42', 1),
(4, 2, 'Microtek Solar Inverter', '3750', 'Microtek Solar Inverter is integrated with an in-built 30 amp solar charge controller, which enables the conversion of solar power to electricity.', 'product/solar-inverters-4061-removebg-preview.png', '5 Year', '2021-05-20 17:30:47', 1),
(5, 4, 'Best Solar LED Street Light 30W High Bright White ', '2064', 'Buy Best Solar LED Street Light 30W High Bright White Model No SS30WMFSLDC(Solar Compatible) online in India at wholesale rates. If you have been looking for Best Solar LED Street Light 30W High Bright White Model No SS30WMFSLDC(Solar Compatible) dealers, your search ends here as you can get the best Best Solar LED Street Light 30W High Bright White Model No SS30WMFSLDC(Solar Compatible) distributors in top cities such as Delhi NCR, Mumbai, Chennai, Bengaluru, Kolkata, Chennai, Pune, Jaipur, Hyderabad and Ahmedabad. You can purchase Best Solar LED Street Light 30W High Bright White Model No SS30WMFSLDC(Solar Compatible) of the finest quality and rest assured to get the best in terms of both durability and performance. If you are bothered about the Best Solar LED Street Light 30W High Bright White Model No SS30WMFSLDC(Solar Compatible) prices, you can be totally sure to get the best rates as Industrybuying brings you genuine Best Solar LED Street Light 30W High Bright White Model No SS30WMFSLDC(Solar Compatible) rates and quality assured products only from the best of brands with exclusive brand discounts you won’t find anywhere else. Procure Best Solar LED Street Light 30W High Bright White Model No SS30WMFSLDC(Solar Compatible) today and avail the best offers on your purchase.', 'product/SO.SO.ST.332580-removebg-preview.png', '5 Year', '2021-05-21 12:52:34', 1),
(9, 10, 'Solar India Monocrystalline 250 Watt Solar Panel', '12800', 'Monocrystalline solar panels are made from high-quality silicon bars which are cut out into wafers. Solar India 220 W 12V Mono Solar Panel consists of 72 Solar cells to provide with the high-efficiency rate. Compared to Polycrystalline, the solar cells carry a black hue aesthetics and tend to provide better results and energy for consumption. With 25 years of warranty on Solar India 220 W 12V Mono Solar Panel it proves to be the perfect alternative to non-renewable energy. The solar panels are tested for stringent quality measures. To meet the power requirements it is necessary to install a required number of solar panels and in case you have any doubt or query feel free to contact us for professional assistance.', 'product/so-po-1639889-1667939542139-500x500.png', '5', '2023-06-04 16:41:26', 1),
(11, 10, 'Mono Perc 445W 24V Solar Panel', '18499', 'Buy Mono Perc 445W 24V Solar Panel online in India at wholesale rates. If you have been looking for Waaree 445W 24V Mono Perc Solar Panel dealers, your search ends here as you can get the best Waaree 445W 24V Mono Perc Solar Panel distributors in top cities such as Delhi NCR, Mumbai, Chennai, Bengaluru, Kolkata, Chennai, Pune, Jaipur, Hyderabad and Ahmedabad. You can purchase Waaree 445W 24V Mono Perc Solar Panel of the finest quality and rest assured to get the best in terms of both durability and performance. If you are bothered about the Waaree 445W 24V Mono Perc Solar Panel prices, you can be totally sure to get the best rates as Industrybuying brings you genuine Waaree 445W 24V Mono Perc Solar Panel rates and quality assured products only from the best of brands with exclusive brand discounts you won’t find anywhere else', 'product/445-watt-solar-panel.jpg', '5', '2023-06-04 16:49:30', 1),
(12, 11, '100Ah Solar Tubular Battery', '15000', 'Luminous Solar 100 Ah Tubular battery is a C10 rating deep cycle battery designed for connecting with inverters of capacity between 900 VA – 10 KVA. It provides longer power backup and requires very low maintenance. The battery stores 1200 watts of Power for backup', 'product/Luminous_solar_Battery_.png', '5', '2023-06-04 16:56:05', 1),
(13, 12, 'Outdoor Solar Street Light', '4999', 'Solar street lights are raised light sources which are powered by solar panels generally mounted on the lighting structure or integrated into the pole itself. The solar panels charge a rechargeable battery, which powers a fluorescent or LED lamp during the night.Simply put, solar lighting is outdoor lighting powered by the sun. A solar panel collects solar energy during daylight hours and charges a battery that powers a fixture light when the sun goes down.The main components of a solar street light are solar panel, light source, rechargeable battery, charge controller and interconnecting cables.Solar street lighting system uses the photovoltaic technology to convert the sunlight into DC electricity through solar cells. The generated electricity can either be used directly during the day or may be stored in the batteries for use during night hours.There are many areas such as parking lot, Hospital parking, and residential lighting where these solar-powered street lights are used.', 'product/street light1.jpg', '2', '2023-06-04 21:53:33', 1),
(14, 11, 'Luminous Solar 40AH Battery | LPT1240L', '4900', 'Luminous Solar Batteries has Tubular Plate Technology - Next generation Tall Tubular battery with better charge acceptance and long Back up with Long cycles (1500 @80% DOD, 5000 @ 20% DOD ) Ensuring design life and Longer battery life without discharge. Efficient battery with Higher AH efficiency > 90% and requires Low maintenance with level indicators and are Manufactured with high corrosion resistant and robust spine technology using the advanced and state-of-the-art HADI high pressure (at 100 bar) spine casting machines, which ensure a super fine grain structure, for strength, long life and highest reliability', 'product/shopping.png', '3', '2023-06-04 21:57:38', 1),
(15, 12, 'Solar compound wall lights', '380', 'Solar Powered Cordless Outdoor Led Motion Sensor Path & Security Light The Motion-activated Solar Powered Led Light Adds Safety To Your Home. Solar Powered Cordless Outdoor Led Motion Sensor Path & Security Light Illuminates Your Homes Exterior. Ever Bright Features A Built-in Solar Panel That Charges Automatically And Never Need Batteries. Best Part Is Theirs No Wiring Needed, Just Peel And Stick This Compact And Ultra Bright Light In Seconds. Solar Powered Cordless Outdoor Led Motion Sensor Path & Security Light Has A Motion Sensor That Detects Movement Up To 10 To 15 Feet Away And Automatically Illuminates Whenever Someone Approaches', 'product/shopping1.png', '1', '2023-06-04 22:04:24', 1),
(16, 13, 'Solar Fan with Battery Rechargeable 5200mah', '2647', 'his fan is extremely practical and is ideal for both home and office use. Place it at the edge of your sofa or bed and use it as a standing fan , or you place it at your office desk and use it as a desktop fan [Height and Angles Adjustable] :The height of the standing/desk fan can be fully adjusted from 3.7\" to 39.3\" and 180 degree adjustable tilt Angle, which provides you more choices in different height and angle, works flawlessly [Wireless Working & Bulit-in 5200mAh Battery] ', 'product/shopping3.png', '1', '2023-06-04 22:08:05', 1),
(17, 14, 'Decot Solar Pump', '12500', '2 HP Solar Submersible Pump,, 2 HP Solar Submersible Pump is manufactured from the eminent grade raw materials and advance technologies under guidance of our skilled professionals who ensure its flawless construction and supreme working efficiency. It is light in weight, portable and demands no regular maintenance. Offered 2 HP Solar Submersible Pump is extremely durable and highly resistant to corrosion. Customers can avail this product from us in various specifications as per demands at reasonable rates', 'product/shopping4.png', '4', '2023-06-05 07:53:06', 1),
(18, 11, 'Luminous Battery Trolley - SINGLE BATTERY Battery ', '1300', 'uminous Battery Trolley - SINGLE BATTERY Description Luminous introduces premium quality, ultra-durable Trolley which reduces storage space and makes home look beautiful. It is spacious, efficient and made from tough long lasting material which does not get destroyed by spillage from battery. The trolley comes with wheels which ease mobility. Screw less features make installation easy and the open back side supports ventilation. This strong, easy to install and compact trolley can be placed anywhere in your home. The battery can be kept inside the trolley while UPS is placed on the top of it. Luminous Battery Trolley - SINGLE BATTERY Features -Suitable for Single Battery like RC 15000, IL1830 etc. -Ultra Durable - made from high grade plastic material -Compatible with all types of Batteries and UPS - Easy to assemble -Top notch built wheels of premium quality -Head - Turner- A perfect match of looks with your UPS battery set -Dimensions (L * W* H) - 600 x 318 x 525 in MM Luminous Battery Trolley - SINGLE BATTERY Specifications UPS Support 600 VA – 1500 VA Battery Technology Support Single battery (Flat Plate / Tubular) Battery AH Support 100 Ah -230 A', 'product/battery trolly.png', '1', '2023-06-05 07:57:52', 1),
(19, 12, 'Multifunctinal Solar Waterproof Flashlight with US', '2500', 'Multi Functional Solar Flashlight Is A Light Weight And Water Proof It Has Twin Color Of Light Yellow Cob & Whiteled Light. This Torchlight Can Be Charged With Solar Panel As Well As Electricity. It Has Usb Charging Facility, So In An Emergency Situation, One Can Charge Mobile Also. Flashlight Has Two On/off Button To Change The Modes Of Light As Per Your Requirement', 'product/torch.png', '2', '2023-06-05 08:05:17', 1),
(20, 10, 'Luminous Solar Panel (330 watt, 24 Volts)', '12599', 'Perfect for 24 volt battery charging or multiple panels can be wired in series for 24 volt batteries Space Requirement.\r\n40 sq. feet (approx.) for single panel and 1000mm length meter wire for connection; Reliable.\r\nComes with premium MC4 connecting plugs which ensures a reliable connection Technology.\r\nEquipped with high-performance Grade A solar cells with PID resistant technology', 'product/shopping (1).webp', '5', '2023-06-05 08:13:39', 1),
(22, 15, '1 kWh Home Solar Inverter with Lithium battery and', '60000', 'Buy 1 killo watt hour Off Grid Solar System for small homes to run lights, fans and Televison, Refrigrator, and home and kitchen appliances during day and night. We offer the best price onine and latest products across India', 'product/inverter combo.png', '5', '2023-06-05 08:24:51', 1),
(23, 14, 'Skypearll Solar Panel Water Fountain', '2999', 'solar water pump with solar panel, your preferred decoration for garden, patio, fish tank, small pond, lawn, aquarium. Attract small animals such as bird, butterfly, give a fantastic garden to you, enjoy the leasure afternoon. Powered by solar, friendly for environment and save energy. 4 types spray heads, create different water flow landscape.', 'product/water fountain.jpg', '2', '2023-06-05 17:33:54', 1),
(24, 14, 'Asian Pumps & Machineries DC 24v 250w Solar Submer', '7800', 'Adopt engineering plastic anti‑sand floating impeller, wear‑resistant and compressive, durable.\r\nOptimized flow channel design, multi‑stage floating rotation realize fast water absorption and intake.\r\nHigh lift & fit for home use , filling water in home tank from well , borwell or irrigation use.\r\nPanel working For 24 v 390 or 450 watt single panel Or 12 v 150 or 200 watt x 3 series connection\r\nType open & borewell, Working current : 8 amp', 'product/solar pump.png', '4', '2023-06-05 18:12:43', 1),
(25, 15, 'Microtek SMU  Inverter 1012', '2659', 'Microtek provides a wide range of solar products for retail and commercial users. Our objective is to provide customers with easy access to solar energy & reduce their dependency on traditional sources of energy. \r\nMicrotek Solar products are manufactured using the most recent solar technologies to deliver optimal results. Our products are tested and certified as per leading industry certification standards and have carved a strong market position in a short span of time.', 'product/INVERTER.jpg', '4', '2023-06-09 17:19:17', 1),
(26, 12, 'LED High Bright Outdoor Emergency Solar Lights wit', '350', 'Pack Of 1 Material:Plastic, Color:Black Package Contents:100 LED Bright Outdoor Security Lights with Motion Sensor Light Waterproof and durable: This light is weatherproof and durable with solid hard plastic which can withstand years of usage Solar panel life span: 5 years , led life span:50000 hours.Only takes 6-8 hours to fully charge', 'product/outdoor light1.png', '1', '2023-06-09 17:25:55', 1),
(27, 10, '400W 24V Mono PERC Solar Panel', '14599', 'The ZunSolar 400W 24V Mono PERC Solar Panel is the perfect way to get started with solar power. This panel is perfect for those who want to get started with solar power and want to save money on their energy bills. The ZunSolar Z400-72-400 Solar Panel uses top of the line 72 Mono PERC cells to give you a rated power of 400 watts. This impressive panel has a short circuit current of 10.22 amps, a voltage at max power of 40.15 volts, and a current at max power of 9.96 amps.', 'product/pANEL4.jpg', '4', '2023-06-09 17:30:36', 1),
(28, 10, 'Solar Universe India Hermes 545w Half Cut Monocrys', '25999', 'Type Is Monocrystalline. Number Of Cells Is 144. Material Is Aluminum. Model Number Is Hermes 545w Half Cut Monocrystalline Solar Panel 144 Cells - Single Piece. Solar Power Is 545. Output Voltage Is 24', 'product/PANEL5.png', '10', '2023-06-09 18:22:03', 1),
(29, 10, 'Solar Universe 205W Solar Panel Monocrystalline', '7549', 'Solar Universe 205W Solar Panel Monocrystalline (Single Piece) is a solar panel comprising monocrystalline solar cells. These cells are made from a cylindrical silicon ingot grown from a single crystal of silicon of high purity in the same way as a semiconductor. The cylindrical ingot is sliced into wafers forming cells.', 'product/panel6.jpg', '5', '2023-06-09 18:26:24', 1),
(30, 10, 'Solar Universe Solar Silicon And Aluminium 40 watt', '2699', 'Material - steel, technology polycrystalline, 5bb and anti pid cells\r\nPerformance built with highest quality toughened glass and 5bb solar cells, poly-crystalline gives higher performance in high temperature, highest tensile strength for frame, eva backsheet from usa\r\nPerformance warranty of 25-years as per stc and mnre conditions, 5 year on manufacturing defects\r\nConnecting wire with standard connector, cell color - blue\r\nPackage contents - solar panel, connecting cable and packaging materials', 'product/panel7.png', '2', '2023-06-09 18:29:17', 1),
(31, 10, 'Panasonic 450 Watt - 24 Volts super high efficienc', '169999', 'Panasonic 450 Watt, Half Cut, Mono-Crystalline super high-efficiency solar panel, pack of 10. Panasonic Anchor 450 Watt solar panel for rooftop system at 60% discount. Buy Panasonic solar panels for rooftop at a 60% discount. Apollo Universe offers the best price for Panasonic solar panel. Panasonic solar panels for home, the solar rooftop at best price in India.', 'product/panel8.png', '5', '2023-06-09 18:31:35', 1),
(32, 10, 'Luminous BIS Certified Polycrystalline 170 Watt So', '15999', 'Space Requirement - 20 sq. feet (approx.) for single panel; Cables & Connectors - 1000mm length meter wire for a reliable connection Durable - Designed using a silver anodized high-tech aluminium frame that withstands higher wind and snow loads up to 5400 Pa (IEC) which allows the panels to last for decades Technology - Equipped with high-performance Grade A solar cells with PID resistant technology. The Grade A silicone cells come integrated with a powerful reflector that redirects sunlight back from the cell. This technology leads to the generation of up to 5% more power Battery requirement - Perfect for 12 volt battery charging or multiple panels can be wired in series for 12 volt batteries Performance - Open-Circuit voltage (Voc): 23.01 Volt, optimum operating current (Imp): 9.2 Amps, short-circuit current (Isc): 9.16A. Installation - Pre-drilled holes on the back of the panel allow for fast mounting and securing. Corrosion-resistant aluminium frame for extended outdoor use, allowing the panels to last for decades.', 'product/panel9.jpg', '5', '2023-06-09 18:35:19', 1),
(33, 15, 'Genus Solar Solution with Surja L Solar UPS + Tall', '29999', 'Simple and Safe Installation - The combo is compact, easy to install and safe to use Get the advanced benefits of Solar at a very reasonable cost. The combo offers great benefits Money Saver - It is designed to give you maximum benefit from the sun and minimize your electricity bill Complete Solar Solution for your Home - It senses the availability of solar power, grid power and gives charging preference to the solar power and switches to the grid power only when the solar power is unavailable or during nights Genus Surja L Solar Hybrid UPS is a Solar Inverter at the cost of a normal inverter - This modern machine harnesses Energy to increase your battery life and keeps it from deep discharge. - It is an Intelligent Inverter UPS with Pure Sine Wave Technology - Surja L is design to get your foot in the industry and Help you go Green as the most Soalr inverter on the market. - Adds Solar Current to Boost Battery Charging and Increasing Battery Life - Unlike conventional energy fuel, PV Panel do not emit any gases or leave any residues, thus reducing the global warming and contributing towards a greener environment.', 'product/inverter3.png', '4', '2023-06-13 20:58:34', 1),
(34, 15, 'Luminous Solar Inverter', '3600', 'Luminous is one of the most reputable brands when it comes to the field of solar inverters. The products that they have released into the market are safe and genuine. We host several brands and their products. One of them is the luminous solar inverter. The capacity of the product is 850 VA, and it comes with a warranty period of 24 months. The market availability of the product cannot always be guaranteed. But, you can easily Buy Luminous Solar Inverters Sine Wave Online from us, and avail of the wide range of discounts that we offer. We also offer free delivery as well as free installation. You can also exchange your old battery with the new product. ', 'product/inverter4.png', '2', '2023-06-13 21:04:15', 1),
(35, 12, 'Stardeep 7.0 Solar With Power Bank', '399', 'This Is The Emergency Light , Anyone Would Love To Carry Withem As This Is Just Not A Solar Light For Home But This Also Work As A Powerbank . One Can Recharge Their Mobile Phone Not Phones With Large Batteriesand Any Other Portab;e Electronic Device Through This Super Powerful Emergency Light For Home. Stardeep Rechargeable Emergency Light Comes With A Charging Usb Cord For Easy Charging The Device As Well As The Light Itself. This Charger Lights For Around 12 Hrs If Used Properly.', 'product/light4.png', '1', '2023-06-19 17:24:38', 1),
(36, 12, 'Home 40 Plus Solar Home Systems', '5000', 'he Sun King Home 40 Plus provides grid-like solar power in one affordable package. It includes a USB cable to charge your mobile devices, in addition to two included tube lights that can each illuminate an entire room. Up to 30 hours of light on a single charge 40X brighter than a kerosene lamp. 5.5W Solar Panel. USB for mobile charging. Tube Lights: 2 bright tube lights with 400 lumens power. Solar Panel: 5.5 Watt, polycrystalline solar panel with aluminum frame and 5 meter. Battery: 2550mAh, 7.4V lithium-ion NMC battery. Battery Indicator: While in use, digital LED meter displays remaining battery power. Charging Indicator: Digital LED meter displays charging effectiveness.', 'product/light5.png', '4', '2023-06-19 17:26:39', 1),
(37, 12, 'Solar String Lights,2 Pack 39ft 120LED 8 Modes Cop', '1100', 'Solar Powered & Automatic On/Off: Joomer solar string lights are powered by solar energy, no additional electric cost, and feature an automatic light sensor that turns the outdoor solar lights on at dusk and off at dawn. 8 Different Lighting Modes: With 8 different lighting modes including combination, in wave, sequential, slo-glo, chasing/flash, slow fade, twinkle/flash, and steady on, these solar string lights offer diverse lighting options for any occasion.', 'product/light5.jpg', '2', '2023-06-19 17:33:07', 1),
(38, 13, '2 Ton Solar On Grid Air Conditioner (ACDC) For Hom', '88000', 'FX TECHNOLOGIES, a ISO 9001:2015 certified company Pioneering in Water and Electrical Energy Conservation Products using Wireless & Automation Technology Established in 2009.\r\nCharacteristics:\r\nWorks on Solar Power\r\nExcess energy will be directed to EB\r\nEasy Maintenance\r\nSave electricity bill\r\nEco-Friendly System\r\nBest price.', 'product/home2.jpg', '5', '2023-06-19 17:36:24', 1),
(39, 14, 'Solar Water Heater', '15500', 'A solar water heater gives amazing savings. The payback period is generally between 2-3 years depending on the power tariff and extent of usage, helping reduce your elect', 'product/heater 4.jpg', '2', '2023-06-19 17:44:02', 1),
(41, 11, 'SERVCONTROL SERVBAK Solar Tubular Inverter Battery', '6840', 'Battery Type: Solar inverter battery; Technology: Tubular technology PPCP CONTAINER & Tubular Positive Plates. (Heavy duty terminal) Dimensions of the container (L x W x H) (+/- 3mm): 412mm x 173mm x 247 mm; [Battery Weight] Dry Battery: 12 kg (+/-5%); Filled Battery: 23.5 Kg (+/-5%) Tubular plate construction ensures uniform distribution of positive active material for extremely long life and superior performance, and Warranty: 3 year on manufacturing defects; Package Inclusions: Servotech solar tubular inverter battery for home. Extra-strong, flexible oxidation-resistant gauntlet for higher performance and extremely long life', 'product/batteriy4.png', '3', '2023-06-20 20:40:52', 1),
(42, 11, 'Luminous 150Ah Solar Battery', '16000', 'atteries used in home energy storage typically are made with one of three chemical compositions: lead acid, lithium ion, and saltwater. In most cases, lithium', 'product/battery5.png', '2', '2023-06-20 20:44:37', 1),
(46, 11, 'Livzing 2-Tier UPS Stand for Double Battery and In', '3001', 'Humanized Design: This double battery inverter trolley comes with a convenient handle push-bar at both the side of the double tubular battery trolley. The top rack of the UPS stand can be removed, convenient to pour distilled water to the battery or to check the battery when needed, without taking the battery out of the inverter table. Dimensions & Service: Livzing durable battery trolley measures 61 cm L x 58 cm W x 70 cm H, easy to assemble the UPS metal stand. Assemble the trolley as shown in the image with the screws and tools provided.', 'product/batter6.png', '2', '2023-06-20 20:54:42', 1),
(47, 10, 'Bluebird 200 Watt 12 Volt Mono PERC Solar Panel', '8500', 'Advanced Mono PERC technology .\r\nBuilt with high efficiency A grade 5BB solar cells.\r\nAR-coated glass for better sunlight absorption.\r\nSilver anodized aluminium frame with mounting holes for fast & easy installation.\r\nExcellent power output in low light & cloudy sky conditions.\r\nDouble EL tested for hot spots & microcrack free solar modules. \r\nWater & Dust Proof IP68 rated Junction box with 4mm cable and 2 MC4 connectors.', 'product/solar panel10.jpg', '2', '2023-06-22 14:24:07', 1),
(48, 10, 'Bluebird 165 Watt 12 Volt Polycrystalline Solar Pa', '6500', 'Cost efficient Polycrystalline technology.\r\nBuilt with high efficiency A grade 5BB solar cells.\r\nAR-coated glass for better sunlight absorption.\r\nSilver anodized aluminium frame with mounting holes for fast & easy installation.\r\nExcellent power output in low light & cloudy sky conditions.\r\nDouble EL tested for hot spots & microcrack free solar modules. \r\nWater & Dust Proof IP68 rated Junction box with 4mm cable and 2 MC4 connectors.', 'product/solarpanel11.png', '2', '2023-06-22 14:26:03', 1),
(49, 10, 'Bluebird 400 Watt 24 Volt Mono PERC Solar Panel', '16000', 'Advanced Mono PERC technology .\r\nBuilt with high efficiency A grade 5BB solar cells.\r\nAR-coated glass for better sunlight absorption.\r\nSilver anodized aluminium frame with mounting holes for fast & easy installation.\r\nExcellent power output in low light & cloudy sky conditions.\r\nDouble EL tested for hot spots & microcrack free solar modules. \r\nWater & Dust Proof IP68 rated Junction box with 4mm cable and 2 MC4 connectors.', 'product/solar panel12.png', '2', '2023-06-22 14:28:36', 1),
(50, 10, 'Microtek Solar Panel MTK 260Watt 24V', '11900', 'Positive Power Tolerance Modules; High Conversion Efficiency; Anti-Reflective Coating Glass\r\nNominal Maximum Power (Pm) 260Watts/24V; Open Circuit Voltage : 37.60V; Short Circuit Current : 8.88A\r\nSolar Cell Type : Multi Crystalline Silicon; Frame Material : Anodized Aluminum Alloy; Front Cover Material Tempered : Low Iron Glass\r\nModel: 260WATT/24V ; This pack includes one Microtek PV Module 150 Watt\r\nProduct Dimension : (LxWxT) 1495x665x35 (mm)\r\n', 'product/solarpanel13.webp', '1', '2023-06-22 16:22:07', 1),
(51, 11, 'LiFePO4 Lithium Ion Solar Battery', '31700', 'LiFePO4 Lithium Ion Solar Battery,Our LiFePO4 Lithium Ion Solar Battery including battery cabinet, all battery cables are connected well, including BMS and LCD display, when customer receive it then can directly use, can built in solar charge controller or AC-DC charger in our battery cabinet, our BMS can adjust charging current based on every power cell actual status, intelligently charge and protect batteries, more reliable and extend battery service life.', 'product/battery7.jpg', '5', '2023-06-22 21:03:42', 1),
(52, 11, 'Livguard Solar 165AH Battery LS 16560TT', '15999', 'Livguard 165AH, 12V Solar Tall Tubular UPS Battery LS 16560TT, Hybrid Inverter UPS Energy Storage from Photovoltaic, Buy Solar Power Off-grid Solution for Home, Office Commercial Applications, 5 yrs* warranty.', 'product/battery8.jpg', '5', '2023-06-22 21:05:12', 1),
(53, 13, 'Solar Universe Ceiling Solar Fan Set  (25 W)', '3002', 'Brand\r\nSolar Universe\r\nModel Number\r\nSUI-VO-RC-BLDC Ceiling Fan\r\nCeiling Fan with Inbuilt LED Light & Remote Controller', 'product/homepro3.png', '2', '2023-06-26 15:44:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `product_track` varchar(25) NOT NULL,
  `user_fullname` varchar(50) NOT NULL,
  `user_address` text NOT NULL,
  `user_state` varchar(50) NOT NULL,
  `user_city` varchar(50) NOT NULL,
  `user_pin` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_method` varchar(25) NOT NULL,
  `payment_no` varchar(50) NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `employee_id`, `product_track`, `user_fullname`, `user_address`, `user_state`, `user_city`, `user_pin`, `amount`, `payment_method`, `payment_no`, `payment_status`, `date`) VALUES
(1, 13, 'PROD36603', 'Sunil', 'konchady', '', 'mangaluru', 575008, 19632, 'Credit Card', 'PAY18200', 1, '2023-06-19 17:20:20'),
(2, 13, 'PROD81585', 'prajay kumar', 'maryhill', '', 'mangaluru', 575008, 28287, 'Cash', 'PAY95406', 1, '2023-06-28 10:45:35'),
(3, 13, 'PROD67453', 'CHANDRA', 'MARYHILL MANGALURU', '', 'MANGALURU', 575008, 1300, 'Debit Card', 'PAY79523', 1, '2023-06-28 10:52:34');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_track`
--

CREATE TABLE `purchase_track` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `track_no` varchar(25) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_track`
--

INSERT INTO `purchase_track` (`id`, `product_id`, `quantity`, `track_no`, `date`) VALUES
(1, 5, 1, 'PROD96784', '2023-06-16 10:55:47'),
(2, 3, 2, 'PROD36603', '2023-06-19 17:19:50'),
(3, 5, 1, 'PROD36603', '2023-06-19 17:19:55'),
(4, 3, 3, 'PROD79399', '2023-06-19 17:50:33'),
(5, 3, 2, 'PROD81585', '2023-06-28 10:44:39'),
(6, 5, 5, 'PROD81585', '2023-06-28 10:44:45'),
(7, 35, 1, 'PROD81585', '2023-06-28 10:45:04'),
(8, 18, 1, 'PROD67453', '2023-06-28 10:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `product_id` int(10) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `service_no` varchar(25) NOT NULL,
  `problem` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `amount` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `userid`, `product_id`, `employee_id`, `service_no`, `problem`, `status`, `date`, `amount`) VALUES
(1, 3, 13, 0, 'SER683625', 'light not working', 1, '2023-06-28 10:33:56', NULL),
(2, 16, 34, 13, 'SER762201', 'shut off suddenly, not working now\r\n', 0, '2023-06-28 10:36:20', 500),
(3, 14, 24, 0, 'SER115740', 'pump motor need to be repaired', 1, '2023-06-28 10:39:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `product_id`, `employee_id`, `quantity`, `status`) VALUES
(1, 1, 5, 9, 1),
(2, 2, 5, 9, 1),
(3, 3, 5, 4, 1),
(4, 4, 5, 12, 1),
(5, 5, 5, 12, 1),
(6, 2, 3, 1, 1),
(7, 35, 13, 1, 1),
(8, 12, 13, 10, 1),
(9, 18, 13, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trackorder`
--

CREATE TABLE `trackorder` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `trackno` varchar(75) NOT NULL,
  `status` varchar(75) NOT NULL,
  `remark` varchar(75) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trackorder`
--

INSERT INTO `trackorder` (`id`, `userid`, `trackno`, `status`, `remark`, `date`) VALUES
(1, 3, 'BBORD3TRC20230607122012', 'Initiated', 'Order has been Initiated.', '2023-06-07 15:50:12'),
(2, 1, 'BBORD1TRC20230609134945', 'Initiated', 'Order has been Initiated.', '2023-06-09 17:19:45'),
(3, 1, 'BBORD1TRC20230609140323', 'Initiated', 'Order has been Initiated.', '2023-06-09 17:33:23'),
(4, 1, 'BBORD1TRC20230609140333', 'Initiated', 'Order has been Initiated.', '2023-06-09 17:33:33'),
(5, 1, 'BBORD1TRC20230609141401', 'Initiated', 'Order has been Initiated.', '2023-06-09 17:44:01'),
(6, 3, 'BBORD3TRC20230609150944', 'Initiated', 'Order has been Initiated.', '2023-06-09 18:39:44'),
(7, 13, 'BBORD13TRC20230614105206', 'Initiated', 'Order has been Initiated.', '2023-06-14 14:22:06'),
(8, 3, 'BBORD3TRC20230621060206', 'Initiated', 'Order has been Initiated.', '2023-06-21 09:32:06'),
(9, 3, 'BBORD3TRC20230622172119', 'Initiated', 'Order has been Initiated.', '2023-06-22 20:51:19'),
(10, 3, 'BBORD3TRC20230626072430', 'Initiated', 'Order has been Initiated.', '2023-06-26 10:54:30'),
(11, 3, 'BBORD3TRC20230627071337', 'Initiated', 'Order has been Initiated.', '2023-06-27 10:43:37'),
(12, 3, 'BBORD3TRC20230628064920', 'Initiated', 'Order has been Initiated.', '2023-06-28 10:19:20'),
(13, 16, 'BBORD16TRC20230628065728', 'Initiated', 'Order has been Initiated.', '2023-06-28 10:27:28'),
(14, 14, 'BBORD14TRC20230628070849', 'Initiated', 'Order has been Initiated.', '2023-06-28 10:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(75) NOT NULL,
  `type` varchar(25) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(700) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(1) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(15) NOT NULL,
  `designation` varchar(25) NOT NULL,
  `address2` text NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `type`, `username`, `password`, `image`, `date`, `status`, `address`, `contact`, `designation`, `address2`, `state`, `city`, `pincode`) VALUES
(1, 'Prajay', 'Kumar', 'admin@gmail.com', 'Admin', 'Admin', 'admin123', 'user/user_image.jpg', '2023-05-31 15:07:21', '1', 'Maryhill, Mangalore', '8965896523', 'Admin', 'Karnataka', 'Karnataka', 'Mangalore', 436346),
(3, 'Suraj', 'kumar', 'prajaykumar02@gmail.com', 'User', 'User', 'Prajay123', 'user/user_image.jpg', '2021-05-15 15:07:21', '1', 'Kankanady', '8965235698', '', 'Managalore', 'Karnataka', 'Mangalore', 575008),
(13, 'Prasad', 'kumar', 'prasad222@gmailc.com', 'Employee', 'Employee', 'Employee123', 'user/user_image.jpg', '2023-06-04 16:19:59', '1', 'Maryhill,Mangaluru', '7896541258', 'Manager', 'ddd', 'dddddd', 'dddd', 0),
(14, 'ABHISHEK', 'SHETTY', 'ABHISHEKSHEK3232@GMAIL.COM', 'User', 'ABHI', 'Abhishek@shetty12345', 'user/user_image.jpg', '2023-06-27 10:27:21', '1', 'bejai', '9638596582', '', 'mangaluru', 'karnataka', 'mangaluru', 5025854),
(15, 'Rajesh', 'kumar', 'rajannak5757@gmail.com', 'User', 'rajuu', 'Rajeshkumar12345', 'user/user_image.jpg', '2023-06-27 23:06:43', '1', '', '7898978594', '', '', '', '', 0),
(16, 'SOURABH', 'KUMAR', 'SOURABHKUMARSH333@GMAIL.COM', 'User', 'KUMARSOURABH', 'sOURABHKUMAR12345', 'user/user_image.jpg', '2023-06-27 23:13:18', '1', 'konchady', '9986856524', '', 'maryhill', 'karnataka', 'mangaluru', 575005),
(17, 'RAMESH', 'AMIN', 'RAMESHAMIN2929@GMAIL.COM', 'User', 'AMINRAMESH', 'Rameshamin12345', 'user/user_image.jpg', '2023-06-27 23:17:49', '1', '', '9696857447', '', '', '', '', 0),
(21, 'manoj', 'manoj', 'student@gmail.com', 'User', 'manu', 'MAnoj143@@', 'user/user_image.jpg', '2024-05-18 12:00:25', '1', '', '9999999999', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_payment`
--

CREATE TABLE `user_payment` (
  `payment_id` int(11) NOT NULL,
  `payment_no` varchar(75) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` varchar(75) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `track_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_payment`
--

INSERT INTO `user_payment` (`payment_id`, `payment_no`, `user_id`, `amount`, `payment_status`, `track_id`, `date`) VALUES
(1, 'PAY9872MM2', 1, '5318', 'PAID', 2, '2023-06-09 17:19:55'),
(2, 'PAY9879MM9', 3, '7549', 'PAID', 9, '2023-06-22 20:52:19'),
(3, 'PAY98712MM12', 3, '60000', 'PAID', 12, '2023-06-28 10:19:45'),
(4, 'PAY98713MM13', 16, '18597', 'PAID', 13, '2023-06-28 10:27:52'),
(5, 'PAY98714MM14', 14, '7800', 'PAID', 14, '2023-06-28 10:39:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_track`
--
ALTER TABLE `purchase_track`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trackorder`
--
ALTER TABLE `trackorder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_payment`
--
ALTER TABLE `user_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_track`
--
ALTER TABLE `purchase_track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `trackorder`
--
ALTER TABLE `trackorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_payment`
--
ALTER TABLE `user_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
