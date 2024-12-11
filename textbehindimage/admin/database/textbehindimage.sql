-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2024 at 08:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `textbehindimage`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(1000) NOT NULL,
  `admin_email` varchar(1000) NOT NULL,
  `admin_password` varchar(1000) NOT NULL,
  `admin_image` int(11) NOT NULL,
  `admin_role` varchar(1000) NOT NULL,
  `admin_status` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_image`, `admin_role`, `admin_status`) VALUES
(1, 'Naveed ', 'admin@gmail.com', 'pass', 1, 'admin', 'publish'),
(2, 'Ali', 'ali@gmail.com', '123', 2, 'admin', 'draft'),
(3, '', '', '', 0, '', ''),
(4, '', '', '', 0, '', ''),
(5, '', '', '', 0, '', ''),
(6, '', '', '', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(500) NOT NULL,
  `category_url` varchar(500) NOT NULL,
  `category_content` text NOT NULL,
  `meta_title` varchar(500) NOT NULL,
  `meta_description` varchar(500) NOT NULL,
  `meta_keywords` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_url`, `category_content`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(1, 'Generator', 'generator', '<p>content for category page</p>', 'content for category page', 'content for category page', 'content for category page'),
(2, 'Converter', 'converter', '', '', '', ''),
(3, 'Others', 'others', '', '', '', ''),
(4, 'Checker', 'checker', '', 'checker', 'checker', 'checker');

-- --------------------------------------------------------

--
-- Table structure for table `contactform`
--

CREATE TABLE `contactform` (
  `contactform_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactform`
--

INSERT INTO `contactform` (`contactform_id`, `user_name`, `user_email`, `user_message`) VALUES
(1, 'Salman Ansari', 'salman@gmail.com', 'Testing');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faq_id` int(11) NOT NULL,
  `faq_question` varchar(1000) NOT NULL,
  `faq_answer` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faq_id`, `faq_question`, `faq_answer`) VALUES
(1, 'What is the purpose of this PHP script?', 'This PHP script allows users to create custom images with text behind them. It provides an easy-to-use platform for uploading images, adding customizable text, and adjusting the design according to specific needs. The script also includes features for SEO optimization, dynamic theme customization, and blog management.'),
(2, 'How do I add text behind the image?', 'After uploading an image, go to the image editor. Here, you can add custom text to the image. The text can be positioned anywhere on the image, and you can adjust its size, color, transparency, and alignment.'),
(3, 'Can I adjust the position and style of the text?', 'Yes, you can adjust the position of the text by dragging it around the image. You can also modify the style by changing the font size, font color, and transparency. The text will appear behind the image, giving you full control over its appearance.'),
(4, 'Is the script secure?', 'Yes, the script is built with security in mind. User data and uploaded files are protected, and administrative access is secured with login credentials. It is always recommended to keep your script and server updated to ensure maximum security.');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `file_id` int(11) NOT NULL,
  `file_code` varchar(255) NOT NULL,
  `file_background` varchar(255) NOT NULL,
  `file_foreground` varchar(255) NOT NULL,
  `file_width` varchar(255) NOT NULL,
  `file_height` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`file_id`, `file_code`, `file_background`, `file_foreground`, `file_width`, `file_height`) VALUES
(1, '6CC12EBB', '6CC12EBB_background.png', '6CC12EBB_foreground.png', '1024', '1024'),
(2, '44755E15', '', '', '408', '252'),
(3, '17CC3637', '', '', '408', '252'),
(4, '0CFCFBF1', '', '', '513', '487'),
(5, 'AEB32872', '', '', '408', '252'),
(6, '39710840', '', '', '500', '750'),
(7, '9EF71F31', '', '', '500', '750'),
(8, '68E5DE56', '', '', '500', '750'),
(9, '1381DD9E', '', '', '640', '439'),
(10, '14A2A5CE', '', '', '500', '750'),
(11, '825377A0', '', '', '1280', '1668'),
(12, '41A3EB20', '', '', '613', '800'),
(13, '0B48B2CB', '', '', '333', '500'),
(14, '0A119533', '', '', '600', '399'),
(15, '04D31EB5', '', '', '333', '500'),
(16, '52F66E22', '', '', '500', '333'),
(17, '21B2D86D', '', '', '500', '333'),
(18, '952B9D0B', '', '', '383', '500'),
(19, '99C3D859', '', '', '412', '550'),
(20, '30D08065', '', '', '412', '550');

-- --------------------------------------------------------

--
-- Table structure for table `font`
--

CREATE TABLE `font` (
  `font_id` int(11) NOT NULL,
  `font_name` varchar(255) NOT NULL,
  `font_path` varchar(1000) NOT NULL,
  `font_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `font`
--

INSERT INTO `font` (`font_id`, `font_name`, `font_path`, `font_value`) VALUES
(1, 'Mea Culpa', '@import url(\'https://fonts.googleapis.com/css2?family=Mea+Culpa&display=swap\');', '\"Mea Culpa\", cursive'),
(2, 'Yesteryear', '@import url(\'https://fonts.googleapis.com/css2?family=Yesteryear&display=swap\');', 'Yesteryear'),
(3, 'Meddon', '@import url(\'https://fonts.googleapis.com/css2?family=Meddon&display=swap\');', 'Meddon'),
(4, 'Eagle Lake\r\n', '@import url(\'https://fonts.googleapis.com/css2?family=Eagle+Lake&display=swap\');', 'Eagle Lake\r\n'),
(5, 'Limelight', '@import url(\'https://fonts.googleapis.com/css2?family=Limelight&display=swap\');', ''),
(6, 'UnifrakturMaguntia', '@import url(\'https://fonts.googleapis.com/css2?family=UnifrakturMaguntia&display=swap\');\r\n', ''),
(7, 'Fascinate Inline', '@import url(\'https://fonts.googleapis.com/css2?family=Fascinate+Inline&display=swap\');\r\n', ''),
(8, 'Fascinate', '@import url(\'https://fonts.googleapis.com/css2?family=Fascinate&display=swap\');\r\n', ''),
(9, 'Kings', '@import url(\'https://fonts.googleapis.com/css2?family=Kings&display=swap\');\r\n', ''),
(10, 'Monoton', '@import url(\'https://fonts.googleapis.com/css2?family=Kings&family=Monoton&display=swap\');\r\n', 'Monoton'),
(11, 'Dr Sugiyama', '@import url(\'https://fonts.googleapis.com/css2?family=Dr+Sugiyama&display=swap\');\r\n', ''),
(12, 'Neonderthaw', '@import url(\'https://fonts.googleapis.com/css2?family=Neonderthaw&display=swap\');\r\n', 'Neonderthaw'),
(13, 'Liu Jian Mao Cao', '@import url(\'https://fonts.googleapis.com/css2?family=Liu+Jian+Mao+Cao&display=swap\');\r\n', ''),
(14, 'IM Fell French Canon\r\n', '@import url(\'https://fonts.googleapis.com/css2?family=IM+Fell+French+Canon:ital@0;1&display=swap\');\r\n', ''),
(15, 'Montserrat Underline', '@import url(\'https://fonts.googleapis.com/css2?family=Montserrat+Underline:ital,wght@0,100..900;1,100..900&display=swap\');', ''),
(16, 'Pacifico', '@import url(\'https://fonts.googleapis.com/css2?family=Pacifico&display=swap\');', ''),
(17, 'Orbitron', '@import url(\'https://fonts.googleapis.com/css2?family=Orbitron:wght@400..900&display=swap\');', ''),
(18, 'Stalinist One', '@import url(\'https://fonts.googleapis.com/css2?family=Stalinist+One&display=swap\');', ''),
(19, 'Nosifer', '@import url(\'https://fonts.googleapis.com/css2?family=Nosifer&display=swap\');', ''),
(20, 'Petit Formal Script', '@import url(\'https://fonts.googleapis.com/css2?family=Petit+Formal+Script&display=swap\');', ''),
(21, 'Charmonman', '@import url(\'https://fonts.googleapis.com/css2?family=Charmonman:wght@400;700&display=swap\');', ''),
(22, 'Love Light', '@import url(\'https://fonts.googleapis.com/css2?family=Love+Light&display=swap\');', ''),
(23, 'Inspiration', '@import url(\'https://fonts.googleapis.com/css2?family=Inspiration&display=swap\');', '');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `menu_location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `page_id`, `menu_location`) VALUES
(1, 1, 'header'),
(2, 2, 'header'),
(3, 3, 'footer'),
(4, 4, 'footer'),
(5, 6, 'header');

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

CREATE TABLE `meta` (
  `meta_id` int(11) NOT NULL,
  `meta_title` varchar(500) NOT NULL,
  `meta_description` varchar(1000) NOT NULL,
  `meta_keyword` varchar(500) NOT NULL,
  `meta_source` varchar(255) NOT NULL,
  `meta_source_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meta`
--

INSERT INTO `meta` (`meta_id`, `meta_title`, `meta_description`, `meta_keyword`, `meta_source`, `meta_source_id`) VALUES
(1, 'Me ipsum esse dicerem, inquam, nisi mihi viderer habere bene cognitam voluptatem et satis firme ', 'Me ipsum esse dicerem, inquam, nisi mihi viderer habere bene cognitam voluptatem et satis firme ', 'ashdjkshad,ajsdklsajkd,asjdhklsajd', 'post', 3),
(2, 'change Ut perspiciatis omnisSit delectus est illum optio et accusantium beatae. In sunt sim', 'change aliquam doloremque sed repudiandae eni', 'change  reiciendis officiis quo repudiandae voluptate. At dolorem aliquid', 'post', 4),
(3, 'change Ut perspiciatis omnisSit delectus est illum optio et accusantium beatae. In sunt sim', 'change  aliquam doloremque sed repudiandae eni', 'change  reiciendis officiis quo repudiandae voluptate. At dolorem aliquid', 'post', 5);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `page_id` int(11) NOT NULL,
  `page` varchar(200) NOT NULL,
  `page_title` varchar(500) NOT NULL,
  `page_url` varchar(400) NOT NULL,
  `page_content` text NOT NULL,
  `meta_title` varchar(500) NOT NULL,
  `meta_description` varchar(1000) NOT NULL,
  `meta_keywords` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`page_id`, `page`, `page_title`, `page_url`, `page_content`, `meta_title`, `meta_description`, `meta_keywords`) VALUES
(1, 'about', 'About', 'about-us', '', 'Privacy Policy - [Your Website Name]', 'Read the Privacy Policy of [Your Website Name], where we explain how we collect, use, and protect your data when you upload images and create custom content on our platform.', 'privacy policy, user privacy, data protection, image upload, text overlay, website privacy, user data security, cookies, third-party services, data retention, privacy rights, online privacy'),
(2, 'contact-us', 'Contact', 'contact-us', '<p>abc</p>', 'Contact Us', 'Contact Us', 'Contact Us'),
(3, 'privacy-policy', 'Privacy Policy', 'privacy-policy', '<p>Effective Date: 07/12/2024</p><p>At [Your Website Name], we value your privacy and are committed to safeguarding the personal information you share with us. This Privacy Policy explains how we collect, use, and protect your information when you use our website to generate images.</p><h4>1. <strong>Information We Collect</strong></h4><p>When you visit and use [Your Website Name], we may collect the following types of information:</p><ul><li><strong>Uploaded Images</strong>: Any images you upload to the site for processing.</li><li><strong>Text Information</strong>: Any text you input for generating the final image.</li></ul><h4>2. <strong>How We Use Your Information</strong></h4><p>We use the information we collect for the following purposes:</p><ul><li>To process your uploaded images and text to generate the requested image.</li><li>To improve and enhance our website and services.</li><li>To provide you with a better user experience.</li></ul><p>We do not use your uploaded images or text for any other purposes unless you have provided explicit consent.</p><h4>3. <strong>Data Storage and Security</strong></h4><p>We take reasonable measures to protect your information, including your uploaded images and text, from unauthorized access or disclosure. However, please note that no method of transmission over the internet is completely secure, and we cannot guarantee absolute security.</p><ul><li><strong>Temporary Storage</strong>: Your uploaded images and generated images are stored temporarily for processing purposes.</li><li><strong>Permanent Storage</strong>: We do not store your uploaded images or generated content long-term. Once the image is generated and downloaded, the data is removed from our system unless otherwise specified by you.</li></ul><h4>4. <strong>Third-Party Services</strong></h4><p>We may use third-party services (such as analytics tools) to improve our website, but we do not share your uploaded content with these services. These third-party services may have access to your data, but their use is governed by their own privacy policies.</p><h4>5. <strong>Cookies</strong></h4><p>We may use cookies to enhance your user experience on our website. Cookies are small files stored on your device that help us understand how you interact with the site. You can control cookie settings through your browser, but disabling cookies may affect certain features of the site.</p><h4>6. <strong>Data Retention</strong></h4><p>Your uploaded images and generated images are stored temporarily on our servers and deleted once you have downloaded the image. We do not retain personal data beyond the time necessary to provide the service.</p><h4>7. <strong>Your Rights and Choices</strong></h4><p>You have the right to:</p><ul><li>Request access to the information we hold about you.</li><li>Request the deletion of your uploaded images or generated content from our system.</li><li>Withdraw your consent to the use of your data, where applicable.</li></ul><p>To exercise any of these rights, please contact us using the information below.</p><h4>8. <strong>Children\'s Privacy</strong></h4><p>Our website is not intended for use by children under the age of 13. We do not knowingly collect or solicit personal information from children. If you believe we have inadvertently collected such information, please contact us immediately so we can take appropriate action.</p><h4>9. <strong>Changes to This Privacy Policy</strong></h4><p>We reserve the right to update this Privacy Policy at any time. Any changes will be posted on this page, and the effective date will be updated accordingly. We encourage you to review this policy periodically to stay informed about how we protect your information.</p><h4>10. <strong>Contact Us</strong></h4><p>If you have any questions or concerns about this Privacy Policy or our data practices, please contact us at:</p><p>Email: [Your Contact Email]</p><p>Phone: [Your Contact Number]</p><p>Address: [Your Business Address]</p><p>By using [Your Website Name], you acknowledge that you have read and understood this Privacy Policy.</p>', 'Privacy Policy', 'Privacy Policy', 'Privacy Policy'),
(4, 'terms-and-conditions', 'Terms & Conditions', 'terms-conditions', '<p>Effective Date: 07/12/2024</p><p>Welcome to [Your Website Name]! By accessing and using our website, you agree to comply with and be bound by the following Terms and Conditions. If you do not agree with these terms, please refrain from using our services.</p><h4>1. <strong>Acceptance of Terms</strong></h4><p>By using [Your Website Name], you accept these Terms and Conditions, as well as our Privacy Policy, which governs your use of the website. These terms may be updated from time to time, and it is your responsibility to review them periodically.</p><h4>2. <strong>Use of the Website</strong></h4><p>You may only use our website for lawful purposes and in accordance with these Terms. You agree not to:</p><ul><li>Upload or submit any content that is illegal, harmful, or infringing on the intellectual property rights of others.</li><li>Use our website to transmit any harmful software, malware, or viruses.</li><li>Engage in any activity that disrupts or interferes with the proper functioning of our website.</li></ul><h4>3. <strong>User-Generated Content</strong></h4><ul><li><strong>Uploaded Images</strong>: When you upload images to our website, you retain full ownership and responsibility for the content you provide. By uploading images, you grant us a non-exclusive, worldwide license to use, process, and modify those images for the purpose of generating the requested output.</li><li><strong>Text Input</strong>: Any text input you provide for generating images will be processed for this purpose only. You are responsible for ensuring that your text does not violate any laws, including defamation, obscenity, or intellectual property rights.</li></ul><h4>4. <strong>Intellectual Property</strong></h4><ul><li>All content on [Your Website Name], including text, graphics, logos, images, and software, is the property of [Your Website Name] or its licensors and is protected by copyright and other intellectual property laws.</li><li>You may not reproduce, distribute, or create derivative works from any content on the website without express permission.</li></ul><h4>5. <strong>Account Registration</strong></h4><p>If you are required to create an account to access certain features of the website, you agree to provide accurate and up-to-date information during the registration process. You are responsible for maintaining the confidentiality of your account details and for all activities under your account.</p><h4>6. <strong>Privacy</strong></h4><p>By using [Your Website Name], you agree to our Privacy Policy, which outlines how we collect, use, and protect your data. Please review our Privacy Policy for more details.</p><h4>7. <strong>Limitation of Liability</strong></h4><ul><li>[Your Website Name] is not liable for any damages, losses, or expenses incurred by using our website or services, including but not limited to loss of data, images, or content.</li><li>We do not guarantee that the website will be error-free or uninterrupted. We are not responsible for any delays, interruptions, or failures in the service.</li></ul><h4>8. <strong>Third-Party Links and Services</strong></h4><p>Our website may contain links to third-party websites or services. These links are provided for your convenience, but we do not endorse or take responsibility for the content, policies, or practices of third-party sites. Use of third-party websites is at your own risk.</p><h4>9. <strong>Termination</strong></h4><p>We reserve the right to suspend or terminate your access to the website at our sole discretion if you violate these Terms and Conditions or engage in unlawful behavior. Upon termination, you must cease using the website immediately.</p><h4>10. <strong>Indemnification</strong></h4><p>You agree to indemnify and hold harmless [Your Website Name], its officers, directors, employees, and agents from any claims, liabilities, damages, or expenses arising out of your use of the website, violation of these Terms, or infringement of third-party rights.</p><h4>11. <strong>Governing Law</strong></h4><p>These Terms and Conditions are governed by the laws of [Your Country/State]. Any disputes will be resolved in the courts of [Your Jurisdiction].</p><h4>12. <strong>Changes to the Terms</strong></h4><p>We may update these Terms and Conditions from time to time. Any changes will be posted on this page, and the effective date will be updated accordingly. Please check this page regularly for updates.</p><h4>13. <strong>Contact Us</strong></h4><p>If you have any questions or concerns about these Terms and Conditions, please contact us at:</p><p>Email: [Your Contact Email]</p><p>Phone: [Your Contact Number]</p><p>Address: [Your Business Address]</p><p>By using [Your Website Name], you acknowledge that you have read, understood, and agree to be bound by these Terms and Conditions.</p>', 'Terms & Conditions', 'Terms & Conditions', ''),
(5, 'homepage', 'Homepage', '', '<h3>The standard Lorem Ipsum passage, used since the 1500s</h3>\r\n<p>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</p>\r\n<h3>Section 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC</h3>\r\n<p>\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"</p>\r\n<h3>1914 translation by H. Rackham</h3>\r\n<p>\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"</p>\r\n<h3>Section 1.10.33 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC</h3>\r\n<p>\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"</p>\r\n<h3>1914 translation by H. Rackham</h3>\r\n<p>\"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.\"</p>', 'Homepage Meta Title', 'Homepage Meta Description', 'calculator'),
(6, '', 'Blog', 'blog', '<p>Blog Content</p>', 'meta title', 'meta description', 'meta keyword');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `post_title` varchar(500) NOT NULL,
  `post_url` varchar(500) NOT NULL,
  `post_content` varchar(2000) NOT NULL,
  `post_thumbnail` varchar(500) NOT NULL,
  `post_views` int(11) NOT NULL,
  `post_date` varchar(255) NOT NULL,
  `post_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `category_id`, `post_title`, `post_url`, `post_content`, `post_thumbnail`, `post_views`, `post_date`, `post_status`) VALUES
(1, 1, 'Core Principles Of Design Thinking', 'core-principles-of-design-thinking', '&lt;p&gt;&amp;nbsp;&lt;/p&gt;', 'asdsad.png', 0, '2024-11-18', 'publish'),
(2, 1, 'Data as a Product: Data Architecture Principles for Management Blueprint', 'data-as-a-product-data-architecture-principles-for-management-blueprint', '&lt;p&gt;Est asperiores rerum et minus tenetur vel ipsam quasi.&lt;/p&gt;&lt;p&gt;Lorem ipsum dolor sit amet. Est reprehenderit galisum ut neque harum eum voluptates delectus. Sed ullam obcaecati aut pariatur modi aut voluptatem aliquam ut maiores quod. Aut dicta aliquam in veritatis galisum vel deleniti optio in eius incidunt.&lt;/p&gt;&lt;h2&gt;Est voluptatem amet ut ipsam expedita nam suscipit laudantium.&lt;/h2&gt;&lt;p&gt;Qui molestiae dolor eos incidunt exercitationem et esse excepturi eum sint eveniet vel voluptas repellat aut saepe illum quo nihil voluptatem? Eos voluptatibus omnis qui suscipit molestias in voluptate voluptas est temporibus iusto ut aperiam recusandae et recusandae quidem.&lt;/p&gt;&lt;h3&gt;Aut recusandae consectetur quo dolor porro aut fuga accusantium.&lt;/h3&gt;&lt;p&gt;Est quae cumque est rerum velit ut ipsum corporis ut temporibus suscipit aut sunt error aut possimus impedit. Et pariatur quia qui repellat aspernatur non modi quidem cum excepturi repellat quo obcaecati veritatis sit magni dolorem ut quod molestiae?&lt;/p&gt;&lt;h4&gt;Sit nihil tenetur ut facere excepturi.&lt;/h4&gt;&lt;p&gt;Quo debitis esse aut minus similique ut illum ducimus. Et rerum veniam sit mollitia fugiat et molestias placeat ut nulla corrupti.&lt;/p&gt;&lt;p&gt;Quo quibusdam quasi hic cupiditate libero ea eligendi architecto.&lt;/p&gt;&lt;p&gt;Eum soluta ullam eum fugit omnis ut quod dolor ut quae sequi est aperiam natus et suscipit numquam ut dolor magni. Ut impedit voluptatem vel voluptatem molestiae et perferendis fugiat est aliquam accusamus est neque libero id officia sint cum deserunt quos!&lt;/p&gt;&lt;p&gt;Et voluptatem sint ut aliquid aperiam ut dolor explicabo. In dolorem fugiat 33 natus voluptatem sed corrupti numquam et recusandae beatae et cumque natus id quis voluptatibus? Aut dolorum sunt eum esse doloribus sit veniam nisi est laborum perferendis ut quidem omnis eos pariatur enim et provident fugit.&amp;nbsp;&lt;/p&gt;', '267-1280x720.jpg', 0, '2024-11-18', 'publish'),
(3, 1, 'Data as a Product: The Role of Data Architecture and Data Modelling Strategy', 'data-as-a-product-the-role-of-data-architecture-and-data-modelling-strategy', '&lt;p&gt;Lorem ipsum dolor sit amet. Aut ullam praesentium &lt;i&gt;Quo consequuntur ea voluptatum ipsum aut quod illo&lt;/i&gt; aut recusandae quisquam. Et voluptate praesentium et eligendi doloremque &lt;strong&gt;Est odio et sint dignissimos&lt;/strong&gt;.&lt;/p&gt;&lt;p&gt;Aut saepe veniam et ullam voluptatehic molestiae ut quod officia. Qui fuga voluptatem &lt;i&gt;Et rerum est corporis deserunt aut fuga reiciendis&lt;/i&gt; quo sequi facere. Et nihil excepturi &lt;strong&gt;Aut sint ut labore iusto ab omnis dolorem ex illo corporis&lt;/strong&gt;.&lt;/p&gt;&lt;p&gt;Vel rerum possimus &lt;i&gt;Et alias At omnis corporis nam minima voluptatem et quia ullam&lt;/i&gt; et tenetur cumque in adipisci modi? Est quasi dolores &lt;strong&gt;Qui sunt&lt;/strong&gt; sed voluptas ipsa. Ut expedita repudiandae &lt;a href=&quot;https://www.loremipzum.com&quot;&gt;Est dolores qui sequi temporibus et corrupti quam&lt;/a&gt; ut internos quae.&lt;/p&gt;&lt;p&gt;At soluta quae &lt;a href=&quot;https://www.loremipzum.com&quot;&gt;Aut internos cum eveniet consequatur ut atque iste&lt;/a&gt; est optio magnam et nesciunt debitis ut rerum odit. Non possimus pariatur &lt;strong&gt;Et doloremque nam dicta quasi et eius sunt&lt;/strong&gt; qui adipisci inventore et quasi deleniti.&amp;nbsp;&lt;/p&gt;', '144-1280x720.jpg', 1, '2024-11-18', 'publish'),
(4, 3, 'Key considerations for Greenfield Product Engineering to build futuristic solutions', 'key-considerations-for-greenfield-product-engineering-to-build-futuristic-solutions', '&lt;p&gt;change &amp;nbsp;Non tempore galisum sit harum cupiditate.&lt;/p&gt;&lt;p&gt;Lorem ipsum dolor sit amet. Vel dolorem dolor nam temporibus asperiores &lt;i&gt;At dolor ut odio sint non autem sunt&lt;/i&gt;! Quo ullam nulla aut facilis saepeEos necessitatibus. Non consequatur consequatur &lt;strong&gt;Et Quis sed ducimus quam&lt;/strong&gt;? Aut ipsam optioEa minus qui modi nulla et neque dolores sed eveniet harum et fugit quas.&lt;/p&gt;&lt;h2&gt;Aut iure nisi hic vitae error.&lt;/h2&gt;&lt;p&gt;Ut perspiciatis omnisSit delectus est illum optio et accusantium beatae. In sunt similique quo iure fugiat &lt;strong&gt;Aut mollitia et voluptatibus earum et ipsam quidem et consectetur iste&lt;/strong&gt;. Et harum voluptates &lt;i&gt;Sit omnis non dolor facilis aut tempora error&lt;/i&gt; qui commodi error. Id natus sapienteVel quos quo natus fugit sed dolor quos ut quia fugit et incidunt assumenda aut modi accusamus!&lt;/p&gt;&lt;h3&gt;Ex quis omnis hic odit reiciendis.&lt;/h3&gt;&lt;p&gt;Ab facere sunt sit recusandae quiaAut distinctio. Et quas esse et illum deleniti &lt;strong&gt;Est saepe eos libero aspernatur id nostrum possimus et officia eaque&lt;/strong&gt;. Aut fugit nihil ut internos vitaeeos quasi. Est repellat isteIn dolorum ad cumque sunt id repellendus ratione.&lt;/p&gt;&lt;h4&gt;Aut consequatur voluptas aut porro corrupti et architecto iste.&lt;/h4&gt;&lt;p&gt;Ab autem pariatur in illo omnisEt consectetur cum reiciendis officiis quo repudiandae voluptate. At dolorem aliquid et nulla nemorem quod qui odio inventore! Hic laboriosam recusandae aut perferendis suscipitqui maxime et aliquam doloremque sed repudiandae enim.&lt;/p&gt;&lt;p&gt;Ut animi aliquid non nihil ducimus.&lt;/p&gt;&lt;p&gt;Qui odit porro ut odio dignissimos &lt;i&gt;Et maiores ut assumenda deserunt aut earum voluptas&lt;/i&gt;. Aut nemo voluptas vel minima atquecum sunt!&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Et reiciendis porro qui omnis minima in ipsam cupiditate.&lt;/li&gt;&lt;li&gt;Et tota', '49-1280x720.jpg', 3, '2024-11-18', 'publish'),
(5, 3, 'The future of data engineering in digital product engineering lies with Gen AI', 'the-future-of-data-engineering-in-digital-product-engineering-lies-with-gen-ai', '<p>Aut sunt dignissimos ea facilis distinctio non architecto fuga.</p><p>Lorem ipsum dolor sit amet. Non cupiditate dolorem ab tempore unde <i>Eum sapiente ut Quis odit et consequuntur recusandae</i>? Non fuga omnis et ullam nihil <a href=\"https://www.loremipzum.com\">Eum fugiat et repudiandae quaerat</a>. Aut voluptate laborum <strong>Rem rerum et alias consequatur et esse expedita</strong> sit reiciendis natus id error molestiae cum praesentium tenetur. Eum deserunt placeatUt labore in blanditiis minus quo corrupti nihil aut corporis eius ea quia modi?</p><h2>Aut alias magnam eos voluptatem nobis qui culpa incidunt.</h2><p>Vel possimus impedit est excepturi voluptate <strong>Ut eaque ut commodi maiores non ratione rerum</strong>. Qui quis aliquidAut pariatur et quos eligendi et facilis earum quo reprehenderit voluptatem ex iste accusantium eum nisi asperiores. Aut perferendis Quis <i>Ut optio non voluptatem porro et earum doloribus</i> aut magni odio. Et adipisci velitUt atque est iusto velit!</p><ul><li>Qui amet exercitationem non magni sunt et perspiciatis necessitatibus et galisum sunt.</li><li>Eos totam voluptas et quam itaque nam fugit velit cum sunt sapiente.</li><li>Sit quia beatae eum obcaecati beatae!</li><li>33 repellat suscipit et voluptates voluptatem quo quasi alias in fuga nihil.</li><li>Hic totam iure ab recusandae autem aut quibusdam error cum cumque harum?</li><li>Qui esse impedit ut maiores placeat!</li></ul><h3>At soluta aspernatur 33 beatae nisi.</h3><p>Aut nobis esse <a href=\"https://www.loremipzum.com\">Aut reiciendis ut earum accusamus sit perferendis labore</a> ut saepe ullam a consequuntur aperiam nam consequatur consectetur? Ut molestiae vero ut assumenda saepeut culpa sit veritatis tenetur. Qui aliquid laborum et deserunt oditet sunt a provident deserunt est tenetur reprehenderit! Et dolor quia ut asperiores doloret distinctio.</p><h4>Vel consectetur magnam At provident voluptate qui omnis cupiditate.</h4><p>Est minima perspiciatis qui dol', '35-1280x720.jpg', 22, '2024-11-18', 'publish');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `website_title` varchar(500) NOT NULL,
  `website_url` varchar(500) NOT NULL,
  `website_logo` varchar(500) NOT NULL,
  `website_favicon` varchar(500) NOT NULL,
  `website_head_code` text NOT NULL,
  `ad_code_one` text NOT NULL,
  `ad_code_two` text NOT NULL,
  `ad_code_three` text NOT NULL,
  `footer_text` text NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `instagram` varchar(25) NOT NULL,
  `pinterest` varchar(255) NOT NULL,
  `api` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `website_title`, `website_url`, `website_logo`, `website_favicon`, `website_head_code`, `ad_code_one`, `ad_code_two`, `ad_code_three`, `footer_text`, `facebook`, `twitter`, `instagram`, `pinterest`, `api`) VALUES
(1, 'Webster title', 'http://localhost/extras/others/textbehindimage', 'foldious-high-resolution-logo-white-transparent.png', 'Calculator-icon.png', '', '', '', '', 'About Section Data', 'aboutwebster', 'aboutwebster', 'aboutwebster', 'aboutwebster', 'gKzRiCoDmu1Pj8xy3MEDohny');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contactform`
--
ALTER TABLE `contactform`
  ADD PRIMARY KEY (`contactform_id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `font`
--
ALTER TABLE `font`
  ADD PRIMARY KEY (`font_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `meta`
--
ALTER TABLE `meta`
  ADD PRIMARY KEY (`meta_id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contactform`
--
ALTER TABLE `contactform`
  MODIFY `contactform_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `font`
--
ALTER TABLE `font`
  MODIFY `font_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `meta`
--
ALTER TABLE `meta`
  MODIFY `meta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
