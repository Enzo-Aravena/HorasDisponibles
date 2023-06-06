drop database cormup;

create database cormup;
use cormup;

-- TABLAS 

create table centro(
id_centro int primary key,
nom_centro varchar(80)
);


create table personas(
	rut 		varchar(15) primary key,
	nombre 		varchar(50),
	apat 		varchar(50),
	amat 		varchar(50),
	fnac 		date,
    sexo		varchar(60),
    id_centro 	int,
    foreign key (id_centro) references centro(id_centro)
);


create table perfil(
	idPerfil 		int primary key,
	descripcion 	varchar(60)
); 


create table menu(
	idMenu 		int primary key,
	nombreMenu 	varchar(50),
	url 		varchar(200),
    imagen 		varchar(200)
);


create table navmenu
(
	idPerfil 	int,
	idMenu 		int,
	foreign key(idPerfil) references perfil(idPerfil),
	foreign key(idMenu) references menu(idMenu)
);


create table usuarios(
	usuario 	varchar(25) primary key,
	idPerfil 	int ,
	rutUsuario 	varchar(15),
	estado 		char(1),
	fcre 		date,
	foreign key (rutUsuario) references personas(rut),
	foreign key (idPerfil) references perfil(idPerfil)
);	


create table claves(
	id				int primary key,
	idusuario 		varchar(25) ,
	encriptacion 	varchar(100),
	fcreacion 		date,
	fmodifi 		date,
	foreign key (idusuario) references usuarios(usuario)
);


create table rem
(
	id 				int primary key,
	idUsuario 		varchar(100),
	fsubida 		date,
	tipoEnvio 		varchar(15),
	nombreArchivo 	varchar(100),
	comentario 		varchar(100)
);



create table FAR_STOCK_MOVIMIENTOS_DIARIO
(
MAT_ID varchar(100), 
CODIGO varchar(100) ,
MATERIAL varchar(1000) ,
STOCK_INICIAL int(11) ,
STOCK_FINAL int(11) ,
N_VECES_DISPENSADAS int(11) ,
TOTAL_DISPENSADAS int(11) ,
N_DE_INGRESOS int(11) ,
TOTAL_INGRESOS int(11) ,
OBSERVACIONES_INGRESO varchar(1000) ,
MOTIVOS_INGRESOS varchar(1000) ,
N_DE_EGRESOS_OTROS int(11) ,
TOTAL_EGRESOS_OTROS int(11) ,
MOTIVO_EGRESOS_OTROS varchar(1000) ,
TOTAL_EGRESOS int(11) ,
CENTRO varchar(100) ,
FECHA date ,
CEN_ID int(11) ,
NV4_ID int(11) ,
MAXIMO int(11) ,
CRITICO int(11) ,
SOLICITAR int(11) ,
CENTRO_ORDENADO int(11) ,
ESTADO_SOLICITUD varchar(10)
);



create table Z_GDA_CICLOS_TOTAL
(
ID int(11) primary key, 
FechayhoraCancelacion datetime ,
FechayhoraContacto datetime ,
EstablecimientoPaciente varchar(50) ,
SectorPaciente varchar(50) ,
IDCitaGDA varchar(50) ,
Fechacita date ,
HoraCita varchar(50) ,
NumeroFicha int(11) ,
RutPaciente varchar(50) ,
NombrePaciente varchar(100) ,
ApellidoPaterno varchar(100) ,
ApellidoMaterno varchar(100) ,
EDAD int(11) ,
FonoContacto int(11) ,
FonoContacto2rio int(11) ,
FonoContactoCancelacion varchar(45) ,
FonoContacto2riaCancelacion varchar(45) ,
AccionCita varchar(50) ,
Prevision varchar(50) ,
Convenio varchar(50) ,
IDllamada bigint(100) ,
CanceladoPor varchar(45) ,
FechayHoraAgendado datetime ,
SMS_Cancelacion varchar(50) ,
Reagendado varchar(50) ,
HoraCupo varchar(50) ,
SectorCupo_DescripcionLocal varchar(50) ,
ProfesionalNombres varchar(100) ,
AgendadoPor varchar(50) ,
AgendadoDesde int(11) ,
IDCupoSistema int(11) ,
IDPacienteSistemaCliente int(11) ,
DetalleCupo varchar(50) ,
ciclo int(11) ,
cen_id int(11) ,
tipo_carga int(11)
);


SELECT * FROM Z_GDA_CICLOS_TOTAL;

-- TBALA AUXILIAR
CREATE TABLE Z_GDA_ESTADOS_CICLOS
(
ID int(11) primary key, 
FECHACITA date ,
CICLO int(11) ,
CEN_ID int(11) ,
TIPO_CARGA int(11) ,
ESTADO int(11)
);


CREATE TABLE IF NOT EXISTS `agenda_actos_desc` (
  `id` int(11) NOT NULL DEFAULT '0',
  `acto` varchar(1000) NOT NULL,
  `descripcion` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE IF NOT EXISTS `agenda_ocupacion_morbilidad` (
  `id` int(11) NOT NULL,
  `CENTRO_ID` int(11) NOT NULL,
  `CENTRO_ORDENADO` int(11) NOT NULL,
  `CENTRO_AUX` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `CENTRO` varchar(250) NOT NULL,
  `ANHO` int(11) NOT NULL,
  `MES` int(11) NOT NULL,
  `MES_DESC` varchar(100) NOT NULL,
  `FECHAOFERTA` date NOT NULL,
  `DIASEMANA` varchar(100) NOT NULL,
  `OFERTADO_MORBT` int(11) NOT NULL,
  `AGENDADOS_MORBT_TELEFONICA` int(11) NOT NULL,
  `AGENDADOS_MESON_MORBT` int(11) NOT NULL,
  `BLOQUES_NO_AGENDADOS_MORBT` int(11) NOT NULL,
  `AGENDADOS_FINAL_MORBT` int(11) NOT NULL,
  `AGENDADOS_CONFIRMADO_MORBT` int(11) NOT NULL,
  `OFERTADO_MORBI` int(11) NOT NULL,
  `AGENDADOS_MORBI` int(11) NOT NULL,
  `AGENDADOS_MORBI_FORZADOS` int(11) NOT NULL,
  `AGENDADOS_CONFIRMADO_MORBI` int(11) NOT NULL,
  `BLOQUES_NO_AGENDADOS_MORBI` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6289 DEFAULT CHARSET=latin1;


create table subMenu (
idsubMenu int primary key,
nombre varchar(20),
url varchar(100),
imagen varchar(100)
);

create table navSubMenu(
idsubMenu int,
idMenu int,
foreign key(idsubMenu) references subMenu(idsubMenu),
foreign key(idMenu) references menu(idMenu) 
);


CREATE TABLE IF NOT EXISTS `agenda_actos` (
  `CENTRO_ID` int(11) NOT NULL,
  `CENTRO_ORDENADO` int(11) NOT NULL,
  `CENTRO_AUX` varchar(1000) NOT NULL,
  `CENTRO` varchar(1000) NOT NULL,
  `ANHO` int(11) NOT NULL,
  `MES` varchar(1000) NOT NULL,
  `FECHAOFERTA` date NOT NULL,
  `DIASEMANA` varchar(1000) NOT NULL,
  `ACTO` varchar(1000) NOT NULL,
  `DESC_ACTO` varchar(1000) NOT NULL,
  `OFERTADO` int(11) NOT NULL,
  `AGENDADOS` int(11) NOT NULL,
  `AGENDADOS_CONFIRMADO` int(11) NOT NULL,
  `BLOQUES_NO_AGENDADOS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- -------------******************************* INSERTAR DATOS ******************************* ----------------------------------

-- inserts para centro
insert into centro values (1,'Carol Urzua');
insert into centro values (2,'La Faena');
insert into centro values (3,'San Luis');
insert into centro values (4,'Lo Hermida');
insert into centro values (5,'C Silva Henriquez');
insert into centro values (6,'COSAM');
insert into centro values (7,'Direccion de Salud');
insert into centro values (8,'SAPU CAROL URZUA');
insert into centro values (9,'SAPU LA FAENA');
insert into centro values (10,'SAPU LO HERMIDA');
insert into centro values (11,'SAPU SAN LUIS');
insert into centro values (12,'Padre Gerardo Whelan');


 -- INSERTAR DATA PERFIL
INSERT INTO PERFIL VALUES(1	,'ADMINISTRADOR SEGURIDAD CENTRO');
INSERT INTO PERFIL VALUES(2	,'ADMINISTRADOR SEGURIDAD COMUNIDAD');
INSERT INTO PERFIL VALUES(3	,'ADMINISTRATIVO DISPENSACION STOCK');
INSERT INTO PERFIL VALUES(4	,'ADMINISTRATIVO ENTREGA ALIMENTOS');
INSERT INTO PERFIL VALUES(5	,'MEDICO');
INSERT INTO PERFIL VALUES(6	,'NO SANITARIO');
INSERT INTO PERFIL VALUES(7	,'SANITARIO AUXILIAR PARAMÉDICO');
INSERT INTO PERFIL VALUES(8	,'SANITARIO FACULTATIVO');
INSERT INTO PERFIL VALUES(9	,'SANITARIO MASOTERAPEUTA CENTRO');
INSERT INTO PERFIL VALUES(10,'SANITARIO NO FACULTATIVO CENTRO');
INSERT INTO PERFIL VALUES(11,'REGISTRO CLINICO');
INSERT INTO PERFIL VALUES(12,'SANITARIO NO FACULTATIVO GERENCIA');
INSERT INTO PERFIL VALUES(13,'SOME');
INSERT INTO PERFIL VALUES(14,'SUPERVISOR ADMINISTRADOR COMUNIDAD');
INSERT INTO PERFIL VALUES(15,'SUPERVISOR INFORMATICA SALUD');
INSERT INTO PERFIL VALUES(16,'SUPERVISOR NO SANITARIO CENTRO');
INSERT INTO PERFIL VALUES(17,'SUPERVISOR SANITARIO CENTRO');
INSERT INTO PERFIL VALUES(18,'SUPERVISOR SAPU');


-- INSERTS MENU
insert into menu values(1,'Administrador Menu','administradorMenu/vista/administradorMenu.php','../../../lib/images/tools.png');
insert into menu values(2,'Usuarios','registerUsers/vista/searchUser.php','../../../lib/images/addUser.png');
insert into menu values(3,'Subida Rem','rem/vista/sistema.php','../../../lib/images/excel.png');
insert into menu values(4,'Farmacia','farmacia/vista/farmacia.php','../../../lib/images/farmacias.png');
insert into menu values(5,'Ciclos GDA','reporteGDA/vista/reporteCentros.php','../../../lib/images/reporte.png');



insert into subMenu values(1,'Agenda Actos','ocupacionAgenda/vista/ocupacionAgenda.php','../../../lib/images/report.png');
insert into subMenu values(2,'Ocupacion Morbilidad','ocupacionAgenda/vista/ocupacionMorbilidad.php','../../../lib/images/business.png');
insert into subMenu values(3,'GDA Detallle Llamadas','ocupacionAgenda/vista/GDADetalleLlamadas.php','../../../lib/images/graph.png');

-- update menu set url = 'administradorMenu/vista/administradorMenu.php' where idMenu= 1;

-- INSERT NAVMENU

-- PERFIL ADMINISTRADOR
insert into navmenu values(10,1);
insert into navmenu values(10,2);
insert into navmenu values(10,3);
insert into navmenu values(10,4);
insert into navmenu values(10,5);
insert into navmenu values(10,6);


-- CARGA AGENDA ACTOS

INSERT INTO `agenda_actos_desc` (`id`, `acto`, `descripcion`) VALUES
(141, 'MEDCR', 'MEDICO CONTROL ADULTO'),
(142, 'NCNU', 'NUTRICIONISTA CONSULTA ADULTO'),
(143, 'ENCTA', 'ENFERMERA CONTROL ADULTO'),
(144, 'MHTA', 'MEDICO CONTROL HIPERTENSO'),
(145, 'ENCSA', 'ENFERMERA CONSULTA ADULTO'),
(146, 'MASPT', 'SOLO PARA TI MATRONA'),
(147, 'UTMOR', 'FUNDADORES MORBILIDAD'),
(148, 'ENCTS', 'SMS - ENFERMERA CONTROL ADULTO'),
(149, 'MEDCS', 'SMS - MEDICO CONTROL ADULTO'),
(150, 'NCNS', 'SMS - NUTRICIONISTA CONSULTA ADULTO'),
(151, 'MIRA', 'MEDICO CONSULTA IRA'),
(152, 'MERA', 'MEDICO CONSULTA ERA');	

-- -------------******************************* INSERTAR DATOS ******************************* ----------------------------------

-- ************** PROCEDIMIENTOS DE ALMACENADOS **********************

-- BUSCAR USUARIO
DROP PROCEDURE IF EXISTS buscarUsuario;
DELIMITER //
CREATE PROCEDURE buscarUsuario(IN dato varchar(25))
BEGIN
  select c.encriptacion,u.estado from usuarios u,claves c 
  where u.usuario=c.idusuario
  and u.usuario = dato;
END
//
DELIMITER ;

-- call buscarUsuario('mhenriquez');


-- CREACION DE QUIEN CREO EL REM
DROP PROCEDURE IF EXISTS InsertToRem;
DELIMITER //
CREATE PROCEDURE InsertToRem
(
in idusuariox 		varchar(100),
in tipoEnviox 		varchar(40),
in nombreArchivox 	varchar(100),
in comentariox 		varchar(100)
)
BEGIN
	declare idData int;    
    begin		
         select ifnull(max(id),1)+1 into idData from rem;
         insert into rem(id,idusuario,fsubida,tipoEnvio,nombreArchivo ,comentario) values(idData,idUsuariox,sysdate(),tipoEnviox,nombreArchivox,comentariox);
    end;
END
//
DELIMITER ;

-- call InsertToRem('mhenriquez','correccion','REM_01.SANLUIS_D_02.FEBRERO_2018_Final','insercion rem');


-- BUSCA DATOS PERSONALES
DROP PROCEDURE IF EXISTS BuscarDatosPersonales;
DELIMITER //
CREATE PROCEDURE BuscarDatosPersonales(IN dato varchar(25))
BEGIN
	select concat(p.nombre,' ',concat(p.apat,' ',p.amat)),pe.idPerfil, p.sexo, p.id_centro
    from usuarios u, personas p, perfil pe
    where u.rutUsuario = p.rut
    and u.idPerfil = pe.idPerfil
    and u.usuario = dato;
END
//
DELIMITER ;

-- call BuscarDatosPersonales('mhenriquez');

-- BUSCA OIR EL NOMBRE DEL USUARIO
DROP PROCEDURE IF EXISTS buscarPorNombre;
delimiter //
create procedure buscarPorNombre(IN dato varchar(30))
begin
select p.rut,p.nombre,concat(p.apat," ",p.amat),DATE_FORMAT(p.fnac,'%d/%m/%Y'),p.sexo,
perf.descripcion,cen.nom_centro,u.usuario,cla.encriptacion,u.estado
 from personas p,usuarios u,claves cla, perfil perf, centro cen
 where u.rutUsuario= p.rut and u.usuario= cla.idusuario and perf.idPerfil= u.idPerfil
and cen.id_centro= p.id_centro  and p.nombre like CONCAT('%',dato,'%');
END
//
DELIMITER ;

-- call buscarPorNombre('Margaret');


-- BUSCAR POR RUT
drop procedure if exists BuscarPorRut;
DELIMITER //
create procedure buscarPorRut(IN dato varchar(30))
begin
	select p.rut,p.nombre,concat(p.apat," ",p.amat),DATE_FORMAT(p.fnac,'%d/%m/%Y'),p.sexo,
	perf.descripcion,cen.nom_centro,u.usuario,cla.encriptacion,u.estado
	from personas p,usuarios u,claves cla, perfil perf, centro cen
	where u.rutUsuario= p.rut and u.usuario= cla.idusuario and perf.idPerfil= u.idPerfil
	and cen.id_centro= p.id_centro  and p.rut like CONCAT('%',dato,'%');
END
//
DELIMITER ;

-- call buscarPorRut('189924658');

-- BUSCA POR EL USUARIO
DROP PROCEDURE IF EXISTS buscarPorUsuario;
DELIMITER //
create procedure buscarPorUsuario(IN dato varchar(30))
begin
	select p.rut,p.nombre,concat(p.apat," ",p.amat),DATE_FORMAT(p.fnac,'%d/%m/%Y'),p.sexo,
	perf.descripcion,cen.nom_centro,u.usuario,cla.encriptacion,u.estado
	from personas p,usuarios u,claves cla, perfil perf, centro cen
	where u.rutUsuario= p.rut and u.usuario= cla.idusuario and perf.idPerfil= u.idPerfil
	and cen.id_centro= p.id_centro and u.usuario like CONCAT('%',dato,'%');
END
//
DELIMITER ;

-- call buscarPorUsuario('mhenriquez');

-- BUSCA POR EL USUARIO
DROP PROCEDURE IF EXISTS buscarTodo;
DELIMITER //
create procedure buscarTodo()
begin
	select p.rut,p.nombre,concat(p.apat," ",p.amat),DATE_FORMAT(p.fnac,'%d/%m/%Y'),p.sexo,
	perf.descripcion,cen.nom_centro,u.usuario,cla.encriptacion,u.estado,cla.id
	from personas p,usuarios u,claves cla, perfil perf, centro cen
	where u.rutUsuario= p.rut and u.usuario= cla.idusuario and perf.idPerfil= u.idPerfil and cla.idusuario= u.usuario
	and cen.id_centro= p.id_centro;
END
//
DELIMITER ;

-- call buscarTodo();


-- CREAR USUARIOS EL SISTEMA
DROP PROCEDURE IF EXISTS crearUsuarios;
DELIMITER //
create procedure crearUsuarios
(
in rutx		varchar(15),
in nombrex 	varchar(30),
in apatx 	varchar(35),
in amatx 	varchar(35),
in fnacx 	date,
in sexox 	varchar(3),
in centrox 	int,
in usuariox varchar(40),
in clavex 	varchar(60),
in estadox 	varchar(2),
in tipoperfilx int
)
begin
	declare newId int;
	declare	newId2 int;
	declare	newId3 int;
	if exists (select rut from personas where rut =rutx) then
	begin
		select '0';
	end ;
	else
		begin
			insert into personas (rut,nombre,apat,amat,fnac,sexo,id_centro) 
			values(rutx,nombrex,apatx,amatx,fnacx,sexox,centrox);

			insert into usuarios(usuario,idPerfil,rutUsuario,estado,fcre) 
			values(usuariox,tipoperfilx,rutx,estadox,sysdate());
			
			begin
			select IFNULL(max(id),1)+1 into newId2 from claves;
			
			insert into claves (id,idusuario,encriptacion,fcreacion,fmodifi) 
			values(newId2,usuariox,clavex,sysdate(),sysdate());
            select '1';
		end;
	END;
	end if;

end;
//
DELIMITER ;
-- CALL crearUsuarios('18992465-8', 'Margaret', 'Henriquez', 'Henriquez', '1994-02-18','F', 1, 'mhenriquez', 'admin123', 'A', 1);



DROP PROCEDURE IF EXISTS traerClaveUsuarios;
DELIMITER //
create procedure traerClaveUsuarios(IN dato varchar(30))
begin
select u.usuario, c.encriptacion from personas p, usuarios u, claves c where   
p.rut = u.rutUsuario and u.usuario =  c.idusuario
 and p.rut = dato;
END
//
DELIMITER ;

-- call traerClaveUsuarios('18992465-8');

DROP PROCEDURE IF EXISTS cambiarClave;
DELIMITER //
create procedure cambiarClave(in usuario varchar(30) , IN dato varchar(30))
begin
if exists (select encriptacion from claves where idusuario = usuario) then
begin
	update claves set encriptacion = dato where idusuario= usuario;
	select '1';
end ;
else
	begin			
		select '0';
	end;
end if;
END
//
DELIMITER ;

-- call cambiarClave('aqwerty','admin12');



DROP PROCEDURE IF EXISTS cambiarClave;
DELIMITER //
create procedure cambiarClave(in usuario varchar(30) , IN dato varchar(30))
begin
	update claves set encriptacion = dato where idusuario= usuario;
END
//
DELIMITER ;



call cambiarClave('aqwerty','admin12');



DROP PROCEDURE IF EXISTS modificarEstado;
DELIMITER //
create procedure modificarEstado
(
in rutx varchar(20),
in estadox 	varchar(2)
)
begin
	if exists (select usuario from usuarios where rutUsuario =rutx) then
	begin
		update usuarios set estado = estadox where rutUsuario= rutx;
		select '1';
	end ;
	else
		begin			
            select '0';
		end;
	end if;
end;
//
DELIMITER ;


-- CALL modificarEstado('18992466-6','A');


DROP PROCEDURE IF EXISTS SeleccionarEstado;
DELIMITER //
create procedure SeleccionarEstado
(
in rutx varchar(20)
)
begin
	select estado from usuarios where rutUsuario= rutx;	
end;
//
DELIMITER ;

-- call SeleccionarEstado('18992466-6');


-- PROCEDIMIENTO ALMACENADO QUE TIENE COMO FUNCION TRAER LA DATA DEL USUARIO
DROP PROCEDURE IF EXISTS searchToData;
DELIMITER //
create procedure searchToData(IN dato varchar(30))
begin
select p.rut,p.apat,p.amat,p.nombre,DATE_FORMAT(p.fnac,'%d/%m/%Y'),p.sexo,
p.id_centro,cla.encriptacion, u.usuario ,u.estado ,perf.idPerfil,cla.id
 from personas p,usuarios u,claves cla, perfil perf
 where u.rutUsuario= p.rut and u.usuario= cla.idusuario and perf.idPerfil= u.idPerfil and cla.idusuario= u.usuario
 and p.rut=dato;
END
//
DELIMITER ;

call searchToData('18992465-8');


-- CARGA EL MENU DEL LOS USUARIOS 
DROP PROCEDURE IF EXISTS redirectToMenu
DELIMITER //
create procedure redirectToMenu(in dato varchar(30))
begin

	select m.nombreMenu,m.url,m.imagen 
	from 
	usuarios u, perfil p,navmenu nm,menu m
	where u.idPerfil= p.idPerfil 
	and nm.idPerfil= p.idPerfil
	and nm.idmenu = m.idmenu
	and u.usuario = dato;

END
//
DELIMITER ;


-- MODIFICAR USUARIOS
DROP PROCEDURE IF EXISTS updateUsuarios;
DELIMITER //
create procedure updateUsuarios
(
in rutx		varchar(15),
in nombrex 	varchar(30),
in apatx 	varchar(35),
in amatx 	varchar(35),
in fnacx 	date,
in sexox 	varchar(3),
in centrox 	int,
--
in estadox 	varchar(2),
in tipoperfilx int
)
begin   
	update personas set nombre= nombrex, apat= apatx,amat = amatx, fnac=  fnacx, sexo= sexox, id_centro= centrox where rut= rutx;
	update usuarios set idPerfil= tipoperfilx, estado = estadox where rutUsuario = rutx;
    select '1';
END;
//
DELIMITER ;

-- call updateUsuarios('18992465-8','Margaret','Henriquez','Henriquez', '1994-02-18','F',6,1,'A');



-- MODIFICA  A LOS USUARIOS
-- update claves set encriptacion='Admin1234' , fmodifi= sysdate() where idusuario='mhenriquez';
DROP PROCEDURE IF EXISTS searchAllMenu;
DELIMITER //
CREATE PROCEDURE searchAllMenu()
BEGIN
	select idMenu,nombreMenu ,url,imagen from menu  order by nombreMenu asc;
END
//
DELIMITER ;

-- call searchAllMenu();



DROP PROCEDURE IF EXISTS searchByNombreMenu;
DELIMITER //
CREATE PROCEDURE searchByNombreMenu(in nombrex varchar(60))
BEGIN
	 select nombreMenu,url,imagen from menu where nombreMenu like CONCAT('%',nombrex,'%') order by nombreMenu;
   -- select nombreMenu,url,imagen from menu where nombreMenu = nombrex order by nombreMenu;
END
//
DELIMITER ;

--  call searchByNombreMenu('usuario');

DROP PROCEDURE IF EXISTS traerDataModificar;
DELIMITER //
CREATE PROCEDURE traerDataModificar(in idx varchar(60))
BEGIN
	 select idMenu,nombreMenu,url,imagen from menu where idMenu = idx;
END
//
DELIMITER ;

--  call traerDataModificar(6);

-- CREA EL MENU PARA LOS DISTINTOS USUARIOS
DROP PROCEDURE IF EXISTS CreateToNewMenu;
DELIMITER //
CREATE PROCEDURE CreateToNewMenu(in nombrex varchar(40), in urlx varchar(100),in imagenx varchar(50))
BEGIN
	DECLARE 
		newId int;	
	select IFNULL(max(idMenu),1) +1  into newId from menu;  
	if exists(select nombreMenu from MENU where nombreMenu = nombrex) then
	begin
		select '0';
	end ;
	else
    begin
	insert into menu(idMenu,nombreMenu,url,imagen) values(newId,nombrex,urlx,imagenx);
    select '1';
    end;    
    end if;
END;
//
DELIMITER ;

-- call CreateToNewMenu('test','xcvxcv','sdasdas');
DROP PROCEDURE IF EXISTS insertarNavMenu;
DELIMITER //
CREATE  PROCEDURE insertarNavMenu(
in perfil int,
in menu int
)
BEGIN
	if exists(select * from navmenu where idPerfil = perfil and idMenu = menu) then
	begin
		select '0';
	end ;
	else
    begin
        insert into navmenu(idMenu,idPerfil) values(menu,perfil);
    select '1';
    end;    
    end if;
    END;
//
DELIMITER ;


DROP PROCEDURE IF EXISTS eliminarNavMenu;
DELIMITER //
CREATE  PROCEDURE eliminarNavMenu(
in menu int
)
BEGIN
	if exists(select * from navmenu where idMenu = menu) then
	begin
		  delete from navmenu where idMenu = menu;
			select '1';
	end ;
	else
    begin
		select '0';
    end;    
    end if;
    END;
//
DELIMITER ;



DROP PROCEDURE IF EXISTS ModifyMenu;
DELIMITER //
CREATE PROCEDURE ModifyMenu(
in nombrex varchar(40),
in urlx varchar(100),
in imagenx varchar(50),
in idx int
)
BEGIN
    if exists (select nombreMenu from menu where nombreMenu = nombrex) then
   begin
		select '0';
	end ;
	else
	begin		
    update menu set nombreMenu= nombrex,url = urlx, imagen= imagenx  where idMenu = idx;
    select '1';
	END;
	end if;
END;
//
DELIMITER ;

call ModifyMenu('aaa','asdasda','sadads',6);

select * from menu;

DROP PROCEDURE IF EXISTS searchNameMenu;
DELIMITER //
CREATE PROCEDURE searchNameMenu()
BEGIN
	 select  idMenu, nombreMenu from menu order by nombreMenu asc;
END;
//
DELIMITER ;

DROP PROCEDURE IF EXISTS searchNamePerfiles;
DELIMITER //
CREATE  PROCEDURE searchNamePerfiles()
BEGIN
	select idPerfil,descripcion from perfil order by descripcion asc;
END;
//
DELIMITER ;


DROP PROCEDURE IF EXISTS CargarCentros;
DELIMITER //
CREATE  PROCEDURE CargarCentros()
BEGIN
	select id_centro,nom_centro from centro order by nom_centro asc;
END;
//
DELIMITER ;

-- call CargarCentros();



DROP PROCEDURE IF EXISTS eliminareliminarMenu;
DELIMITER //
CREATE PROCEDURE eliminarMenu(
in idx int
)
BEGIN
    delete from navmenu where idMenu = idx;
    delete from menu where idMenu =  idx;
END;
//
DELIMITER ;

-- call eliminarMenu(5);
-- ************** PROCEDIMIENTOS DE ALMACENADOS **********************


/************************* GDA  *******************************/


drop procedure if exists buscarCentroUsuario;
DELIMITER //
create procedure buscarCentroUsuario(in centro int)
begin	
select nom_centro from centro where id_centro= centro;
end;

-- call buscarCentroUsuario(1);




DELIMITER //
CREATE PROCEDURE Obtener_cantidad(IN CENTRO INT, IN FECHAINICIAL DATE,IN FECHAFINAL DATE)
BEGIN

SELECT 
/*TABLA.CENTRO AS 'CENTRO',*/
TABLA.CICLO AS 'CICLO',
TABLA.FECHA_INICIAL,
TABLA.FECHA_FINAL,

(SELECT COUNT(ZC.CICLO)
 FROM 	Z_GDA_CICLOS_TOTAL ZC
 WHERE ZC.FECHACITA BETWEEN TABLA.FECHA_INICIAL AND TABLA.FECHA_FINAL
 AND ZC.CEN_ID = TABLA.CENTRO 
 AND ZC.CICLO = TABLA.CICLO
 AND ZC.TIPO_CARGA = 1) AS 'Agendados',
 
 (SELECT COUNT(ZC.CICLO)
 FROM 	Z_GDA_CICLOS_TOTAL ZC
 WHERE ZC.FECHACITA BETWEEN TABLA.FECHA_INICIAL AND TABLA.FECHA_FINAL
 AND ZC.CICLO = TABLA.CICLO
 AND ZC.TIPO_CARGA = 2) AS 'Cancelados',
 
 IFNULL((SELECT  DISTINCT CASE WHEN ZE.ESTADO = 1 THEN 'CARGA CORRECTA' WHEN ZE.ESTADO = 2 THEN 'ERROR CARGA' END 
		 FROM Z_GDA_ESTADOS_CICLOS ZE 
		 WHERE ZE.FECHACITA BETWEEN TABLA.FECHA_INICIAL AND TABLA.FECHA_FINAL
		 AND   ZE.CEN_ID = TABLA.CENTRO 
		 AND   ZE.CICLO = TABLA.CICLO
		 AND   ZE.TIPO_CARGA = 1), 'PENDIENTE') AS 'Estado_Agendados',
             
 IFNULL((SELECT  DISTINCT CASE WHEN ZE.ESTADO = 1 THEN 'CARGA CORRECTA' WHEN ZE.ESTADO = 2 THEN 'ERROR CARGA' END 
		 FROM Z_GDA_ESTADOS_CICLOS ZE 
		 WHERE ZE.FECHACITA BETWEEN TABLA.FECHA_INICIAL AND TABLA.FECHA_FINAL
		 AND   ZE.CICLO = TABLA.CICLO
		 AND   ZE.TIPO_CARGA = 2), 'PENDIENTE') AS 'Estado_Cancelados'
 
 FROM 
(SELECT * FROM
			 ((SELECT 1  AS 'CENTRO') 
	UNION ALL (SELECT 2  AS 'CENTRO')
    UNION ALL (SELECT 3  AS 'CENTRO')
    UNION ALL (SELECT 4  AS 'CENTRO')
    UNION ALL (SELECT 5  AS 'CENTRO')
    UNION ALL (SELECT 12 AS 'CENTRO')
			 )  AS CENTRO,
			 ((SELECT 1  AS 'CICLO') 
	UNION ALL (SELECT 2  AS 'CICLO')
    UNION ALL (SELECT 3  AS 'CICLO')
    UNION ALL (SELECT 4  AS 'CICLO')
    UNION ALL (SELECT 5  AS 'CICLO')
			 )  AS CICLO,
	(SELECT FECHAINICIAL AS 'FECHA_INICIAL' 
             ) AS FECHA_INICIAL,
    (SELECT FECHAFINAL   AS 'FECHA_FINAL'
			 ) AS FECHA_FINAL
	WHERE CENTRO.CENTRO = CENTRO ) TABLA;

END
//
DELIMITER ;

-- - MOSTRAR CICLOS DIARIOS
drop procedure if exists SP_Resumen_Ciclos;
DELIMITER //
CREATE  PROCEDURE `SP_Resumen_Ciclos`(IN CENTRO INT, IN FECHAINICIAL DATE)
CASE WHEN CENTRO =  0 THEN

BEGIN

(SELECT 
/*TABLA.CENTRO AS 'CENTRO',*/
TABLA.CENTRO AS 'CENTRO',

(SELECT COUNT(ZC.CICLO)
 FROM 	Z_GDA_CICLOS_TOTAL ZC
 WHERE ZC.FECHACITA = TABLA.FECHA_INICIAL 
 AND ZC.CEN_ID = TABLA.CENTRO 
 AND ZC.CICLO = 1
 AND ZC.TIPO_CARGA = 1) AS 'Ciclo1_Agendados',
 
  IFNULL((SELECT  DISTINCT CASE WHEN ZE.ESTADO = 1 THEN 'CARGA CORRECTA' WHEN ZE.ESTADO = 2 THEN 'ERROR CARGA' END 
		 FROM Z_GDA_ESTADOS_CICLOS ZE 
		 WHERE ZE.FECHACITA = TABLA.FECHA_INICIAL
		 AND   ZE.CEN_ID = TABLA.CENTRO 
		 AND   ZE.CICLO = 1
		 AND   ZE.TIPO_CARGA = 1), 'PENDIENTE') AS 'Estado_Ciclo1_Agendados',
             

 (SELECT COUNT(ZC.CICLO)
 FROM 	Z_GDA_CICLOS_TOTAL ZC
 WHERE ZC.FECHACITA = TABLA.FECHA_INICIAL 
 AND (CASE ZC.ESTABLECIMIENTOPACIENTE 
		  WHEN 'CESFAM Carol Urzúa' THEN 1
          WHEN 'CESFAM La Faena' THEN 2 
          WHEN 'CESFAM San Luis' THEN 3
          WHEN 'CESFAM Lo Hermida' THEN 4 
          WHEN 'CESFAM Silva Henríquez' THEN 5
          WHEN 'CESFAM Padre Whelan' THEN 12
          END ) = TABLA.CENTRO           
 AND ZC.CICLO = 1
 AND ZC.TIPO_CARGA = 2) AS 'Ciclo1_Cancelados',
 
 
  IFNULL((SELECT  DISTINCT CASE WHEN ZE.ESTADO = 1 THEN 'CARGA CORRECTA' WHEN ZE.ESTADO = 2 THEN 'ERROR CARGA' END 
		 FROM Z_GDA_ESTADOS_CICLOS ZE 
		 WHERE ZE.FECHACITA = TABLA.FECHA_INICIAL
		 AND   ZE.CICLO = 1
		 AND   ZE.TIPO_CARGA = 2), 'PENDIENTE') AS 'Estado_Ciclo1_Cancelados',
 
 
 
 (SELECT COUNT(ZC.CICLO)
 FROM 	Z_GDA_CICLOS_TOTAL ZC
 WHERE ZC.FECHACITA = TABLA.FECHA_INICIAL 
 AND ZC.CEN_ID = TABLA.CENTRO 
 AND ZC.CICLO = 2
 AND ZC.TIPO_CARGA = 1) AS 'Ciclo2_Agendados',
 
   IFNULL((SELECT  DISTINCT CASE WHEN ZE.ESTADO = 1 THEN 'CARGA CORRECTA' WHEN ZE.ESTADO = 2 THEN 'ERROR CARGA' END 
		 FROM Z_GDA_ESTADOS_CICLOS ZE 
		 WHERE ZE.FECHACITA = TABLA.FECHA_INICIAL
		 AND   ZE.CEN_ID = TABLA.CENTRO 
		 AND   ZE.CICLO = 2
		 AND   ZE.TIPO_CARGA = 1), 'PENDIENTE') AS 'Estado_Ciclo2_Agendados',
         
         
 
 (SELECT COUNT(ZC.CICLO)
 FROM 	Z_GDA_CICLOS_TOTAL ZC
 WHERE ZC.FECHACITA = TABLA.FECHA_INICIAL 
 AND (CASE ZC.ESTABLECIMIENTOPACIENTE 
		  WHEN 'CESFAM Carol Urzúa' THEN 1
          WHEN 'CESFAM La Faena' THEN 2 
          WHEN 'CESFAM San Luis' THEN 3
          WHEN 'CESFAM Lo Hermida' THEN 4 
          WHEN 'CESFAM Silva Henríquez' THEN 5
          WHEN 'CESFAM Padre Whelan' THEN 12
          END ) = TABLA.CENTRO           
 AND ZC.CICLO = 2
 AND ZC.TIPO_CARGA = 2) AS 'Ciclo2_Cancelados',
 
  IFNULL((SELECT  DISTINCT CASE WHEN ZE.ESTADO = 1 THEN 'CARGA CORRECTA' WHEN ZE.ESTADO = 2 THEN 'ERROR CARGA' END 
		 FROM Z_GDA_ESTADOS_CICLOS ZE 
		 WHERE ZE.FECHACITA = TABLA.FECHA_INICIAL
		 AND   ZE.CICLO = 2
		 AND   ZE.TIPO_CARGA = 2), 'PENDIENTE') AS 'Estado_Ciclo2_Cancelados',
         
 
 (SELECT COUNT(ZC.CICLO)
 FROM 	Z_GDA_CICLOS_TOTAL ZC
 WHERE ZC.FECHACITA = TABLA.FECHA_INICIAL
 AND ZC.CEN_ID = TABLA.CENTRO 
 AND ZC.CICLO = 3
 AND ZC.TIPO_CARGA = 1) AS 'Ciclo3_Agendados',
 
   IFNULL((SELECT  DISTINCT CASE WHEN ZE.ESTADO = 1 THEN 'CARGA CORRECTA' WHEN ZE.ESTADO = 2 THEN 'ERROR CARGA' END 
		 FROM Z_GDA_ESTADOS_CICLOS ZE 
		 WHERE ZE.FECHACITA = TABLA.FECHA_INICIAL
		 AND   ZE.CEN_ID = TABLA.CENTRO 
		 AND   ZE.CICLO = 3
		 AND   ZE.TIPO_CARGA = 1), 'PENDIENTE') AS 'Estado_Ciclo3_Agendados',
         
 
 (SELECT COUNT(ZC.CICLO)
 FROM 	Z_GDA_CICLOS_TOTAL ZC
 WHERE ZC.FECHACITA = TABLA.FECHA_INICIAL
 AND (CASE ZC.ESTABLECIMIENTOPACIENTE 
		  WHEN 'CESFAM Carol Urzúa' THEN 1
          WHEN 'CESFAM La Faena' THEN 2 
          WHEN 'CESFAM San Luis' THEN 3
          WHEN 'CESFAM Lo Hermida' THEN 4 
          WHEN 'CESFAM Silva Henríquez' THEN 5
          WHEN 'CESFAM Padre Whelan' THEN 12
          END ) = TABLA.CENTRO           
 AND ZC.CICLO = 3
 AND ZC.TIPO_CARGA = 2) AS 'Ciclo3_Cancelados',
 
  IFNULL((SELECT  DISTINCT CASE WHEN ZE.ESTADO = 1 THEN 'CARGA CORRECTA' WHEN ZE.ESTADO = 2 THEN 'ERROR CARGA' END 
		 FROM Z_GDA_ESTADOS_CICLOS ZE 
		 WHERE ZE.FECHACITA = TABLA.FECHA_INICIAL
		 AND   ZE.CICLO =3
		 AND   ZE.TIPO_CARGA = 2), 'PENDIENTE') AS 'Estado_Ciclo3_Cancelados',
 
 (SELECT COUNT(ZC.CICLO)
 FROM 	Z_GDA_CICLOS_TOTAL ZC
 WHERE ZC.FECHACITA = TABLA.FECHA_INICIAL
 AND ZC.CEN_ID = TABLA.CENTRO 
 AND ZC.CICLO = 4
 AND ZC.TIPO_CARGA = 1) AS 'Ciclo4_Agendados',
 
   IFNULL((SELECT  DISTINCT CASE WHEN ZE.ESTADO = 1 THEN 'CARGA CORRECTA' WHEN ZE.ESTADO = 2 THEN 'ERROR CARGA' END 
		 FROM Z_GDA_ESTADOS_CICLOS ZE 
		 WHERE ZE.FECHACITA = TABLA.FECHA_INICIAL
		 AND   ZE.CEN_ID = TABLA.CENTRO 
		 AND   ZE.CICLO = 4
		 AND   ZE.TIPO_CARGA = 1), 'PENDIENTE') AS 'Estado_Ciclo4_Agendados',
 
 (SELECT COUNT(ZC.CICLO)
 FROM 	Z_GDA_CICLOS_TOTAL ZC
 WHERE ZC.FECHACITA = TABLA.FECHA_INICIAL
 AND (CASE ZC.ESTABLECIMIENTOPACIENTE 
		  WHEN 'CESFAM Carol Urzúa' THEN 1
          WHEN 'CESFAM La Faena' THEN 2 
          WHEN 'CESFAM San Luis' THEN 3
          WHEN 'CESFAM Lo Hermida' THEN 4 
          WHEN 'CESFAM Silva Henríquez' THEN 5
          WHEN 'CESFAM Padre Whelan' THEN 12
          END ) = TABLA.CENTRO           
 AND ZC.CICLO = 4
 AND ZC.TIPO_CARGA = 2) AS 'Ciclo4_Cancelados',
 
  IFNULL((SELECT  DISTINCT CASE WHEN ZE.ESTADO = 1 THEN 'CARGA CORRECTA' WHEN ZE.ESTADO = 2 THEN 'ERROR CARGA' END 
		 FROM Z_GDA_ESTADOS_CICLOS ZE 
		 WHERE ZE.FECHACITA = TABLA.FECHA_INICIAL
		 AND   ZE.CICLO = 4
		 AND   ZE.TIPO_CARGA = 2), 'PENDIENTE') AS 'Estado_Ciclo4_Cancelados',
 
 (SELECT COUNT(ZC.CICLO)
 FROM 	Z_GDA_CICLOS_TOTAL ZC
 WHERE ZC.FECHACITA = TABLA.FECHA_INICIAL
 AND ZC.CEN_ID = TABLA.CENTRO 
 AND ZC.CICLO = 5
 AND ZC.TIPO_CARGA = 1) AS 'Ciclo5_Agendados',
 
   IFNULL((SELECT  DISTINCT CASE WHEN ZE.ESTADO = 1 THEN 'CARGA CORRECTA' WHEN ZE.ESTADO = 2 THEN 'ERROR CARGA' END 
		 FROM Z_GDA_ESTADOS_CICLOS ZE 
		 WHERE ZE.FECHACITA = TABLA.FECHA_INICIAL
		 AND   ZE.CEN_ID = TABLA.CENTRO 
		 AND   ZE.CICLO = 5
		 AND   ZE.TIPO_CARGA = 1), 'PENDIENTE') AS 'Estado_Ciclo5_Agendados',
 
 (SELECT COUNT(ZC.CICLO)
 FROM 	Z_GDA_CICLOS_TOTAL ZC
 WHERE ZC.FECHACITA = TABLA.FECHA_INICIAL
 AND (CASE ZC.ESTABLECIMIENTOPACIENTE 
		  WHEN 'CESFAM Carol Urzúa' THEN 1
          WHEN 'CESFAM La Faena' THEN 2 
          WHEN 'CESFAM San Luis' THEN 3
          WHEN 'CESFAM Lo Hermida' THEN 4 
          WHEN 'CESFAM Silva Henríquez' THEN 5
          WHEN 'CESFAM Padre Whelan' THEN 12
          END ) = TABLA.CENTRO           
 AND ZC.CICLO = 5
 AND ZC.TIPO_CARGA = 2) AS 'Ciclo5_Cancelados',
 
  IFNULL((SELECT  DISTINCT CASE WHEN ZE.ESTADO = 1 THEN 'CARGA CORRECTA' WHEN ZE.ESTADO = 2 THEN 'ERROR CARGA' END 
		 FROM Z_GDA_ESTADOS_CICLOS ZE 
		 WHERE ZE.FECHACITA = TABLA.FECHA_INICIAL
		 AND   ZE.CICLO = 5
		 AND   ZE.TIPO_CARGA = 2), 'PENDIENTE') AS 'Estado_Ciclo5_Cancelados'
 FROM 
(SELECT * FROM
			 ((SELECT 1  AS 'CENTRO') 
	UNION ALL (SELECT 2  AS 'CENTRO')
    UNION ALL (SELECT 3  AS 'CENTRO')
    UNION ALL (SELECT 4  AS 'CENTRO')
    UNION ALL (SELECT 5  AS 'CENTRO')
    UNION ALL (SELECT 12 AS 'CENTRO')
			 )  AS CENTRO,
	(SELECT FECHAINICIAL AS 'FECHA_INICIAL' 
             ) AS FECHA_INICIAL) TABLA); 
    
END;

ELSE

BEGIN

( SELECT 
/*TABLA.CENTRO AS 'CENTRO',*/
TABLA.CICLO AS 'CICLO',
 DATE_FORMAT(TABLA.FECHA_INICIAL,'%d/%m/%Y'),

(SELECT COUNT(ZC.CICLO)
 FROM 	Z_GDA_CICLOS_TOTAL ZC
 WHERE ZC.FECHACITA = TABLA.FECHA_INICIAL 
 AND ZC.CEN_ID = TABLA.CENTRO 
 AND ZC.CICLO = TABLA.CICLO
 AND ZC.TIPO_CARGA = 1) AS 'Agendados',
 
 (SELECT COUNT(ZC.CICLO)
 FROM 	Z_GDA_CICLOS_TOTAL ZC
 WHERE ZC.FECHACITA = TABLA.FECHA_INICIAL
 AND (CASE ZC.ESTABLECIMIENTOPACIENTE 
		  WHEN 'CESFAM Carol Urzúa' THEN 1
          WHEN 'CESFAM La Faena' THEN 2 
          WHEN 'CESFAM San Luis' THEN 3
          WHEN 'CESFAM Lo Hermida' THEN 4 
          WHEN 'CESFAM Silva Henríquez' THEN 5
          WHEN 'CESFAM Padre Whelan' THEN 12
          END ) = TABLA.CENTRO           
 AND ZC.CICLO = TABLA.CICLO
 AND ZC.TIPO_CARGA = 2) AS 'Cancelados',
 
 IFNULL((SELECT  DISTINCT CASE WHEN ZE.ESTADO = 1 THEN 'CARGA CORRECTA' WHEN ZE.ESTADO = 2 THEN 'ERROR CARGA' END 
		 FROM Z_GDA_ESTADOS_CICLOS ZE 
		 WHERE ZE.FECHACITA = TABLA.FECHA_INICIAL
		 AND   ZE.CEN_ID = TABLA.CENTRO 
		 AND   ZE.CICLO = TABLA.CICLO
		 AND   ZE.TIPO_CARGA = 1), 'PENDIENTE') AS 'Estado_Agendados',
             
 IFNULL((SELECT  DISTINCT CASE WHEN ZE.ESTADO = 1 THEN 'CARGA CORRECTA' WHEN ZE.ESTADO = 2 THEN 'ERROR CARGA' END 
		 FROM Z_GDA_ESTADOS_CICLOS ZE 
		 WHERE ZE.FECHACITA = TABLA.FECHA_INICIAL
		 AND   ZE.CICLO = TABLA.CICLO
		 AND   ZE.TIPO_CARGA = 2), 'PENDIENTE') AS 'Estado_Cancelados'
 
 FROM 
(SELECT * FROM
			 ((SELECT 1  AS 'CENTRO') 
	UNION ALL (SELECT 2  AS 'CENTRO')
    UNION ALL (SELECT 3  AS 'CENTRO')
    UNION ALL (SELECT 4  AS 'CENTRO')
    UNION ALL (SELECT 5  AS 'CENTRO')
    UNION ALL (SELECT 12 AS 'CENTRO')
			 )  AS CENTRO,
			 ((SELECT 1  AS 'CICLO') 
	UNION ALL (SELECT 2  AS 'CICLO')
    UNION ALL (SELECT 3  AS 'CICLO')
    UNION ALL (SELECT 4  AS 'CICLO')
    UNION ALL (SELECT 5  AS 'CICLO')
			 )  AS CICLO,
	(SELECT FECHAINICIAL AS 'FECHA_INICIAL' 
             ) AS FECHA_INICIAL
	WHERE CENTRO.CENTRO = CENTRO ) TABLA);
END;
END CASE;
//
DELIMITER ;


-- call SP_Resumen_Ciclos(1, '2018-03-06');
-- call SP_Resumen_Ciclos(0, '2018-03-21');

-- --------------

--- excel
drop procedure if exists exportarAGDA;
DELIMITER //
create procedure exportarAGDA(in centro int,in ciclo int,in fecha date)
begin	
select FechayhoraContacto,EstablecimientoPaciente,SectorPaciente,IDCitaGDA,DATE_FORMAT(Fechacita,'%d/%m/%Y') AS Fechacita,HoraCita,
NumeroFicha,RutPaciente,NombrePaciente, ApellidoPaterno,ApellidoMaterno,EDAD,FonoContacto,FonoContacto2rio,
AccionCita,Prevision,Convenio,IDllamada,Reagendado,HoraCupo,SectorCupo_DescripcionLocal,ProfesionalNombres,
AgendadoPor,AgendadoDesde,IDCupoSistema,IDPacienteSistemaCliente,DetalleCupo
from Z_GDA_CICLOS_TOTAL
where cen_id=centro and ciclo = ciclo and Fechacita= fecha order by SectorPaciente DESC;
end;
//
DELIMITER ;
 
call exportarAGDA(1,1,'2018-02-23');




-- ****************** PROCEDIMIENTO DE ALMACENADO FARMACIA *****************

-- Carga el select desde la base de datos al sistema
DROP PROCEDURE IF exists uploadSelectData;
DELIMITER //
create procedure uploadSelectData()
begin
select material from FAR_STOCK_MOVIMIENTOS_DIARIO  group by 1 ORDER BY material asc;
end;
//
DELIMITER ;

-- call  uploadSelectData();

-- busca toda la data de la farmacia
DROP PROCEDURE IF EXISTS searchAllFarmacia;
DELIMITER //
create procedure searchAllFarmacia()
begin
select 
DATE_FORMAT(FECHA,'%d/%m/%Y')   AS 'FECHA',
        CENTRO                          AS 'CENTRO',
        CODIGO                          AS 'CODIGO',
        MATERIAL                        AS 'MEDICAMENTO',
        IFNULL(STOCK_INICIAL,'-')       AS 'STOCK INICIAL',
        IFNULL(TOTAL_INGRESOS,'-')      AS 'INGRESOS',
        IFNULL(TOTAL_DISPENSADAS,'-')   AS 'DISPENSADAS',
        IFNULL(TOTAL_EGRESOS,'-')       AS 'EGRESOS',
        IFNULL(STOCK_FINAL,'-')         AS 'STOCK FINAL',
        IFNULL(MAXIMO,'-')              AS 'MAXIMO',
        IFNULL(CRITICO,'-')             AS 'N CRITICO',
        ESTADO_SOLICITUD                AS 'CRITICO',
        SOLICITAR                       AS 'SOLICITAR'
from FAR_STOCK_MOVIMIENTOS_DIARIO ORDER BY material asc;
END
//
DELIMITER ;

-- call searchAllFarmacia();


-- BUSCA POR UNA FECHA 
DROP PROCEDURE IF EXISTS buscaFarmPorFecha;
DELIMITER //
create procedure buscaFarmPorFecha(in desde date)
begin
SELECT 
DATE_FORMAT(FECHA,'%d/%m/%Y')   AS 'FECHA',
        CENTRO                          AS 'CENTRO',
        CODIGO                          AS 'CODIGO',
        MATERIAL                        AS 'MEDICAMENTO',
        IFNULL(STOCK_INICIAL,'-')       AS 'STOCK INICIAL',
        IFNULL(TOTAL_INGRESOS,'-')      AS 'INGRESOS',
        IFNULL(TOTAL_DISPENSADAS,'-')   AS 'DISPENSADAS',
        IFNULL(TOTAL_EGRESOS,'-')       AS 'EGRESOS',
        IFNULL(STOCK_FINAL,'-')         AS 'STOCK FINAL',
        IFNULL(MAXIMO,'-')              AS 'MAXIMO',
        IFNULL(CRITICO,'-')             AS 'N CRITICO',
        ESTADO_SOLICITUD                AS 'CRITICO',
        SOLICITAR                       AS 'SOLICITAR'

 FROM FAR_STOCK_MOVIMIENTOS_DIARIO
where FECHA= desde ORDER BY FECHA,CENTRO_ORDENADO, CODIGO ASC;
END
//
DELIMITER ;

-- call buscaFarmPorFecha('2018-02-25');


-- WHERE ZC.FECHACITA BETWEEN TABLA.FECHA_INICIAL AND TABLA.FECHA_FINAL

-- BUSCA POR RANGO DE FECHAS Y BUSCA TODO
DROP PROCEDURE IF EXISTS buscaFarmRangoFechas;
DELIMITER //
create procedure buscaFarmRangoFechas(in desde date, in hasta date)
begin
SELECT 
DATE_FORMAT(FECHA,'%d/%m/%Y')   AS 'FECHA',
        CENTRO                          AS 'CENTRO',
        CODIGO                          AS 'CODIGO',
        MATERIAL                        AS 'MEDICAMENTO',
        IFNULL(STOCK_INICIAL,'-')       AS 'STOCK INICIAL',
        IFNULL(TOTAL_INGRESOS,'-')      AS 'INGRESOS',
        IFNULL(TOTAL_DISPENSADAS,'-')   AS 'DISPENSADAS',
        IFNULL(TOTAL_EGRESOS,'-')       AS 'EGRESOS',
        IFNULL(STOCK_FINAL,'-')         AS 'STOCK FINAL',
        IFNULL(MAXIMO,'-')              AS 'MAXIMO',
        IFNULL(CRITICO,'-')             AS 'N CRITICO',
        ESTADO_SOLICITUD                AS 'CRITICO',
        SOLICITAR                       AS 'SOLICITAR'
FROM FAR_STOCK_MOVIMIENTOS_DIARIO
where FECHA between desde and hasta ORDER BY FECHA,CENTRO_ORDENADO, CODIGO ASC;
END
//
DELIMITER ;

-- call buscaFarmRangoFechas('2018-02-20','2018-02-26');


-- BUSCA POR FECHA Y MEDICAMENTOS BUSCA TODO
DROP PROCEDURE IF EXISTS buscaFarmFechaYMaterial;
DELIMITER //
create procedure buscaFarmFechaYMaterial(in desde date,in medicamento varchar(100))
begin
SELECT
        DATE_FORMAT(FECHA,'%d/%m/%Y')   AS 'FECHA',
        CENTRO                          AS 'CENTRO',
        CODIGO                          AS 'CODIGO',
        MATERIAL                        AS 'MEDICAMENTO',
        IFNULL(STOCK_INICIAL,'-')       AS 'STOCK INICIAL',
        IFNULL(TOTAL_INGRESOS,'-')      AS 'INGRESOS',
        IFNULL(TOTAL_DISPENSADAS,'-')   AS 'DISPENSADAS',
        IFNULL(TOTAL_EGRESOS,'-')       AS 'EGRESOS',
        IFNULL(STOCK_FINAL,'-')         AS 'STOCK FINAL',
        IFNULL(MAXIMO,'-')              AS 'MAXIMO',
        IFNULL(CRITICO,'-')             AS 'N CRITICO',
        ESTADO_SOLICITUD                AS 'CRITICO',
        SOLICITAR                       AS 'SOLICITAR'
FROM
FAR_STOCK_MOVIMIENTOS_DIARIO 

where FECHA = desde and MATERIAL = medicamento ORDER BY FECHA,CENTRO_ORDENADO, CODIGO ASC;
END
//
DELIMITER ;

-- call buscaFarmFechaYMaterial('2018-01-11','FENITOINA SODICA COMP. 100MG. (CRITICO)');

-- BUSCA POR RANGO DE FECHAS Y MEDICAMENTOS BUSCA TODO
DROP PROCEDURE IF EXISTS buscaFarmRangoFechaYMaterial;
DELIMITER //
create procedure buscaFarmRangoFechaYMaterial(in desde date,in hasta date,in medicamento varchar(100))
begin
SELECT
        DATE_FORMAT(FECHA,'%d/%m/%Y')   AS 'FECHA',
        CENTRO                          AS 'CENTRO',
        CODIGO                          AS 'CODIGO',
        MATERIAL                        AS 'MEDICAMENTO',
        IFNULL(STOCK_INICIAL,'-')       AS 'STOCK INICIAL',
        IFNULL(TOTAL_INGRESOS,'-')      AS 'INGRESOS',
        IFNULL(TOTAL_DISPENSADAS,'-')   AS 'DISPENSADAS',
        IFNULL(TOTAL_EGRESOS,'-')       AS 'EGRESOS',
        IFNULL(STOCK_FINAL,'-')         AS 'STOCK FINAL',
        IFNULL(MAXIMO,'-')              AS 'MAXIMO',
        IFNULL(CRITICO,'-')             AS 'N CRITICO',
        ESTADO_SOLICITUD                AS 'CRITICO',
        SOLICITAR                       AS 'SOLICITAR'
FROM
FAR_STOCK_MOVIMIENTOS_DIARIO 

where FECHA between desde and hasta and MATERIAL = medicamento ORDER BY FECHA,CENTRO_ORDENADO, CODIGO ASC;
END
//
DELIMITER ;

-- call buscaFarmRangoFechaYMaterial('2018-01-11','2018-02-26','ACCU CHEK GO COLESTEROL');


-- BUSCA 1 FECHA, MEDICAMENTO  CENTRO Y SI ES CRITICO O NO
DROP PROCEDURE IF EXISTS buscaFarmFechMedCenCritico;
DELIMITER //
create procedure buscaFarmFechMedCenCritico(in desde date,in medicamento varchar(100), IN centro varchar(10),in critico varchar(5))
begin
SELECT
        DATE_FORMAT(FECHA,'%d/%m/%Y')   AS 'FECHA',
        CENTRO                          AS 'CENTRO',
        CODIGO                          AS 'CODIGO',
        MATERIAL                        AS 'MEDICAMENTO',
        IFNULL(STOCK_INICIAL,'-')       AS 'STOCK INICIAL',
        IFNULL(TOTAL_INGRESOS,'-')      AS 'INGRESOS',
        IFNULL(TOTAL_DISPENSADAS,'-')   AS 'DISPENSADAS',
        IFNULL(TOTAL_EGRESOS,'-')       AS 'EGRESOS',
        IFNULL(STOCK_FINAL,'-')         AS 'STOCK FINAL',
        IFNULL(MAXIMO,'-')              AS 'MAXIMO',
        IFNULL(CRITICO,'-')             AS 'N CRITICO',
        ESTADO_SOLICITUD                AS 'CRITICO',
        SOLICITAR                       AS 'SOLICITAR'
FROM
FAR_STOCK_MOVIMIENTOS_DIARIO 

where FECHA= desde and MATERIAL = medicamento and centro= centro and ESTADO_SOLICITUD = critico ORDER BY FECHA,CENTRO_ORDENADO, CODIGO ASC;
END
//
DELIMITER ;

-- call buscaFarmFechMedCenCritico('2018-01-11','AC. ASCÓRBICO COMP. 100 MG.','Cu', 'No');

-- BUSCA RANGO FECHAS, MEDICAMENTO CENTRO 
DROP PROCEDURE IF EXISTS buscaFarmRangoFechMedCentro;
DELIMITER //
create procedure buscaFarmRangoFechMedCentro(in desde date,in hasta date,in medicamento varchar(100), IN centro varchar(10))
begin
SELECT
        DATE_FORMAT(FECHA,'%d/%m/%Y')   AS 'FECHA',
        CENTRO                          AS 'CENTRO',
        CODIGO                          AS 'CODIGO',
        MATERIAL                        AS 'MEDICAMENTO',
        IFNULL(STOCK_INICIAL,'-')       AS 'STOCK INICIAL',
        IFNULL(TOTAL_INGRESOS,'-')      AS 'INGRESOS',
        IFNULL(TOTAL_DISPENSADAS,'-')   AS 'DISPENSADAS',
        IFNULL(TOTAL_EGRESOS,'-')       AS 'EGRESOS',
        IFNULL(STOCK_FINAL,'-')         AS 'STOCK FINAL',
        IFNULL(MAXIMO,'-')              AS 'MAXIMO',
        IFNULL(CRITICO,'-')             AS 'N CRITICO',
        ESTADO_SOLICITUD                AS 'CRITICO',
        SOLICITAR                       AS 'SOLICITAR'
FROM
FAR_STOCK_MOVIMIENTOS_DIARIO 

where FECHA between desde and hasta and MATERIAL = medicamento and centro= centro  ORDER BY FECHA,CENTRO_ORDENADO, CODIGO ASC;
END
//
DELIMITER ;

-- call buscaFarmRangoFechMedCentro('2018-01-11','2018-02-26','AC. FOLICO COMP 1 MG','Cu');


-- BUSCA RANGO FECHAS, MEDICAMENTO CENTRO  Y CRITICO
DROP PROCEDURE IF EXISTS buscaFarmRangoFechMedCenCritico;
DELIMITER //
create procedure buscaFarmRangoFechMedCenCritico(in desde date,in hasta date,in medicamento varchar(100), IN centro varchar(10), in critico varchar(5))
begin
SELECT
        DATE_FORMAT(FECHA,'%d/%m/%Y')   AS 'FECHA',
        CENTRO                          AS 'CENTRO',
        CODIGO                          AS 'CODIGO',
        MATERIAL                        AS 'MEDICAMENTO',
        IFNULL(STOCK_INICIAL,'-')       AS 'STOCK INICIAL',
        IFNULL(TOTAL_INGRESOS,'-')      AS 'INGRESOS',
        IFNULL(TOTAL_DISPENSADAS,'-')   AS 'DISPENSADAS',
        IFNULL(TOTAL_EGRESOS,'-')       AS 'EGRESOS',
        IFNULL(STOCK_FINAL,'-')         AS 'STOCK FINAL',
        IFNULL(MAXIMO,'-')              AS 'MAXIMO',
        IFNULL(CRITICO,'-')             AS 'N CRITICO',
        ESTADO_SOLICITUD                AS 'CRITICO',
        SOLICITAR                       AS 'SOLICITAR'
FROM
FAR_STOCK_MOVIMIENTOS_DIARIO 

where FECHA between desde and hasta and MATERIAL = medicamento and centro= centro and ESTADO_SOLICITUD = critico ORDER BY FECHA,CENTRO_ORDENADO, CODIGO ASC;
END
//
DELIMITER ;

-- call buscaFarmRangoFechMedCenCritico('2018-01-11','2018-02-26','AC. FOLICO COMP 1 MG','Cu','SI');


-- BUSCA 1 FECHA y el codigo
DROP PROCEDURE IF EXISTS buscaSoloFechaYCodigo;
DELIMITER //
create procedure buscaSoloFechaYCodigo(in desde date,IN codigo varchar(10))
begin
SELECT
        DATE_FORMAT(FECHA,'%d/%m/%Y')   AS 'FECHA',
        CENTRO                          AS 'CENTRO',
        CODIGO                          AS 'CODIGO',
        MATERIAL                        AS 'MEDICAMENTO',
        IFNULL(STOCK_INICIAL,'-')       AS 'STOCK INICIAL',
        IFNULL(TOTAL_INGRESOS,'-')      AS 'INGRESOS',
        IFNULL(TOTAL_DISPENSADAS,'-')   AS 'DISPENSADAS',
        IFNULL(TOTAL_EGRESOS,'-')       AS 'EGRESOS',
        IFNULL(STOCK_FINAL,'-')         AS 'STOCK FINAL',
        IFNULL(MAXIMO,'-')              AS 'MAXIMO',
        IFNULL(CRITICO,'-')             AS 'N CRITICO',
        ESTADO_SOLICITUD                AS 'CRITICO',
        SOLICITAR                       AS 'SOLICITAR'
FROM
FAR_STOCK_MOVIMIENTOS_DIARIO 

where FECHA = desde and CODIGO = codigo ORDER BY FECHA,CENTRO_ORDENADO, CODIGO ASC;
END
//
DELIMITER ;

-- call buscaSoloFechaYCodigo('2018-01-11','6643');


-- BUSCA 1 FECHA , CODIGO Y CENTRO 
DROP PROCEDURE IF EXISTS buscaSoloFechaCodigoYCentro;
DELIMITER //
create procedure buscaSoloFechaCodigoYCentro(in desde date,IN codigo varchar(10),in centro varchar(3))
begin
SELECT
        DATE_FORMAT(FECHA,'%d/%m/%Y')   AS 'FECHA',
        CENTRO                          AS 'CENTRO',
        CODIGO                          AS 'CODIGO',
        MATERIAL                        AS 'MEDICAMENTO',
        IFNULL(STOCK_INICIAL,'-')       AS 'STOCK INICIAL',
        IFNULL(TOTAL_INGRESOS,'-')      AS 'INGRESOS',
        IFNULL(TOTAL_DISPENSADAS,'-')   AS 'DISPENSADAS',
        IFNULL(TOTAL_EGRESOS,'-')       AS 'EGRESOS',
        IFNULL(STOCK_FINAL,'-')         AS 'STOCK FINAL',
        IFNULL(MAXIMO,'-')              AS 'MAXIMO',
        IFNULL(CRITICO,'-')             AS 'N CRITICO',
        ESTADO_SOLICITUD                AS 'CRITICO',
        SOLICITAR                       AS 'SOLICITAR'
FROM
FAR_STOCK_MOVIMIENTOS_DIARIO 

where FECHA = desde and CODIGO = codigo and centro= centro ORDER BY FECHA,CENTRO_ORDENADO, CODIGO ASC;
END
//
DELIMITER ;

-- call buscaSoloFechaCodigoYCentro('2018-01-11','COI-4162','cu');

-- BUSCA 1 FECHA , CODIGO Y CENTRO 
DROP PROCEDURE IF EXISTS buscaSoloFechaCodigoCentroCritico;
DELIMITER //
create procedure buscaSoloFechaCodigoCentroCritico(in desde date,IN codigo varchar(10),in centro varchar(3), in critico varchar(2))
begin
SELECT
        DATE_FORMAT(FECHA,'%d/%m/%Y')   AS 'FECHA',
        CENTRO                          AS 'CENTRO',
        CODIGO                          AS 'CODIGO',
        MATERIAL                        AS 'MEDICAMENTO',
        IFNULL(STOCK_INICIAL,'-')       AS 'STOCK INICIAL',
        IFNULL(TOTAL_INGRESOS,'-')      AS 'INGRESOS',
        IFNULL(TOTAL_DISPENSADAS,'-')   AS 'DISPENSADAS',
        IFNULL(TOTAL_EGRESOS,'-')       AS 'EGRESOS',
        IFNULL(STOCK_FINAL,'-')         AS 'STOCK FINAL',
        IFNULL(MAXIMO,'-')              AS 'MAXIMO',
        IFNULL(CRITICO,'-')             AS 'N CRITICO',
        ESTADO_SOLICITUD                AS 'CRITICO',
        SOLICITAR                       AS 'SOLICITAR'
FROM
FAR_STOCK_MOVIMIENTOS_DIARIO 

where FECHA = desde and CODIGO = codigo and centro= centro and ESTADO_SOLICITUD= critico ORDER BY FECHA,CENTRO_ORDENADO, CODIGO ASC;
END
//
DELIMITER ;

-- call buscaSoloFechaCodigoCentroCritico('2018-01-11','COI-4162','cu','NO');


-- BUSCA POR RANGO DE FECHAS Y CODIGO
DROP PROCEDURE IF EXISTS buscaRangoFechaCodigo;
DELIMITER //
create procedure buscaRangoFechaCodigo(in desde date, in hasta date,in codigo varchar(10))
begin
SELECT
        DATE_FORMAT(FECHA,'%d/%m/%Y')   AS 'FECHA',
        CENTRO                          AS 'CENTRO',
        CODIGO                          AS 'CODIGO',
        MATERIAL                        AS 'MEDICAMENTO',
        IFNULL(STOCK_INICIAL,'-')       AS 'STOCK INICIAL',
        IFNULL(TOTAL_INGRESOS,'-')      AS 'INGRESOS',
        IFNULL(TOTAL_DISPENSADAS,'-')   AS 'DISPENSADAS',
        IFNULL(TOTAL_EGRESOS,'-')       AS 'EGRESOS',
        IFNULL(STOCK_FINAL,'-')         AS 'STOCK FINAL',
        IFNULL(MAXIMO,'-')              AS 'MAXIMO',
        IFNULL(CRITICO,'-')             AS 'N CRITICO',
        ESTADO_SOLICITUD                AS 'CRITICO',
        SOLICITAR                       AS 'SOLICITAR'
FROM
FAR_STOCK_MOVIMIENTOS_DIARIO 

where FECHA between desde and hasta and CODIGO= codigo ORDER BY FECHA,CENTRO_ORDENADO, CODIGO ASC;
END
//
DELIMITER ;

-- call buscaRangoFechaCodigo('2018-02-20','2018-02-26','1986');



DROP PROCEDURE IF EXISTS buscaRangoFechaCodigoCentro;
DELIMITER //
create procedure buscaRangoFechaCodigoCentro(in desde date, in hasta date,in codigo varchar(10), in centro varchar(5))
begin
SELECT
        DATE_FORMAT(FECHA,'%d/%m/%Y')   AS 'FECHA',
        CENTRO                          AS 'CENTRO',
        CODIGO                          AS 'CODIGO',
        MATERIAL                        AS 'MEDICAMENTO',
        IFNULL(STOCK_INICIAL,'-')       AS 'STOCK INICIAL',
        IFNULL(TOTAL_INGRESOS,'-')      AS 'INGRESOS',
        IFNULL(TOTAL_DISPENSADAS,'-')   AS 'DISPENSADAS',
        IFNULL(TOTAL_EGRESOS,'-')       AS 'EGRESOS',
        IFNULL(STOCK_FINAL,'-')         AS 'STOCK FINAL',
        IFNULL(MAXIMO,'-')              AS 'MAXIMO',
        IFNULL(CRITICO,'-')             AS 'N CRITICO',
        ESTADO_SOLICITUD                AS 'CRITICO',
        SOLICITAR                       AS 'SOLICITAR'
FROM
FAR_STOCK_MOVIMIENTOS_DIARIO 

where FECHA between desde and hasta and CODIGO= codigo ORDER BY FECHA,CENTRO_ORDENADO, CODIGO ASC;
END
//
DELIMITER ;

-- call buscaRangoFechaCodigoCentro('2018-02-20','2018-02-26','1986','cu');



-- BUSCA POR RANGO DE FECHAS  CODIGO cerntro y critico
DROP PROCEDURE IF EXISTS buscaRangoFechaCodigoCentroCritico;
DELIMITER //
create procedure buscaRangoFechaCodigoCentroCritico(in desde date, in hasta date,in codigo varchar(10), in centro varchar(5), in critico varchar(4))
begin
SELECT
        DATE_FORMAT(FECHA,'%d/%m/%Y')   AS 'FECHA',
        CENTRO                          AS 'CENTRO',
        CODIGO                          AS 'CODIGO',
        MATERIAL                        AS 'MEDICAMENTO',
        IFNULL(STOCK_INICIAL,'-')       AS 'STOCK INICIAL',
        IFNULL(TOTAL_INGRESOS,'-')      AS 'INGRESOS',
        IFNULL(TOTAL_DISPENSADAS,'-')   AS 'DISPENSADAS',
        IFNULL(TOTAL_EGRESOS,'-')       AS 'EGRESOS',
        IFNULL(STOCK_FINAL,'-')         AS 'STOCK FINAL',
        IFNULL(MAXIMO,'-')              AS 'MAXIMO',
        IFNULL(CRITICO,'-')             AS 'N CRITICO',
        ESTADO_SOLICITUD                AS 'CRITICO',
        SOLICITAR                       AS 'SOLICITAR'
FROM
FAR_STOCK_MOVIMIENTOS_DIARIO 

where FECHA between desde and hasta and CODIGO= codigo and ESTADO_SOLICITUD = critico ORDER BY FECHA,CENTRO_ORDENADO, CODIGO ASC;
END
//
DELIMITER ;

-- call buscaRangoFechaCodigoCentroCritico('2018-02-20','2018-03-01','1986','cu','No');


------------------------------ OCUPACION AGENDA -----------------------------------------

DROP PROCEDURE IF EXISTS cargaSelectOcupacionAgenda;
DELIMITER //
CREATE PROCEDURE cargaSelectOcupacionAgenda()
BEGIN
	select * from agenda_actos_desc order by  descripcion asc;
END
//
DELIMITER ;

call cargaSelectOcupacionAgenda();



-- CARGA EL SUBMENI DEL MODULO AGENDA
DROP PROCEDURE IF EXISTS cargaMenuAgenda;
DELIMITER //
create procedure cargaMenuAgenda()
begin
	select idsubMenu,nombre,url,imagen from submenu ;
END
//
DELIMITER ;

call cargaMenuAgenda();





