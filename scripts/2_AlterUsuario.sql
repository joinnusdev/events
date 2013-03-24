alter table `events`.`usuario` drop `apellidoMaterno`;
alter table `events`.`usuario` change `apellidoPaterno` `apellido` char(60) character set utf8 collate utf8_general_ci NOT NULL;


alter table `events`.`proveedor` add column `correo` varchar(30) NULL after `fechaRegistro`;

alter table `events`.`proveedor` change `estado` `estado` char(1) NULL ;

alter table `events`.`servicio` change `estado` `estado` char(1) NULL ;