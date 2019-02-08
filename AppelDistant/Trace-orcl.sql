CREATE TABLE trace_appel_distant (
  "id" number NOT NULL,
  "id_ctrl" varchar(30) NOT NULL,
  "date_creation" date NOT NULL,
  "origine_appel" varchar(20) DEFAULT NULL,
  "adresse_appel" varchar(255) DEFAULT NULL,
  "contenu_appel" varchar(5000) null,
  "contenu_resultat" varchar(5000) null,
  CONSTRAINT trace_appel_dist_pk PRIMARY KEY ("id")
) ;
/

CREATE SEQUENCE  "trace_appel_dist_seq" MINVALUE 1 INCREMENT BY 1 ;
/

create or replace TRIGGER trace_appel_dist_trg
BEFORE INSERT
ON "membership_member"
REFERENCING NEW AS New OLD AS Old
FOR EACH ROW
BEGIN
  :new."id" := case when :new."id" is null then "trace_appel_dist_seq".nextval else :new."id" end ;
  :new."date_creation" := case when :new."date_creation" is null then sysdate else :new."id" end ;
END trace_appel_dist_trg ;
/