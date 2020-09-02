-- drop database if exists redsocial;
create database if not exists redsocial;
use redsocial;

CREATE TABLE `usuarios` (
  `idusuario` int NOT NULL,
  `idPrivilegio` int NOT NULL,
  `correo` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `sexo` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `token` varchar(255)  NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `perfil` (
  `idperfil` int NOT NULL,
  `idUsuario` int NOT NULL,
  `fotoPerfil` varchar(200) NOT NULL,
  `fotoPortada` varchar(200) NOT NULL,
  `nombreCompleto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `privilegios` (
  `idPerfil` int NOT NULL,
  `nombrePrivilegio` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  CREATE TABLE `seguidores` (
  `idsigue` int NOT NULL,
  `id_seguido`int NOT NULL,
  `id_seguir` int NOT NULL,
  `estado_aprobado` boolean default 0 NOT NULL,
  `fecha_sigue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `publicaciones` (
  `idpublicacion` int NOT NULL,
  `idUserPublico` int NOT NULL,
  `contenidoPublicacion` longtext NOT NULL,
  `fotoPublicacion` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `fechaPublicacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `tiposnotificaciones` (
  `idtiposNotificaciones` int NOT NULL,
  `nombreTipo` varchar(60) NOT NULL,
  `mensajeNotificacion` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `comentarios` (
  `idcomentario` int NOT NULL,
  `idPublicacion` int NOT NULL,
  `idUser` int NOT NULL,
  `contenidoComentario` longtext NOT NULL,
  `fechaComentario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `likes` (
  `idlike` int NOT NULL,
  `idPublicacion` int NOT NULL,
  `idUser` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `mensajes` (
  `idmensaje` int NOT NULL,
  `usuarios_idusuario` int NOT NULL,
  `usuarioMando` int NOT NULL,
  `contenido` longtext NOT NULL,
  `fechaMensaje` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `notificaciones` (
  `idnotificacion` int NOT NULL,
  `idpublicacion` int NOT NULL,
  `idUsuario` int NOT NULL,
  `usuarioAccion` int NOT NULL,
  `tipoNotificacion` int NOT NULL,
  `estado` boolean NOT NULL DEFAULT 1,
  `fechaNotificacion`  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `compartir` (
  `idcompartir` int NOT NULL,
  `idpublicacion`int NOT NULL,
  `idusuario` int NOT NULL,
  `fechacompartir` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idcomentario`),
  ADD KEY `comentarioPublicacion_idx` (`idPublicacion`),
  ADD KEY `comentarioUser_idx` (`idUser`);

ALTER TABLE `likes`
  ADD PRIMARY KEY (`idlike`),
  ADD KEY `publiLikes_idx` (`idPublicacion`),
  ADD KEY `usuarioLike_idx` (`idUser`);

ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`idmensaje`),
  ADD KEY `fk_mensajes_usuarios1_idx` (`usuarios_idusuario`),
  ADD KEY `usuarioMando` (`usuarioMando`);
  
  ALTER TABLE `seguidores`
  ADD PRIMARY KEY (`idsigue`);

 ALTER TABLE `compartir`
  ADD PRIMARY KEY (`idcompartir`);
  
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`idnotificacion`),
  ADD KEY `usuarioNotificacion_idx` (`idUsuario`),
  ADD KEY `fk_notificaciones_tiposNotificaciones1_idx` (`tipoNotificacion`),
  ADD KEY `usuarioAccion` (`usuarioAccion`);

ALTER TABLE `perfil`
  ADD PRIMARY KEY (`idperfil`),
  ADD KEY `perfilUser_idx` (`idUsuario`);

ALTER TABLE `privilegios`
  ADD PRIMARY KEY (`idPerfil`);

ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`idpublicacion`),
  ADD KEY `publicacioesUser_idx` (`idUserPublico`);

ALTER TABLE `tiposnotificaciones`
  ADD PRIMARY KEY (`idtiposNotificaciones`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `priviUser_idx` (`idPrivilegio`);
  
-- auto incrementos
ALTER TABLE `compartir`
  MODIFY `idcompartir` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


ALTER TABLE `seguidores`
  MODIFY `idsigue` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `comentarios`
  MODIFY `idcomentario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `likes`
  MODIFY `idlike` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
  
ALTER TABLE `mensajes`
  MODIFY `idmensaje` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `notificaciones`
  MODIFY `idnotificacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `perfil`
  MODIFY `idperfil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `privilegios`
  MODIFY `idPerfil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `publicaciones`
  MODIFY `idpublicacion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `tiposnotificaciones`
  MODIFY `idtiposNotificaciones` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `usuarios`
  MODIFY `idusuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarioPublicacion` FOREIGN KEY (`idPublicacion`) REFERENCES `publicaciones` (`idpublicacion`),
  ADD CONSTRAINT `comentarioUser` FOREIGN KEY (`idUser`) REFERENCES `usuarios` (`idusuario`);

ALTER TABLE `likes`
  ADD CONSTRAINT `publiLikes` FOREIGN KEY (`idPublicacion`) REFERENCES `publicaciones` (`idpublicacion`),
  ADD CONSTRAINT `usuarioLike` FOREIGN KEY (`idUser`) REFERENCES `usuarios` (`idusuario`);

ALTER TABLE `mensajes`
  ADD CONSTRAINT `fk_mensajes_usuarios1` FOREIGN KEY (`usuarios_idusuario`) REFERENCES `usuarios` (`idusuario`),
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`usuarioMando`) REFERENCES `usuarios` (`idusuario`);

ALTER TABLE `seguidores`
  ADD CONSTRAINT `llaveforanea_seguidores` FOREIGN KEY (`id_seguido`) REFERENCES `usuarios` (`idusuario`),
  ADD CONSTRAINT `llaveforanea_seguidores_fk` FOREIGN KEY (`id_seguir`) REFERENCES `usuarios` (`idusuario`);

ALTER TABLE `compartir`
  ADD CONSTRAINT `llaveforanea_compartir_fk` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`),
  ADD CONSTRAINT `llaveforanea_compartir` FOREIGN KEY (`idpublicacion`) REFERENCES `publicaciones` (`idpublicacion`);

ALTER TABLE `notificaciones`
  ADD CONSTRAINT `fk_notificaciones_tiposNotificaciones1` FOREIGN KEY (`tipoNotificacion`) REFERENCES `tiposnotificaciones` (`idtiposNotificaciones`),
  ADD CONSTRAINT `notificaciones_ibfk_1` FOREIGN KEY (`usuarioAccion`) REFERENCES `usuarios` (`idusuario`),
  ADD CONSTRAINT `usuarioNotificacion` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idusuario`);

ALTER TABLE `perfil`
  ADD CONSTRAINT `perfilUser` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idusuario`);

ALTER TABLE `publicaciones`
  ADD CONSTRAINT `publicacioesUser` FOREIGN KEY (`idUserPublico`) REFERENCES `usuarios` (`idusuario`);

ALTER TABLE `usuarios`
  ADD CONSTRAINT `priviUser` FOREIGN KEY (`idPrivilegio`) REFERENCES `privilegios` (`idPerfil`);


-- creacion de vistas
create view consulta_todas_publicaciones as
SELECT p.idpublicacion, u.idusuario,u.usuario ,p.contenidopublicacion, p.fotopublicacion, p.fechapublicacion, 
      pe.idperfil,pe.fotoperfil,pe.nombrecompleto from publicaciones as p inner join usuarios as u on u.idUsuario = p.iduserpublico
																	    inner join perfil as pe on u.idusuario = pe.idUsuario;                                                                        
                   
create view consulta_comentarios as
SELECT c.idpublicacion,c.idcomentario,c.iduser, c.contenidoComentario,pe.fotoperfil, u.usuario, c.fechacomentario
           from comentarios as c inner join usuarios as u on u.idUsuario = c.iduser
								 inner join perfil as pe on u.idusuario = pe.idUsuario;  

-- creacion de un procedimiento almacenado
create procedure consulta_publicaciones_usuario(ID int) 
SELECT p.idpublicacion, u.idusuario,u.usuario ,p.contenidopublicacion, p.fotopublicacion, p.fechapublicacion, 
      pe.idperfil,pe.fotoperfil,pe.nombrecompleto from publicaciones as p inner join usuarios as u on u.idUsuario = p.iduserpublico
																	    inner join perfil as pe on u.idusuario = pe.idUsuario
														WHERE u.idusuario = ID order by p.idpublicacion desc;
                                                                        
-- consulta ordenada de las notificaciones POR USUARIO
create procedure consulta_notificaciones(ID INT)
SELECT n.idnotificacion,n.idusuario,n.idpublicacion,u.usuario,u.idusuario,tn.mensajeNotificacion,p.fotoPerfil,n.fechaNotificacion 
        from notificaciones as n inner join usuarios as u on n.usuarioAccion = u.idusuario  
                                 inner join perfil as p on p.idusuario =  u.idusuario
                                 inner join tiposnotificaciones as tn on tn.idtiposNotificaciones = n.tipoNotificacion
                                 WHERE n.idusuario = ID order by n.idnotificacion desc;



create procedure consulta_chats(ID int)
SELECT u.idusuario,p.fotoPerfil,p.nombrecompleto FROM mensajes as m inner join usuarios AS u on m.usuarios_idusuario = u.idusuario  or m.usuarioMando = u.idusuario
                            inner join perfil as p on p.idusuario = u.idusuario
                            where (m.usuarios_idusuario = ID or m.usuarioMando = ID)  and u.idusuario != ID
                            group by u.idusuario order by fechaMensaje ASC ;

create procedure consulta_aceptar_seguidores(ID int)
SELECT s.idsigue,u.idusuario,u.usuario,p.fotoPerfil,p.nombrecompleto,s.fecha_sigue FROM seguidores as s inner join usuarios AS u on s.id_seguido = u.idusuario 
                            inner join perfil as p on p.idusuario = u.idusuario
                           WHERE id_seguir = ID and estado_aprobado = 0;
                           
create procedure consulta_seguidores(ID int,ESTADO INT)
SELECT s.idsigue,s.id_seguido,s.id_seguir,s.estado_aprobado,u.idusuario,u.usuario,p.fotoPerfil,p.nombrecompleto,s.fecha_sigue 
FROM seguidores as s inner join usuarios AS u on s.id_seguir = u.idusuario 
                            inner join perfil as p on p.idusuario = u.idusuario
                           WHERE s.id_seguido = ID and s.estado_aprobado = ESTADO;

create procedure consulta_seguidos(ID int,ESTADO INT)
SELECT s.idsigue,s.id_seguido,s.id_seguir,s.estado_aprobado,u.idusuario,u.usuario,p.fotoPerfil,p.nombrecompleto,s.fecha_sigue 
FROM seguidores as s inner join usuarios AS u on s.id_seguido = u.idusuario 
                            inner join perfil as p on p.idusuario = u.idusuario
                           WHERE s.id_seguir = ID and s.estado_aprobado = ESTADO;
                           
create procedure consulta_publicacion_compartida(IDPUBLICACION int)
SELECT c.idpublicacion,u.idusuario,u.usuario,p.fotoPerfil,p.nombrecompleto,c.fechacompartir 
FROM compartir as c inner join usuarios AS u on c.idusuario = u.idusuario 
                            inner join perfil as p on p.idusuario = u.idusuario
                            WHERE c.idpublicacion = IDPUBLICACION ; 
                            
                            
create procedure consulta_publicacion_megusta(IDPUBLICACION int)
SELECT l.idpublicacion,l.idUser,u.usuario,p.fotoPerfil,p.nombrecompleto
FROM likes as l inner join usuarios AS u on l.idUser = u.idusuario 
                            inner join perfil as p on p.idusuario = u.idusuario
                            WHERE l.idpublicacion = IDPUBLICACION ; 

create procedure consulta_usuario(IDUSUARIO int)
SELECT u.idusuario,u.usuario,u.correo,u.sexo,p.nombrecompleto
FROM usuarios as u inner join perfil as p on p.idusuario = u.idusuario
                            WHERE u.idusuario = IDUSUARIO ; 
                        


INSERT INTO `privilegios` (`idPerfil`, `nombrePrivilegio`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

INSERT INTO tiposnotificaciones VALUES  (1,"Like", "le ha dado me gusta a tu publicacion"),
										(2,"Comentario", "ha comentado tu publicacion"),
                                        (3,"Compartir", "ha compartido tu publicacion");
                                        
