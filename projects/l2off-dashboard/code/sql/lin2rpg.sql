CREATE TABLE `account` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(65) NOT NULL,
  `data_create` varchar(32) NOT NULL,
  `status` varchar(32) NOT NULL,
  `vip` int(11) DEFAULT NULL,
  `login` varchar(32) DEFAULT NULL,
  `logout` varchar(32)  DEFAULT NULL,
  `coupon` int(11) DEFAULT NULL,
  `access_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(11) NOT NULL,
  `free` int(11) NOT NULL,
  `price` varchar(11) DEFAULT NULL,
  `dyas` int(11) DEFAULT NULL,
  `chronic` varchar(100) NOT NULL,
  `project` varchar(20) NOT NULL,
  `plataform` varchar(16) NOT NULL,
  `html` varchar(2000) NULL DEFAULT 
  '<li>SUPORT&nbsp<i class="fas fa-check text-danger"></i></li>
  <li>REGISTER&nbsp<i class="fas fa-check text-success"></i></li>
  <li>LOGIN&nbsp<i class="fas fa-check text-success"></i></li>
  <li>UNLOCK CHARACTERES&nbsp<i class="fas fa-check text-success"></i></li>
  <li>CHANGE PASSWORD&nbsp<i class="fas fa-check text-success"></i></li>
  <li>COUNT REGRESSIVE&nbsp<i class="fas fa-check text-success"></i></li>
  <li>BOX FACEBOOK&nbsp<i class="fas fa-check text-success"></i></li>
  <li>CONTECT SEND EMAIL&nbsp<i class="fas fa-check text-success"></i></li>
  <li>RECOVERS&REPORT BUGS&nbsp<i class="fas fa-check text-success"></i></li>
  ',
  `category` varchar(1) NOT NULL,
  `image` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

--
-- Table structure for table `web_name`
--

CREATE TABLE `web_name` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `project_name` varchar(50) NOT NULL,
  `data` varchar(30) NOT NULL,
  `total_visit` int(11) NOT NULL DEFAULT 0,
  `token` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `web_name`
--
ALTER TABLE `web_name`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `web_name`
--
ALTER TABLE `web_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;


-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for table `web_temp`
--

CREATE TABLE `web_temp` (
  `id` int(11) NOT NULL,
  `web_name_id` int(11) NOT NULL,
  `number_days` int(11) NOT NULL,
  `begin_data` varchar(10) NOT NULL,
  `end_data` varchar(10) NOT NULL,
  `free` int(11) NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `web_temp`
--
ALTER TABLE `web_temp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `web_temp`
--
ALTER TABLE `web_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;


--
-- Table structure for table `who_canceled`
--

CREATE TABLE `who_canceled` (
  `id_user` int(11) NOT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `token` varchar(50) DEFAULT NULL,
  `data_time` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `who_canceled`
--
ALTER TABLE `who_canceled`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `who_canceled`
--
ALTER TABLE `who_canceled`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;


--
-- Table structure for table `history_payment`
--

CREATE TABLE `history_payment` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` varchar(30) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` varchar(11) NOT NULL,
  `data` varchar(20) NOT NULL,
  `method` varchar(20) NOT NULL,
  `payment_id` varchar(50) DEFAULT NULL,
  `token_retorned` varchar(50) DEFAULT NULL,
  `payer_id` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history_payment`
--
ALTER TABLE `history_payment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history_payment`
--
ALTER TABLE `history_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `num_order` varchar(20) NOT NULL,
  `price` varchar(11) NOT NULL,
  `dyas` int(11) NOT NULL,
  `discount` float DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `data_order` varchar(20) NOT NULL,
  `data_approved` varchar(20) DEFAULT NULL,
  `data_received` varchar(20) DEFAULT NULL,
  `token` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`,`token`,`num_order`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;