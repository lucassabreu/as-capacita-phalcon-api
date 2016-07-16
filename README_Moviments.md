# README Moviments

Implementei uma API Rest simples com o CRUD padrão de vocês mais uma rota de faixa de datas.

As rotas são como abaxo:

```plain
GET /v1/users/{iUserId:\d+}/moviments",
GET /v1/users/{iUserId:\d+}/moviments/between/{dtMovStart:\d+}/{dtMovEnd:\d+}",
GET /v1/users/{iUserId:\d+}/moviments/{id:\d+}",
POST /v1/users/{iUserId:\d+}/moviments",
PUT /v1/users/{iUserId:\d+}/moviments/{id:\d+},
DELETE /v1/users/{iUserId:\d+}/moviments/{id:\d+}`
```

Abaixo segue a estrutura da tabala:

```sql
CREATE TABLE `moviments` (
  `iMovimentId` int(11) UNSIGNED NOT NULL,
  `iUserId` int(10) UNSIGNED NOT NULL,
  `dtMoviment` date NOT NULL,
  `sDescription` varchar(200) NOT NULL,
  `sCategory` varchar(50) NOT NULL,
  `nValue` decimal(18,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `moviments`
  ADD PRIMARY KEY (`iMovimentId`),
  ADD KEY `idx_user_category` (`iUserId`,`sCategory`,`dtMoviment`),
  ADD KEY `idx_user_moviments` (`iUserId`,`iMovimentId`),
  ADD KEY `idx_user_dates` (`iUserId`,`dtMoviment`);

ALTER TABLE `moviments`
  MODIFY `iMovimentId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `moviments`
  ADD CONSTRAINT `fk_moviments_users` FOREIGN KEY (`iUserId`) REFERENCES `users` (`iUserId`);
```