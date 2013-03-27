alter table `usuario` 
   add column `numeroVisita` int(4) UNSIGNED DEFAULT '1' NOT NULL after `ultimaIp`;