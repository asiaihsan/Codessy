-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2025 at 11:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `codessy`
--
CREATE DATABASE IF NOT EXISTS `codessy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `codessy`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_password` text NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `admin_name`, `admin_password`, `created_at`) VALUES
(1, 'Bahra Hidayat', '12345678', '2020-05-07'),
(2, 'Baxan Hamid', 'baxan33', '2023-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `completed_lectures`
--

CREATE TABLE `completed_lectures` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `lecture_id` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `completed_lectures`
--

INSERT INTO `completed_lectures` (`id`, `user_id`, `language_id`, `lecture_id`, `created_at`) VALUES
(1, 1, 1, 3, '2025-05-17'),
(4, 12, 3, 9, '2025-05-17'),
(8, 9, 2, 5, '2025-05-17'),
(9, 9, 2, 8, '2025-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `completed_quizzes`
--

CREATE TABLE `completed_quizzes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `user_answer` text NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `completed_quizzes`
--

INSERT INTO `completed_quizzes` (`id`, `user_id`, `quiz_id`, `user_answer`, `created_at`) VALUES
(1, 1, 2, '#header { background-color: red; }', '2025-05-17'),
(2, 12, 1, '<!DOCTYPE html>', '2025-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `lecture_title` varchar(255) NOT NULL,
  `lecture_code` text NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`id`, `admin_id`, `language_id`, `lecture_title`, `lecture_code`, `created_at`) VALUES
(1, 1, 1, 'HTML Introduction', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <title>My First Page</title>\r\n</head>\r\n<body>\r\n    <h1>Hello World!</h1>\r\n    <p>This is my first HTML page.</p>\r\n</body>\r\n</html>', '2025-05-01'),
(2, 1, 1, 'HTML Basic', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <title>My First Page</title>\r\n</head>\r\n<body>\r\n    <h1>Hello World!</h1>\r\n    <p>This is my first HTML page.</p>\r\n</body>\r\n</html>', '2025-05-01'),
(3, 2, 1, 'HTML Elements', '<!DOCTYPE html>\r\n<html>\r\n<body>\r\n    <h1>Heading 1</h1>\r\n    <h2>Heading 2</h2>\r\n    <p>This is a paragraph.</p>\r\n    <button>Click Me</button>\r\n</body>\r\n</html>', '2025-05-05'),
(4, 2, 1, 'HTML Attributes', '<!DOCTYPE html>\r\n<html>\r\n<body>\r\n    <a href=\"https://www.example.com\">Visit Example</a>\r\n    <img src=\"image.jpg\" alt=\"Sample Image\">\r\n</body>\r\n</html>', '2025-05-07'),
(5, 2, 2, 'CSS Introduction', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n<style>\r\nbody {\r\n  background-color: lightblue;\r\n}\r\n\r\nh1 {\r\n  color: white;\r\n  text-align: center;\r\n}\r\n\r\np {\r\n  font-family: verdana;\r\n  font-size: 20px;\r\n}\r\n</style>\r\n</head>\r\n<body>\r\n\r\n<h1>My First CSS Example</h1>\r\n<p>This is a paragraph.</p>\r\n\r\n</body>\r\n</html>\r\n\r\n\r\n', '2025-05-01'),
(6, 1, 2, 'CSS Selectors', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <style>\r\n        /* Element selector */\r\n        p {\r\n            color: blue;\r\n        }\r\n        \r\n        /* Class selector */\r\n        .highlight {\r\n            background: yellow;\r\n        }\r\n        \r\n        /* ID selector */\r\n        #main-title {\r\n            font-size: 24px;\r\n        }\r\n    </style>\r\n</head>\r\n<body>\r\n    <h1 id=\"main-title\">CSS Selectors</h1>\r\n    <p>This paragraph will be blue.</p>\r\n    <p class=\"highlight\">This paragraph has yellow background.</p>\r\n    <div class=\"highlight\">This div also has yellow background.</div>\r\n</body>\r\n</html>', '2025-05-06'),
(7, 1, 2, 'How to Add CSS', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <!-- Internal CSS -->\r\n    <style>\r\n        body {\r\n            font-family: Arial;\r\n            background: #f0f0f0;\r\n        }\r\n        h1 {\r\n            color: darkblue;\r\n        }\r\n    </style>\r\n    <!-- External CSS (create a file named styles.css) -->\r\n    <link rel=\"stylesheet\" href=\"styles.css\">\r\n</head>\r\n<body>\r\n    <h1>Three Ways to Add CSS</h1>\r\n    \r\n    <!-- Inline CSS -->\r\n    <p style=\"color: red; font-weight: bold;\">1. Inline CSS (using style attribute)</p>\r\n    \r\n    <p>2. Internal CSS (using style tag in head)</p>\r\n    \r\n    <p class=\"external-style\">3. External CSS (linking to .css file)</p>\r\n</body>\r\n</html>', '2025-05-06'),
(8, 2, 2, 'CSS Comments', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <style>\r\n        /* This is a single-line CSS comment */\r\n        \r\n        /*\r\n        This is a\r\n        multi-line CSS comment\r\n        */\r\n        \r\n        p {\r\n            color: blue; /* Change paragraph text to blue */\r\n            /* font-size: 16px; This rule is commented out */\r\n        }\r\n        \r\n        /* \r\n        .old-style {\r\n            border: 1px solid red;\r\n        }\r\n        */\r\n    </style>\r\n</head>\r\n<body>\r\n    <p>This paragraph will be blue because the style is active.</p>\r\n    <p style=\"color: red;\">This inline style overrides the CSS.</p>\r\n    <!-- This is an HTML comment (different from CSS comments) -->\r\n</body>\r\n</html>', '2025-05-01'),
(9, 1, 3, 'JS Introduction', '<!DOCTYPE html>\r\n<html>\r\n<body>\r\n    <h2>JavaScript Introduction</h2>\r\n    <p id=\"demo\">JavaScript can change HTML content.</p>\r\n    <button onclick=\"document.getElementById(\'demo\').innerHTML = \'Hello JavaScript!\'\">\r\n        Click Me\r\n    </button>\r\n</body>\r\n</html>', '2025-05-06'),
(10, 1, 3, 'JS Where To', '<!DOCTYPE html>\r\n<html>\r\n<body>\r\n    <h2>Where to Put JavaScript</h2>\r\n    <p id=\"where-demo\"></p>\r\n\r\n    <!-- Internal JS in body -->\r\n    <script>\r\n        document.getElementById(\"where-demo\").innerHTML = \"This comes from internal JavaScript\";\r\n    </script>\r\n\r\n    <!-- External JS file (script.js) would go here -->\r\n    <!-- <script src=\"script.js\"></script> -->\r\n</body>\r\n</html>', '2025-05-07'),
(11, 2, 3, ' JS Output', '<!DOCTYPE html>\r\n<html>\r\n<body>\r\n    <h2>JavaScript Output</h2>\r\n    <p id=\"output-demo\"></p>\r\n    <script>\r\n        // Writing to HTML element\r\n        document.getElementById(\"output-demo\").innerHTML = \"This is HTML output\";\r\n        \r\n        // Writing to browser console\r\n        console.log(\"This appears in console\");\r\n        \r\n        // Alert box\r\n        // alert(\"This is an alert box\");\r\n    </script>\r\n</body>\r\n</html>', '2025-05-07'),
(12, 2, 3, ' JS Statements', '<!DOCTYPE html>\r\n<html>\r\n<body>\r\n    <h2>JavaScript Statements</h2>\r\n    <p id=\"state-demo\"></p>\r\n    <script>\r\n        // Multiple statements\r\n        let x, y, z;\r\n        x = 5;\r\n        y = 6;\r\n        z = x + y;\r\n        document.getElementById(\"state-demo\").innerHTML = \"The sum is \" + z;\r\n    </script>\r\n</body>\r\n</html>', '2025-05-14'),
(13, 2, 1, 'HTML Headings & Paragraphs', '<!DOCTYPE html>\r\n<html>\r\n<body>\r\n    <h1>Main Heading (Most Important)</h1>\r\n    <p>This is a paragraph under the main heading.</p>\r\n    \r\n    <h2>Secondary Heading</h2>\r\n    <p>Another paragraph here with more details.</p>\r\n    \r\n    <h3>Sub-section Heading</h3>\r\n    <p>Supporting content for this section.</p>\r\n</body>\r\n</html>', '2025-05-16'),
(14, 2, 3, 'JS Syntax', '// Variables\r\nlet message = \"Hello World\";\r\nconst PI = 3.14;\r\nvar count = 5;\r\n\r\n// Data Types\r\nlet number = 10;          // Number\r\nlet text = \"JS Syntax\";   // String\r\nlet isTrue = true;        // Boolean\r\nlet empty = null;         // Null\r\n\r\n// Operators\r\nlet sum = 5 + 3;          // Addition\r\nlet result = 10 > 5;      // Comparison (returns true)\r\n\r\n// Functions\r\nfunction greet(name) {\r\n    return \"Hello \" + name;\r\n}\r\n\r\n// Console Output\r\nconsole.log(message);      // Prints: Hello World\r\nconsole.log(greet(\"Alice\")); // Prints: Hello Alice', '2025-05-16'),
(16, 1, 2, 'CSS Color', '<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <title>CSS Color Examples</title>\r\n    <style>\r\n        /* Color by name */\r\n        .color-name {\r\n            color: darkorange;\r\n            background-color: whitesmoke;\r\n        }\r\n\r\n        /* Hexadecimal */\r\n        .hex {\r\n            color: #ff5733;  /* Orange-red */\r\n            background-color: #333333;  /* Dark gray */\r\n        }\r\n\r\n        /* RGB */\r\n        .rgb {\r\n            color: rgb(0, 150, 255);  /* Light blue */\r\n            background-color: rgb(50, 50, 50);  /* Dark gray */\r\n        }\r\n\r\n        /* RGBA (with transparency) */\r\n        .rgba {\r\n            background-color: rgba(255, 0, 0, 0.3);  /* Red with 30% opacity */\r\n            border: 2px solid rgba(0, 0, 0, 0.8);\r\n        }\r\n\r\n        /* HSL */\r\n        .hsl {\r\n            color: hsl(120, 100%, 50%);  /* Pure green */\r\n            background-color: hsl(240, 100%, 25%);  /* Dark blue */\r\n        }\r\n\r\n        /* Practical examples */\r\n        .gradient-box {\r\n            background: linear-gradient(to right, #ff8a00, #e52e71);\r\n            height: 100px;\r\n        }\r\n\r\n        .shadow-box {\r\n            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);\r\n            padding: 20px;\r\n        }\r\n\r\n        body {\r\n            font-family: Arial, sans-serif;\r\n            max-width: 800px;\r\n            margin: 0 auto;\r\n            padding: 20px;\r\n            line-height: 1.6;\r\n        }\r\n\r\n        section {\r\n            margin-bottom: 30px;\r\n            padding: 15px;\r\n            border-radius: 5px;\r\n        }\r\n    </style>\r\n</head>\r\n<body>\r\n    <h1>CSS Color Methods</h1>\r\n    \r\n    <section class=\"color-name\">\r\n        <h2>Named Colors</h2>\r\n        <p>Using predefined color names like \"darkorange\" and \"whitesmoke\"</p>\r\n    </section>\r\n\r\n    <section class=\"hex\">\r\n        <h2>Hexadecimal Colors</h2>\r\n        <p>Using 6-digit hex codes (#RRGGBB)</p>\r\n    </section>\r\n\r\n    <section class=\"rgb\">\r\n        <h2>RGB Colors</h2>\r\n        <p>Using rgb(red, green, blue) values (0-255 each)</p>\r\n    </section>\r\n\r\n    <section class=\"rgba\">\r\n        <h2>RGBA Colors</h2>\r\n        <p>RGB with alpha/transparency (0-1)</p>\r\n    </section>\r\n\r\n    <section class=\"hsl\">\r\n        <h2>HSL Colors</h2>\r\n        <p>hsl(hue, saturation%, lightness%)</p>\r\n    </section>\r\n\r\n    <section class=\"gradient-box\">\r\n        <h2 style=\"color:white;\">Gradient Example</h2>\r\n    </section>\r\n\r\n    <section class=\"shadow-box\">\r\n        <h2>Shadow with RGBA</h2>\r\n        <p>Notice the transparent shadow effect</p>\r\n    </section>\r\n</body>\r\n</html>', '2025-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `programing_language`
--

CREATE TABLE `programing_language` (
  `id` int(11) NOT NULL,
  `language_name` varchar(255) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programing_language`
--

INSERT INTO `programing_language` (`id`, `language_name`, `created_at`) VALUES
(1, 'HTML', '2025-05-15'),
(2, 'CSS', '2025-05-15'),
(3, 'JavaScript', '2025-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `lecture_id` int(11) NOT NULL,
  `quiz_title` varchar(255) NOT NULL,
  `quiz_content` text NOT NULL,
  `quiz_code` text NOT NULL,
  `quiz_answer` text NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `admin_id`, `language_id`, `lecture_id`, `quiz_title`, `quiz_content`, `quiz_code`, `quiz_answer`, `created_at`) VALUES
(1, 1, 1, 1, 'HTML5 Doctype', 'What is the correct first line for an HTML5 document?', '<html>\r\n<head>\r\n    <title>Page</title>\r\n</head>', '<!DOCTYPE html>', '2025-05-16'),
(2, 2, 2, 6, 'ID Selector', 'How would you make the element with ID \"header\" have a red background?', '<div id=\"header\">Welcome</div>', '#header { background-color: red; }', '2025-05-16'),
(3, 2, 3, 11, 'Browser Console', 'What JavaScript code prints \"Debug message\" to the console?', '// Debugging example\r\nfunction test() {\r\n    let x = 5;\r\n}', 'console.log(\"Debug message\");', '2025-05-16'),
(4, 2, 1, 3, 'Hyperlink', 'What HTML creates a link to \"example.com\" with text \"Click\"?', '<nav>\r\n    <!-- Navigation link goes here -->\r\n</nav>', '<a href=\"https://example.com\">Click</a>', '2025-05-16'),
(5, 2, 2, 16, 'CSS Colors', ' What CSS rule would make all <h2> elements appear in \"darkcyan\" color?', '<h2>Section Title</h2>', 'h2 { color: darkcyan; }', '2025-05-17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` text NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `user_email`, `user_password`, `created_at`) VALUES
(1, 'Asia_Ihsan', 'asiaihsan655@gmail.com', 'asia123', '2025-05-16'),
(6, 'Arivan Ismail', 'arivaniibrahim7@gamil.com', 'arivan22', '2025-05-17'),
(7, 'shayma pshtewan', 'shayma@gmail.com', 'shayma33', '2025-05-17'),
(9, 'payam', 'payam@gmail.com', 'payam11', '2025-05-17'),
(10, 'naznaz', 'naznaz@gmail.com', 'naznaz88', '2025-05-17'),
(12, 'alya', 'alya@gmail.com', 'alya124', '2025-05-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `completed_lectures`
--
ALTER TABLE `completed_lectures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `completed_quizzes`
--
ALTER TABLE `completed_quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lectures`
--
ALTER TABLE `lectures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programing_language`
--
ALTER TABLE `programing_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `completed_lectures`
--
ALTER TABLE `completed_lectures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `completed_quizzes`
--
ALTER TABLE `completed_quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lectures`
--
ALTER TABLE `lectures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `programing_language`
--
ALTER TABLE `programing_language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

--
-- Dumping data for table `pma__export_templates`
--

INSERT INTO `pma__export_templates` (`id`, `username`, `export_type`, `template_name`, `template_data`) VALUES
(1, 'root', 'server', 'codessy', '{\"quick_or_custom\":\"quick\",\"what\":\"sql\",\"db_select[]\":[\"codessy\",\"phpmyadmin\",\"test\"],\"aliases_new\":\"\",\"output_format\":\"sendit\",\"filename_template\":\"@SERVER@\",\"remember_template\":\"on\",\"charset\":\"utf-8\",\"compression\":\"none\",\"maxsize\":\"\",\"codegen_structure_or_data\":\"data\",\"codegen_format\":\"0\",\"csv_separator\":\",\",\"csv_enclosed\":\"\\\"\",\"csv_escaped\":\"\\\"\",\"csv_terminated\":\"AUTO\",\"csv_null\":\"NULL\",\"csv_columns\":\"something\",\"csv_structure_or_data\":\"data\",\"excel_null\":\"NULL\",\"excel_columns\":\"something\",\"excel_edition\":\"win\",\"excel_structure_or_data\":\"data\",\"json_structure_or_data\":\"data\",\"json_unicode\":\"something\",\"latex_caption\":\"something\",\"latex_structure_or_data\":\"structure_and_data\",\"latex_structure_caption\":\"Structure of table @TABLE@\",\"latex_structure_continued_caption\":\"Structure of table @TABLE@ (continued)\",\"latex_structure_label\":\"tab:@TABLE@-structure\",\"latex_relation\":\"something\",\"latex_comments\":\"something\",\"latex_mime\":\"something\",\"latex_columns\":\"something\",\"latex_data_caption\":\"Content of table @TABLE@\",\"latex_data_continued_caption\":\"Content of table @TABLE@ (continued)\",\"latex_data_label\":\"tab:@TABLE@-data\",\"latex_null\":\"\\\\textit{NULL}\",\"mediawiki_structure_or_data\":\"data\",\"mediawiki_caption\":\"something\",\"mediawiki_headers\":\"something\",\"htmlword_structure_or_data\":\"structure_and_data\",\"htmlword_null\":\"NULL\",\"ods_null\":\"NULL\",\"ods_structure_or_data\":\"data\",\"odt_structure_or_data\":\"structure_and_data\",\"odt_relation\":\"something\",\"odt_comments\":\"something\",\"odt_mime\":\"something\",\"odt_columns\":\"something\",\"odt_null\":\"NULL\",\"pdf_report_title\":\"\",\"pdf_structure_or_data\":\"data\",\"phparray_structure_or_data\":\"data\",\"sql_include_comments\":\"something\",\"sql_header_comment\":\"\",\"sql_use_transaction\":\"something\",\"sql_compatibility\":\"NONE\",\"sql_structure_or_data\":\"structure_and_data\",\"sql_create_table\":\"something\",\"sql_auto_increment\":\"something\",\"sql_create_view\":\"something\",\"sql_create_trigger\":\"something\",\"sql_backquotes\":\"something\",\"sql_type\":\"INSERT\",\"sql_insert_syntax\":\"both\",\"sql_max_query_size\":\"50000\",\"sql_hex_for_binary\":\"something\",\"sql_utc_time\":\"something\",\"texytext_structure_or_data\":\"structure_and_data\",\"texytext_null\":\"NULL\",\"yaml_structure_or_data\":\"data\",\"\":null,\"as_separate_files\":null,\"csv_removeCRLF\":null,\"excel_removeCRLF\":null,\"json_pretty_print\":null,\"htmlword_columns\":null,\"ods_columns\":null,\"sql_dates\":null,\"sql_relation\":null,\"sql_mime\":null,\"sql_disable_fk\":null,\"sql_views_as_tables\":null,\"sql_metadata\":null,\"sql_drop_database\":null,\"sql_drop_table\":null,\"sql_if_not_exists\":null,\"sql_simple_view_export\":null,\"sql_view_current_user\":null,\"sql_or_replace_view\":null,\"sql_procedure_function\":null,\"sql_truncate\":null,\"sql_delayed\":null,\"sql_ignore\":null,\"texytext_columns\":null}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2025-05-17 09:09:57', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
