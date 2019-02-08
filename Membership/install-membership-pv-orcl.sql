 CREATE OR REPLACE PACKAGE pv_security  
 AS  
   FUNCTION ENCRYPT1 (IN_PASSWORD VARCHAR2)  
    RETURN VARCHAR2;
   FUNCTION DECRYPT1 (IN_PASSWORD VARCHAR2)  
    RETURN VARCHAR2;
 END pv_security;  

CREATE OR REPLACE PACKAGE BODY pv_security  
 AS  
   GS$KEY  VARCHAR2 (8) := 'PVIEW';  
   FUNCTION ENCRYPT1 (IN_PASSWORD VARCHAR2)  
    RETURN VARCHAR2  
   IS  
    LC$ENCRYPTED_VALUE   VARCHAR2 (50);  
    LC$PASSWORD_MUTIPLES  VARCHAR2 (50);  
    LN$LENGTH       NUMBER;  
   BEGIN  
    GS$KEY := RPAD (GS$KEY, CEIL (LENGTH (GS$KEY) / 8) * 8, CHR (0));  
    LN$LENGTH := LENGTH (GS$KEY);  
    LC$PASSWORD_MUTIPLES :=  
      RPAD (IN_PASSWORD,  
         CEIL (LENGTH (IN_PASSWORD) / LN$LENGTH) * LN$LENGTH,  
         CHR (0));  
    LC$ENCRYPTED_VALUE :=  
      DBMS_OBFUSCATION_TOOLKIT.  
      DESENCRYPT (INPUT_STRING  => LC$PASSWORD_MUTIPLES,  
            KEY_STRING   => GS$KEY);  
    RETURN LC$ENCRYPTED_VALUE;  
   END ENCRYPT1;  
   FUNCTION DECRYPT1 (IN_PASSWORD VARCHAR2)  
    RETURN VARCHAR2  
   IS  
    LC$DECRYPTED_VALUE  VARCHAR2 (50);  
   BEGIN  
    LC$DECRYPTED_VALUE :=  
      DBMS_OBFUSCATION_TOOLKIT.  
      DESDECRYPT (INPUT_STRING => IN_PASSWORD, KEY_STRING => GS$KEY);  
    RETURN LC$DECRYPTED_VALUE;  
   END DECRYPT1 ;
 END pv_security;

crEATE TABLE "membership_member" (
  "id" number NOT NULL,
  "login_member" varchar(30) NOT NULL,
  "password_member" varchar(255) NOT NULL,
  "email" varchar(255) NOT NULL,
  "first_name" varchar(150) NOT NULL,
  "last_name" varchar(255) NOT NULL,
  "address" varchar(255) NOT NULL,
  "contact" varchar(255) NOT NULL,
  "enabled" number NOT NULL,
  "ad_activated" number NOT NULL,
  "profile_id" number NOT NULL,
  CONSTRAINT membership_member_pk PRIMARY KEY ("id")
) ;

-- --------------------------------------------------------

--
-- Structure de la table "membership_profile"
--

CREATE TABLE "membership_profile" (
  "id" number NOT NULL,
  "title" varchar(255) NOT NULL,
  "description" varchar(255) NULL,
  "enabled" char(1) DEFAULT '1',
  CONSTRAINT membership_profile_pk PRIMARY KEY ("id")
) ;

-- --------------------------------------------------------

--
-- Structure de la table "membership_role"
--

CREATE TABLE "membership_role" (
  "id" number NOT NULL,
  "name" varchar(255) NOT NULL,
  "title" varchar(255) NOT NULL,
  "description" varchar(255) NULL,
  "enabled" char(1) DEFAULT '1',
  CONSTRAINT membership_role_pk PRIMARY KEY ("id")
) ;

-- --------------------------------------------------------

--
-- Structure de la table "membership_privilege"
--

CREATE TABLE "membership_privilege" (
  "id" number NOT NULL,
  "profile_id" number NOT NULL,
  "role_id" number NOT NULL,
  "active" number NOT NULL,
  CONSTRAINT membership_privilege_pk PRIMARY KEY ("id")
) ;


CREATE SEQUENCE  "membership_member_seq" MINVALUE 1 INCREMENT BY 1 ;
CREATE SEQUENCE  "membership_profile_seq" MINVALUE 1 INCREMENT BY 1 ;
CREATE SEQUENCE  "membership_role_seq" MINVALUE 1 INCREMENT BY 1 ;
CREATE SEQUENCE  "membership_privilege_seq" MINVALUE 1 INCREMENT BY 1 ;

create or replace TRIGGER membership_member_trg
BEFORE INSERT
ON "membership_member"
REFERENCING NEW AS New OLD AS Old
FOR EACH ROW
BEGIN
  :new."id" := case when :new."id" is null then "membership_member_seq".nextval else :new."id" end ;
END membership_member_trg ;

create or replace TRIGGER membership_profile_trg
BEFORE INSERT
ON "membership_profile"
REFERENCING NEW AS New OLD AS Old
FOR EACH ROW
BEGIN
  :new."id" := case when :new."id" is null then "membership_profile_seq".nextval else :new."id" end ;
END membership_profile_trg ;

create or replace TRIGGER membership_role_trg
BEFORE INSERT
ON "membership_role"
REFERENCING NEW AS New OLD AS Old
FOR EACH ROW
BEGIN
  :new."id" := case when :new."id" is null then "membership_role_seq".nextval else :new."id" end ;
END membership_role_trg ;

create or replace TRIGGER membership_privilege_trg
BEFORE INSERT
ON "membership_privilege"
REFERENCING NEW AS New OLD AS Old
FOR EACH ROW
BEGIN
  :new."id" := case when :new."id" is null then "membership_privilege_seq".nextval else :new."id" end ;
END membership_privilege_trg ;


INSERT INTO "membership_member" ("id", "login_member", "password_member", "email", "first_name", "last_name", "address", "contact", "enabled", "ad_activated", "profile_id") VALUES (1, 'root', pv_security.ENCRYPT1('ADMIN'), 'root@localhost', 'Super', 'Administrateur', '', '', 1, 0, 1) ;
INSERT INTO "membership_member" ("id", "login_member", "password_member", "email", "first_name", "last_name", "address", "contact", "enabled", "ad_activated", "profile_id") VALUES (2, 'guest', pv_security.ENCRYPT1('GUEST@#123'), 'guest@monsite.com', 'Invité', 'Utilisateur', '', '', 1, 0, 2);

INSERT INTO "membership_profile" ("id", "title", "description", "enabled") VALUES (1, 'Super administrateur', '', 1) ;
INSERT INTO "membership_profile" ("id", "title", "description", "enabled") VALUES (2, 'Utilisateur invité', '', 1);

INSERT INTO "membership_role" ("id", "name", "title", "description", "enabled") VALUES (1, 'super_admin', 'Super administrateur', 'Accès à tout sur l''application', 1) ;
INSERT INTO "membership_role" ("id", "name", "title", "description", "enabled") VALUES (2, 'invite', 'Invité', 'Accès aux fonctionnalités qu''un invité aurait accès.', 1);

INSERT INTO "membership_privilege" ("id", "profile_id", "role_id", "active") VALUES (1, 1, 1, 1) ;
INSERT INTO "membership_privilege" ("id", "profile_id", "role_id", "active") VALUES (2, 1, 2, 0) ;
INSERT INTO "membership_privilege" ("id", "profile_id", "role_id", "active") VALUES (3, 2, 1, 0) ;
INSERT INTO "membership_privilege" ("id", "profile_id", "role_id", "active") VALUES (4, 2, 2, 1);