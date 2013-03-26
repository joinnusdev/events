alter table `producto` add column `estado` char(1) CHARSET utf8 COLLATE utf8_general_ci DEFAULT '1' NOT NULL after `idUsuarioRegistro`;

alter table `producto` add column `codigo` char(6) CHARSET utf8 COLLATE utf8_general_ci NULL after `idproducto`,change `nombreProducto` `nombreProducto` varchar(100) character set utf8 collate utf8_general_ci NOT NULL;