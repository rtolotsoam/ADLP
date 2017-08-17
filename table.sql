-- Table: public.fte_access_group

-- DROP TABLE public.fte_access_group;

CREATE TABLE public.fte_access_group
(
  fte_group_id integer NOT NULL DEFAULT nextval(('public.fte_group_seq'::text)::regclass),
  libelle_group character varying,
  flag integer DEFAULT 1,
  CONSTRAINT pk_fte_group PRIMARY KEY (fte_group_id)
)
WITH (
  OIDS=TRUE
);
ALTER TABLE public.fte_access_group
  OWNER TO postgres;


-- Table: public.fte_action

-- DROP TABLE public.fte_action;

CREATE TABLE public.fte_action
(
  fte_action_id integer NOT NULL DEFAULT nextval(('public.fte_action_seq'::text)::regclass),
  libelle character varying,
  process_id integer NOT NULL,
  process_redirect_id integer NOT NULL,
  action_js text,
  traitement_id integer,
  id_html character varying,
  flag integer DEFAULT 1,
  CONSTRAINT pk_fte_action PRIMARY KEY (fte_action_id),
  CONSTRAINT fte_action_process_id_fkey FOREIGN KEY (process_id)
      REFERENCES public.fte_process (fte_process_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fte_action_traitement_id_fkey FOREIGN KEY (traitement_id)
      REFERENCES public.fte_traitement (fte_traitement_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=TRUE
);
ALTER TABLE public.fte_action
  OWNER TO postgres;

  
-- Table: public.fte_categories

-- DROP TABLE public.fte_categories;

CREATE TABLE public.fte_categories
(
  fte_categories_id integer NOT NULL DEFAULT nextval(('public.fte_categories_seq'::text)::regclass),
  libelle_categories character varying,
  niveau integer,
  parent_id integer,
  traitement_id integer DEFAULT 0,
  contenu_categorie text,
  categories_id integer,
  root_id integer,
  flag integer DEFAULT 1,
  id_group integer DEFAULT 0,
  CONSTRAINT pk_fte_categories PRIMARY KEY (fte_categories_id),
  CONSTRAINT fte_categories_id_group_fkey FOREIGN KEY (id_group)
      REFERENCES public.fte_access_group (fte_group_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fte_categories_traitement_id_fkey FOREIGN KEY (traitement_id)
      REFERENCES public.fte_traitement (fte_traitement_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=TRUE
);
ALTER TABLE public.fte_categories
  OWNER TO postgres;

  
-- Table: public.fte_historique

-- DROP TABLE public.fte_historique;

CREATE TABLE public.fte_historique
(
  fte_historique_id integer NOT NULL DEFAULT nextval(('public.fte_historique_seq'::text)::regclass),
  process_id integer NOT NULL,
  session_id character varying,
  heure timestamp without time zone NOT NULL DEFAULT (now())::timestamp without time zone,
  flag integer DEFAULT '-1'::integer,
  matricule integer,
  CONSTRAINT pk_fte_historique PRIMARY KEY (fte_historique_id),
  CONSTRAINT fte_historique_process_id_fkey FOREIGN KEY (process_id)
      REFERENCES public.fte_process (fte_process_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=TRUE
);
ALTER TABLE public.fte_historique
  OWNER TO postgres;

  
-- Table: public.fte_notification_maj

-- DROP TABLE public.fte_notification_maj;

CREATE TABLE public.fte_notification_maj
(
  fte_notification_maj_id integer NOT NULL DEFAULT nextval(('public.fte_notification_id_seq'::text)::regclass),
  titre character varying,
  corps character varying NOT NULL,
  couleur character varying,
  date_creation timestamp without time zone NOT NULL DEFAULT (now())::timestamp without time zone,
  active integer NOT NULL DEFAULT 1,
  createur integer NOT NULL,
  CONSTRAINT fte_notification_maj_pkey PRIMARY KEY (fte_notification_maj_id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.fte_notification_maj
  OWNER TO postgres;
GRANT ALL ON TABLE public.fte_notification_maj TO postgres;
GRANT ALL ON TABLE public.fte_notification_maj TO public;


-- Table: public.fte_notification_maj_consulte

-- DROP TABLE public.fte_notification_maj_consulte;

CREATE TABLE public.fte_notification_maj_consulte
(
  id_notification integer NOT NULL,
  consulte integer NOT NULL,
  date_consulte date NOT NULL DEFAULT now(),
  fte_consulte_id integer NOT NULL DEFAULT nextval(('public.fte_consulte_seq'::text)::regclass),
  CONSTRAINT fte_consulte_pkey PRIMARY KEY (fte_consulte_id),
  CONSTRAINT fte_consulte_fkey FOREIGN KEY (id_notification)
      REFERENCES public.fte_notification_maj (fte_notification_maj_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=TRUE
);
ALTER TABLE public.fte_notification_maj_consulte
  OWNER TO postgres;

  
-- Table: public.fte_process

-- DROP TABLE public.fte_process;

CREATE TABLE public.fte_process
(
  fte_process_id integer NOT NULL DEFAULT nextval(('public.fte_process_seq'::text)::regclass),
  parent_id integer NOT NULL,
  campagne_id integer NOT NULL,
  image_id integer DEFAULT 0,
  commentaire_id integer DEFAULT 0,
  text_html text,
  ordre integer,
  alias character varying,
  libelle character varying(254),
  flag integer DEFAULT 1,
  CONSTRAINT pk_fte_process PRIMARY KEY (fte_process_id),
  CONSTRAINT fte_process_campagne_id_fkey FOREIGN KEY (campagne_id)
      REFERENCES public.fte_traitement (fte_traitement_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT fte_process_campagne_id_fkey1 FOREIGN KEY (campagne_id)
      REFERENCES public.fte_traitement (fte_traitement_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=TRUE
);
ALTER TABLE public.fte_process
  OWNER TO postgres;
GRANT ALL ON TABLE public.fte_process TO postgres;
GRANT ALL ON TABLE public.fte_process TO public;


-- Table: public.fte_traitement

-- DROP TABLE public.fte_traitement;

CREATE TABLE public.fte_traitement
(
  fte_traitement_id integer NOT NULL DEFAULT nextval(('public.fte_traitement_seq'::text)::regclass),
  info_traitement character varying,
  source_info character varying,
  flag integer DEFAULT 1,
  flag_processus integer DEFAULT 0,
  flag_action integer DEFAULT 0,
  CONSTRAINT pk_fte_traitement PRIMARY KEY (fte_traitement_id)
)
WITH (
  OIDS=TRUE
);
ALTER TABLE public.fte_traitement
  OWNER TO postgres;

  
-- Table: public.fte_traitement_fonction

-- DROP TABLE public.fte_traitement_fonction;

CREATE TABLE public.fte_traitement_fonction
(
  fte_traitement_fonction_id integer NOT NULL DEFAULT nextval(('public.fte_traitement_fonction_seq'::text)::regclass),
  text_js text,
  traitement_id integer,
  CONSTRAINT pk_fte_traitement_fonction PRIMARY KEY (fte_traitement_fonction_id),
  CONSTRAINT fte_traitement_fonction_traitement_id_fkey FOREIGN KEY (traitement_id)
      REFERENCES public.fte_traitement (fte_traitement_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=TRUE
);
ALTER TABLE public.fte_traitement_fonction
  OWNER TO postgres;
GRANT ALL ON TABLE public.fte_traitement_fonction TO postgres;


-- Table: public.fte_user

-- DROP TABLE public.fte_user;

CREATE TABLE public.fte_user
(
  fte_user_id integer NOT NULL DEFAULT nextval(('public.fte_user_seq'::text)::regclass),
  matricule integer NOT NULL,
  pass character varying(255),
  level character varying(10),
  prenom character varying,
  mail character varying,
  statut integer DEFAULT 1,
  access_1 integer DEFAULT 0,
  flag integer DEFAULT 1,
  gestion_process integer DEFAULT 0,
  gestion_user integer DEFAULT 0,
  id_group integer DEFAULT 0,
  CONSTRAINT fte_user_id_pkey PRIMARY KEY (fte_user_id),
  CONSTRAINT fte_user_id_group_fkey FOREIGN KEY (id_group)
      REFERENCES public.fte_access_group (fte_group_id) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.fte_user
  OWNER TO postgres;
GRANT ALL ON TABLE public.fte_user TO postgres;
GRANT ALL ON TABLE public.fte_user TO public;

  
-- View: vw_historique

-- DROP VIEW vw_historique;

CREATE OR REPLACE VIEW vw_historique AS 
 WITH fte_historique2 AS (
         SELECT fh.process_id,
            fh.heure,
            fh.session_id,
            fh.flag,
            fh.matricule,
            fp.libelle,
            fp.campagne_id
           FROM fte_historique fh
             LEFT JOIN fte_process fp ON fh.process_id = fp.fte_process_id
          ORDER BY fh.heure
        )
 SELECT ( SELECT fte_traitement.info_traitement
           FROM fte_traitement
          WHERE fte_traitement.fte_traitement_id = max(fte_historique2.campagne_id)) AS campagne_id,
    fte_historique2.session_id,
    fte_historique2.matricule,
    string_agg(((fte_historique2.libelle::text || ' '::text) ||
        CASE
            WHEN fte_historique2.flag = 0 THEN '<span class="label label-default"> annulé </span>'::text
            WHEN fte_historique2.flag = 1 THEN '<span class="label label-success"> ok </span>'::text
            WHEN fte_historique2.flag = 2 THEN '<span class="label label-success"> sortie normal </span>'::text
            WHEN fte_historique2.flag = (-2) THEN '<span class="label label-danger"> sortie interrompue </span>'::text
            ELSE NULL::text
        END) || ' '::text, '<i class="fa fa-hand-o-right" aria-hidden="true"></i> '::text) AS etapes,
    to_char(min(fte_historique2.heure), 'DD/MM/YYYY à HH24:MI:SS'::text) AS debut,
    to_char(max(fte_historique2.heure), 'DD/MM/YYYY à HH24:MI:SS'::text) AS fin
   FROM fte_historique2
  GROUP BY fte_historique2.session_id, fte_historique2.matricule
  ORDER BY to_char(min(fte_historique2.heure), 'DD/MM/YYYY à HH24:MI:SS'::text) DESC;

ALTER TABLE vw_historique
  OWNER TO postgres;

  
-- View: vw_historique_export

-- DROP VIEW vw_historique_export;

CREATE OR REPLACE VIEW vw_historique_export AS 
 WITH fte_historique2 AS (
         SELECT fh.process_id,
            fh.heure,
            fh.session_id,
            fh.flag,
            fh.matricule,
            fp.libelle,
            fp.campagne_id
           FROM fte_historique fh
             LEFT JOIN fte_process fp ON fh.process_id = fp.fte_process_id
        )
 SELECT ( SELECT fte_traitement.info_traitement
           FROM fte_traitement
          WHERE fte_traitement.fte_traitement_id = max(fte_historique2.campagne_id)) AS campagne_id,
    fte_historique2.session_id,
    fte_historique2.matricule,
    string_agg(((fte_historique2.libelle::text || ' '::text) ||
        CASE
            WHEN fte_historique2.flag = 0 THEN '<<annulé>>'::text
            WHEN fte_historique2.flag = 1 THEN '<<ok>>'::text
            WHEN fte_historique2.flag = 2 THEN '<<sortie normale>>'::text
            WHEN fte_historique2.flag = (-2) THEN '<<sortie interrompue>>'::text
            ELSE NULL::text
        END) || ' '::text, '=>'::text) AS etapes,
    to_char(min(fte_historique2.heure), 'DD/MM/YYYY à HH24:MI:SS'::text) AS debut,
    to_char(max(fte_historique2.heure), 'DD/MM/YYYY à HH24:MI:SS'::text) AS fin,
    min(fte_historique2.heure)::date AS date_deb,
    max(fte_historique2.heure)::date AS date_fin
   FROM fte_historique2
  GROUP BY fte_historique2.session_id, fte_historique2.matricule;

ALTER TABLE vw_historique_export
  OWNER TO postgres;

  
-- View: vw_historique_export_1

-- DROP VIEW vw_historique_export_1;

CREATE OR REPLACE VIEW vw_historique_export_1 AS 
 WITH fte_historique2 AS (
         SELECT DISTINCT fh.process_id,
            fh.heure,
            fh.session_id,
            fh.flag,
            fh.matricule,
            fp.libelle,
            fp.campagne_id,
            ft.info_traitement AS trait,
            fc2.libelle_categories AS categ
           FROM fte_historique fh
             LEFT JOIN fte_process fp ON fh.process_id = fp.fte_process_id
             LEFT JOIN fte_traitement ft ON fp.campagne_id = ft.fte_traitement_id
             LEFT JOIN fte_categories fc4 ON ft.fte_traitement_id = fc4.traitement_id
             LEFT JOIN fte_categories fc3 ON fc4.parent_id = fc3.fte_categories_id
             LEFT JOIN fte_categories fc2 ON fc3.parent_id = fc2.fte_categories_id
          ORDER BY fh.heure
        )
 SELECT fte_historique2.session_id AS sess,
    fte_historique2.matricule,
    max(fte_historique2.categ::text) AS categorie,
    max(fte_historique2.trait::text) AS traitement,
    string_agg(
        CASE
            WHEN fte_historique2.flag = 0 THEN fte_historique2.libelle::text
            WHEN fte_historique2.flag = 1 THEN fte_historique2.libelle::text
            ELSE NULL::text
        END, '=>'::text) AS etapes1,
    string_agg(
        CASE
            WHEN fte_historique2.flag = 2 THEN 'sortie normale'::text
            WHEN fte_historique2.flag = (-2) THEN 'interrompue -> '::text || fte_historique2.libelle::text
            ELSE ''::text
        END, ''::text) AS statut,
    to_char(min(fte_historique2.heure), 'DD/MM/YYYY à HH24:MI:SS'::text) AS debut,
    to_char(max(fte_historique2.heure), 'DD/MM/YYYY à HH24:MI:SS'::text) AS fin,
    min(fte_historique2.heure)::date AS date_deb,
    max(fte_historique2.heure)::date AS date_fin
   FROM fte_historique2
  GROUP BY fte_historique2.session_id, fte_historique2.matricule
  ORDER BY min(fte_historique2.heure)::date, max(fte_historique2.heure)::date, fte_historique2.matricule;

ALTER TABLE vw_historique_export_1
  OWNER TO postgres;

  
-- View: vw_notification_maj

-- DROP VIEW vw_notification_maj;

CREATE OR REPLACE VIEW vw_notification_maj AS 
 SELECT
        CASE
            WHEN char_length(fte_notification_maj.titre::text) > 25 THEN ("substring"(fte_notification_maj.titre::text, 0, 22) || '...'::text)::character varying
            ELSE fte_notification_maj.titre
        END AS titre,
        CASE
            WHEN char_length(fte_notification_maj.corps::text) > 25 THEN ("substring"(fte_notification_maj.corps::text, 0, 22) || '...'::text)::character varying
            ELSE fte_notification_maj.corps
        END AS crp,
    ((('<p class="bg-'::text || fte_notification_maj.couleur::text) || '">'::text) ||
        CASE
            WHEN fte_notification_maj.couleur::text = 'danger'::text THEN 'Tr&egrave;s importante'::text
            WHEN fte_notification_maj.couleur::text = 'warning'::text THEN 'Importante'::text
            ELSE 'Information'::text
        END) || '</p>'::text AS clr,
        CASE
            WHEN fte_notification_maj.active = 1 THEN '<span class="label label-success"> OUI </span>'::text
            ELSE '<span class="label label-danger"> NON </span>'::text
        END AS visible,
    fte_notification_maj.createur,
    to_char(fte_notification_maj.date_creation, 'DD/MM/YYYY à HH24:MI:SS'::text) AS dt_creation,
    (count(fte_notification_maj_consulte.consulte)::text || '/'::text) || ((( SELECT count(*) AS count
           FROM fte_user
          WHERE fte_user.level::text = 'user'::text AND fte_user.flag = 1 AND fte_user.statut = 1))::text) AS vues,
    ('<div class="btn-group btn-group-sm" onclick="ntfmaj_modif('::text || fte_notification_maj.fte_notification_maj_id) || ');"><a href="#" data-toggle="modal" class="btn btn-inverse"><i class="fa fa-pencil"></i></a></div>'::text AS modif,
    ('<div class="btn-group btn-group-sm" onclick="affiche_suppr_notification('::text || fte_notification_maj.fte_notification_maj_id) || ');"><a href="#" data-toggle="modal" class="btn btn-danger"><i class="fa fa-times"></i></a></div>'::text AS suppr
   FROM fte_notification_maj
     LEFT JOIN fte_notification_maj_consulte ON fte_notification_maj.fte_notification_maj_id = fte_notification_maj_consulte.fte_notification_maj_id
  GROUP BY ('<div class="btn-group btn-group-sm" onclick="ntfmaj_modif('::text || fte_notification_maj.fte_notification_maj_id) || ');"><a href="#" data-toggle="modal" class="btn btn-inverse"><i class="fa fa-pencil"></i></a></div>'::text, ('<div class="btn-group btn-group-sm" onclick="affiche_suppr_notification('::text || fte_notification_maj.fte_notification_maj_id) || ');"><a href="#" data-toggle="modal" class="btn btn-danger"><i class="fa fa-times"></i></a></div>'::text, fte_notification_maj.titre, fte_notification_maj.corps, ((('<p class="bg-'::text || fte_notification_maj.couleur::text) || '">'::text) ||
        CASE
            WHEN fte_notification_maj.couleur::text = 'danger'::text THEN 'Tr&egrave;s importante'::text
            WHEN fte_notification_maj.couleur::text = 'warning'::text THEN 'Importante'::text
            ELSE 'Information'::text
        END) || '</p>'::text, fte_notification_maj.date_creation,
        CASE
            WHEN fte_notification_maj.active = 1 THEN '<span class="label label-success"> OUI </span>'::text
            ELSE '<span class="label label-danger"> NON </span>'::text
        END, fte_notification_maj.createur
  ORDER BY fte_notification_maj.date_creation DESC;

ALTER TABLE vw_notification_maj
  OWNER TO postgres;

  
-- Sequence: fte_action_seq

-- DROP SEQUENCE fte_action_seq;

CREATE SEQUENCE fte_action_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE fte_action_seq
  OWNER TO postgres;
GRANT ALL ON SEQUENCE fte_action_seq TO postgres;


-- Sequence: fte_categories_seq

-- DROP SEQUENCE fte_categories_seq;

CREATE SEQUENCE fte_categories_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE fte_categories_seq
  OWNER TO postgres;
GRANT ALL ON SEQUENCE fte_categories_seq TO postgres;


-- Sequence: fte_historique_seq

-- DROP SEQUENCE fte_historique_seq;

CREATE SEQUENCE fte_historique_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE fte_historique_seq
  OWNER TO postgres;
GRANT ALL ON SEQUENCE fte_historique_seq TO postgres;


-- Sequence: fte_notification_id_seq

-- DROP SEQUENCE fte_notification_id_seq;

CREATE SEQUENCE fte_notification_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE fte_notification_id_seq
  OWNER TO postgres;

  
-- Sequence: fte_process_seq

-- DROP SEQUENCE fte_process_seq;

CREATE SEQUENCE fte_process_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE fte_process_seq
  OWNER TO postgres;
GRANT ALL ON SEQUENCE fte_process_seq TO postgres;


-- Sequence: fte_traitement_fonction_seq

-- DROP SEQUENCE fte_traitement_fonction_seq;

CREATE SEQUENCE fte_traitement_fonction_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE fte_traitement_fonction_seq
  OWNER TO postgres;
GRANT ALL ON SEQUENCE fte_traitement_fonction_seq TO postgres;


-- Sequence: fte_traitement_seq

-- DROP SEQUENCE fte_traitement_seq;

CREATE SEQUENCE fte_traitement_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE fte_traitement_seq
  OWNER TO postgres;
GRANT ALL ON SEQUENCE fte_traitement_seq TO postgres;


-- Sequence: fte_user_seq

-- DROP SEQUENCE fte_user_seq;

CREATE SEQUENCE fte_user_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE fte_user_seq
  OWNER TO postgres;
GRANT ALL ON SEQUENCE fte_user_seq TO postgres;



-- Sequence: fte_group_seq

-- DROP SEQUENCE fte_group_seq;

CREATE SEQUENCE fte_group_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE fte_group_seq
  OWNER TO postgres;
GRANT ALL ON SEQUENCE fte_group_seq TO postgres;


-- Sequence: fte_consulte_seq

-- DROP SEQUENCE fte_consulte_seq;

CREATE SEQUENCE fte_consulte_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE fte_consulte_seq
  OWNER TO postgres;
GRANT ALL ON SEQUENCE fte_consulte_seq TO postgres;
